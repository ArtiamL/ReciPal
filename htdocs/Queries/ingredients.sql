CREATE TABLE ingredients (
    ingredient_id INT AUTO_INCREMENT PRIMARY KEY, -- Unique id for each of the ngredient
    name VARCHAR(100) NOT NULL, -- Name of the ingredient
    category VARCHAR(255) NOT NULL, -- Category e.g., 'vegetable, meat'
    price DECIMAL(10,2), -- Price n decimal format '10 digits, 2 decimal places'
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Automatically stores the date/time when something is added
);
