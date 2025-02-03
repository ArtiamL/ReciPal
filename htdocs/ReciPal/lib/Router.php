<?php
//declare(strict_types=1);

namespace lib;

# Author: Majd Soubh.
# Article: Implementing PHP Routing with Dynamic Parameters - Majd Soubh - Medium.
# Source: https://medium.com/@majdsoubh/implementing-php-routing-with-dynamic-parameters-18940bd80795
# Accessed: 24 January 2025

# Modifications have been made for functionality and to fix errors.

class Router
{
    /*
     * {} - matches within curly braces.
     * \w - matches any word character.
     * +  - matches previous token (\w) as many times as possible.
     * (:([^}]+))?
     *      ? - optional group matching (0-1 times)
     *      ([^}]+) - greedy match (1-unlimited times) chars that are not closing curly brace (}).
     */
    private const REGEX_PATTERN = '/{\w+(:([^}]+))?}/';

    private static array $routes = [];

    private static array $middlewares = [];

    private static $router;

    // Add route to array
    private function __construct() {}

    /**
     * Gets instance of router, creating it if necessary. Applies singleton principle to ensure only one router is active.
     * @return Router Instance of Router.
     */
    public static function getRouter(): Router {
        // Construct obj if not already set.
        if (!isset(self::$router)) {
            self::$router = new Router();
        }

        // Return instance of Router.
        return self::$router;
    }

    private function register(string $route, string $method, callable|array $callback): void {
        $route = $this->normalisePath($route);

        self::$routes[$method][$route] = $callback;
    }

    public function get(string $route, callable|array $callback) {
        $this->register($route, 'GET', $callback);
    }

    public function post(string $route, callable|array $callback) {
        $this->register($route, 'POST', $callback);
    }

    public function put(string $route, callable|array $callback) {
        $this->register($route, 'PUT', $callback);
    }

    public function delete(string $route, callable|array $callback) {
        $this->register($route, 'DELETE', $callback);
    }

    /**
     * Normalises the path.
     * @param string $path The path to normalise
     * @return string The normalised path.
     */
    private function normalisePath(string $path): string
    {
        // Trim whitespace and any leading or trailing '/' chars.
        $path = trim($path, '/');

        // Remove base path
        $basePath = trim(dirname($_SERVER['SCRIPT_NAME']), '/');
        if (!empty($basePath) && str_starts_with($path, $basePath)) {
            $path = substr($path, strlen($basePath));
        }

        // Set to lowercase for consistency
        $path = strtolower($path);

        return '/' . trim($path, '/');
    }

    // Dispatch route - set route based on path.
    public function dispatch()
    {
        // Normalise first
        $path = $this->normalisePath($_SERVER['REQUEST_URI']);
        error_log("path: $path");

        if (isset(self::$middlewares[$path])) {
            [$middleware, $params] = self::$middlewares[$path];
            call_user_func([$middleware, $params]);
        }

        $routes = self::$routes[$_SERVER['REQUEST_METHOD']] ?? [];

        error_log("Request Method: " . $_SERVER['REQUEST_METHOD']);
        error_log("Request URI: " . $_SERVER['REQUEST_URI']);


        // Iterate routes by the filter above (REQUEST_METHOD)
        foreach ($routes as $route => $callback) {

            // Transform route into regex, callback function determines how matches are replaced.
            $routeRegex = preg_replace_callback(self::REGEX_PATTERN, function ($matches) {
                /* if pattern is provided after : (colon), use given pattern, else replace with matching alphanumeric
                 * chars, hyphens, underscores.
                 */
                return isset($matches[1]) ? '(' . $matches[2] . ')' : '([a-zA-Z0-9_-]+)';
            }, $route);

            /* Delimit for further matching, '#' is the delimiter as we're working with '/' in the uri.
             * '^' anchors matches at start of string, '$' anchors matches to end of string, requiring the whole string
             * to match.
             */
            $routeRegex = '#^' . $routeRegex . '$#';


            error_log("Checking Route: $route");
            error_log("Generated Regex: $routeRegex");
            error_log("Request Path: $path");

            // Check if the requested route matches the current pattern.
            if (preg_match($routeRegex, $path, $matches)) {
//                error_log($routeRegex);
//                error_log($path);
//                error_log(print_r($matches, true));

                // Shift the start of the array, removing first matches and getting any user-requested params.
                array_shift($matches);
                $paramsVals = $matches;

                $paramsNames = [];

                // Set to '/'
                if (preg_match_all(self::REGEX_PATTERN, $route, $matches)) {
                    $paramsNames = $matches[1];
                }

                $routeParams = count($paramsNames) === count($paramsVals) ? array_combine($paramsNames, $paramsVals) : [];

                return $this->resolve($callback, $routeParams);
            }
        }

        return $this->abort('404 Not Found');
    }

    private function resolve(callable|array $callback, array $routeParams) {
        // Verify $callback can be called
        if (is_callable($callback)) {
            // Calls the $callback func with params.
            return call_user_func($callback, $routeParams);
        }

        if (is_array($callback) && class_exists($callback[0])) {
            // $callback is array; initialise the class with
            return call_user_func_array([new $callback[0], $callback[1]], $routeParams);
        }

        return $this->abort("500 Internal Server Error", 500);
    }

    private function abort(string $message, int $code = 404): string {
        http_response_code($code);
        echo $message;
        exit;
    }

    public function addMiddleware(string $route, callable|array $middleware, array $params): void {
        self::$middlewares[$route] = [$middleware, $params];
    }
}