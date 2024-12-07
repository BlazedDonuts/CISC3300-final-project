CREATE TABLE IF NOT EXISTS menu (
    menuID INT AUTO_INCREMENT PRIMARY KEY,
    menuName VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    menuID INT NOT NULL,
    Description VARCHAR(255) NOT NULL,
    FOREIGN KEY (menuID) REFERENCES menu(menuID) ON DELETE CASCADE
);

INSERT INTO orders (itemID, quantity) VALUES
(1, 2),  -- 2 Chocolate Cake
(2, 1),  -- 1 Chocolate Ice Cream
(3, 3);  -- 3 Vanilla Cake