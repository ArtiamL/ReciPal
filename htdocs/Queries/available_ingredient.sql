CREATE TABLE available_ingredient (
    available_id INT AUTO_INCREMENT PRIMARY KEY,
    ingredient_id INT,
    shop_id INT,
    stock_quantity INT, -- number of items in stock
    price DECIMAL(10,2), -- price in shop
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (ingredient_id) REFERENCES ingredients (ingredient_id) ON DELETE CASCADE,
    FOREIGN KEY (shop_id) REFERENCES chainshops (shop_id) ON DELETE CASCADE
)