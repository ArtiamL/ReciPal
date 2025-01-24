<?php
declare(strict_types=1);

namespace lib;

# Author: Ramirez Jr, L. (2024).
# Article: How To Create A Custom PHP Router | Zero To Mastery. [online] Zero To Mastery.
# Source: https://zerotomastery.io/blog/php-router/
# Accessed: 23 January 2025
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

    private static $router;

    // Add route to array
    private function __construct() {}

    /**
     * Gets instance of router, creating it if necessary. Applies singleton principle to ensure only one router is active.
     * @return Router Instance of Router.
     */
    public static function getRouter() {
        if (!isset(self::$router)) {
            self::$router = new Router();
        }

        return self::$router;
    }

    private function register(string $route, string $method, callable|array $callback) {
        $this->normalisePath($route);

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
        $path = trim($path, '/') ?? '/';
        // Set to lowercase for consistency
        $path = strtolower($path);
        // Wrap in opening and closing '/'.
        $path = "/{$path}/";
        // Return the final normalised path with any excess '/' removed (i.e., ///).
        return preg_replace('#/{2,}#', '/', $path);
    }

    // Dispatch route - set route based on path.
    public function dispatch()
    {
        // Normalise first
        $path = $this->normalisePath($_SERVER['REQUEST_URI']);

        $routes = self::$routes[$_SERVER['REQUEST_METHOD']];

        // Iterate routes
        foreach ($this->routes as $route => $callback) {

            // Transform route into regex, callback function determines how matches are replaced.
            $routeRegex = preg_replace_callback(self::REGEX_PATTERN, function ($matches) {
                /* if pattern is provided after : (colon), use given patter, else replace with matching alphanumeric
                 * chars, hyphens, underscores.
                 */
                return isset($matches[1]) ? '(' . $matches[2] . ')' : '([a-zA-Z0-9_-]+)';
            }, $route);

            /* Delimit for further matching, '@' is the delimiter as we're working with '/' in the uri.
             * '^' anchors matches at start of string, '$' anchors matches to end of string, requiring the whole string
             * to match.
             */
            $routeRegex = '#^' . $routeRegex . '$#';

            // Check if the requested route matches the current pattern.
            if (!preg_match($routeRegex, $path, $matches)) {
                // Shift the start of the array, removing first matches and getting any user-requested params.
                array_shift($matches);
                $paramsVals = $matches;

                // Set to /
                $paramsNames = preg_match_all(self::REGEX_PATTERN, $route, $matches) ? $matches[1] : [];

                $routeParams = array_combine($paramsNames, $paramsVals);

                return $this->resolveAction($callback, $routeParams);
            }
        }

        return $this->abort('404 Not Found');
    }
}