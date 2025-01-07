CREATE TABLE IF NOT EXISTS recipe (
    recipe_id INT NOT NULL PRIMARY KEY,
    created_by INT NOT NULL,
    curated_by INT NULL,
    title VARCHAR(60) NOT NULL,
    recipe_desc CHAR(255),
    instructions TEXT NOT NULL,
    date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    deleted BOOLEAN NOT NULL
)