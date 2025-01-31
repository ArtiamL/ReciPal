CREATE TABLE IF NOT EXISTS recipes (
    recipe_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
    created_by INT NOT NULL,
    title VARCHAR(60) NOT NULL,
    recipe_desc CHAR(255),
    instructions TEXT NOT NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    deleted BOOLEAN NOT NULL,
    FOREIGN KEY (created_by) REFERENCES users(user_id)
);