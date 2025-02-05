CREATE TABLE alternative_ingredient (
    ingredient_id INT AUTO_INCREMENT PRIMARY KEY,
    alternative_ingredient_id INT, 
    reason TEXT, -- why this is a good substituet
    FOREIGN KEY (ingredient_id) REFERENCES ingredients (ingredient_id) ON DELETE CASCADE,
    FOREIGN KEY (alternative_ingredient_id) REFERENCES ingredients (ingredient_id) ON DELETE CASCADE
)