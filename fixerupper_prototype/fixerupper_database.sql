
-- Create database
CREATE DATABASE IF NOT EXISTS fixerupper;
USE fixerupper;

-- Customers table
CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL
);

-- Products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255) NOT NULL
);

-- Orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
);

-- Order Items table
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Sample Products (20 items)
INSERT INTO products (name, description, price, image) VALUES
('Cordless Drill', 'Powerful 18V cordless drill with two batteries.', 79.99, 'cordless_drill.jpg'),
('Hammer', '16oz claw hammer with rubber grip.', 12.99, 'hammer.jpg'),
('Screwdriver Set', 'Multi-size set with magnetic tips.', 14.99, 'screwdriver_set.jpg'),
('Electric Sander', 'Palm sander with dust collection.', 39.99, 'electric_sander.jpg'),
('Toolbox', 'Compact toolbox with tray.', 24.99, 'toolbox.jpg'),
('Circular Saw', 'Powerful 1200W circular saw.', 89.99, 'circular_saw.jpg'),
('Pliers Set', '3-piece set: needle-nose, slip-joint, and diagonal.', 17.49, 'pliers_set.jpg'),
('Spirit Level', '24-inch high accuracy spirit level.', 9.99, 'spirit_level.jpg'),
('Tape Measure', '25ft retractable tape measure.', 7.99, 'tape_measure.jpg'),
('Utility Knife', 'Retractable utility knife with blades.', 5.49, 'utility_knife.jpg'),
('Work Gloves', 'Durable and comfortable work gloves.', 8.99, 'work_gloves.jpg'),
('Paint Roller Set', 'Includes tray, handle, and 2 rollers.', 11.99, 'paint_roller.jpg'),
('Adjustable Wrench', '10-inch adjustable wrench.', 10.49, 'adjustable_wrench.jpg'),
('Allen Key Set', 'Metric hex key set.', 6.49, 'allen_key_set.jpg'),
('Drill Bit Set', '20-piece titanium drill bit set.', 19.99, 'drill_bit_set.jpg'),
('Ladder', '6ft aluminum step ladder.', 49.99, 'ladder.jpg'),
('Safety Goggles', 'Impact-resistant safety goggles.', 4.99, 'safety_goggles.jpg'),
('Workbench', 'Foldable heavy-duty workbench.', 59.99, 'workbench.jpg'),
('Nails Pack', '500-piece assorted nails.', 6.99, 'nails_pack.jpg'),
('Screws Pack', '1000-piece assorted screws.', 9.99, 'screws_pack.jpg');
