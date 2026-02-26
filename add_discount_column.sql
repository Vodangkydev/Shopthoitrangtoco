-- Thêm cột discount_percent vào bảng product
-- Chạy SQL này trong phpMyAdmin hoặc MySQL client

ALTER TABLE `product` ADD COLUMN `discount_percent` INT DEFAULT 0;

-- Kiểm tra kết quả
-- SELECT id, name, price, discount_percent FROM product LIMIT 5;

