CREATE TABLE IF NOT EXISTS curated_recipes (
    recipe_id INT NOT NULL,
    curator_id INT NOT NULL,
    PRIMARY KEY (recipe_id, curator_id),
    FOREIGN KEY (recipe_id) REFERENCES recipes(recipe_id),
    FOREIGN KEY (curator_id) REFERENCES users(user_id)
);