CREATE TABLE chainshops (
    shop_id INT AUTO_INCREMENT PRIMARY KEY, -- Unique id for the shop
    name VARCHAR(255) NOT NULL, -- shop name e.g., 'Tesco, Morrisons'
    location VARCHAR(255), -- shop location
    contact_number VARCHAR(20), -- shop contact number
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)