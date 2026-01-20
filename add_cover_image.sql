-- Run this SQL to add the cover_image column to the books table
-- You can execute this in phpMyAdmin or MySQL command line

ALTER TABLE `books` ADD COLUMN `cover_image` VARCHAR(500) NULL AFTER `stock_quantity`;

-- Update existing books with real cover images from Open Library
UPDATE `books` SET `cover_image` = 'https://covers.openlibrary.org/b/isbn/9780743273565-L.jpg' WHERE `isbn` = '978-0743273565';
UPDATE `books` SET `cover_image` = 'https://covers.openlibrary.org/b/isbn/9780061120084-L.jpg' WHERE `isbn` = '978-0061120084';
UPDATE `books` SET `cover_image` = 'https://covers.openlibrary.org/b/isbn/9780451524935-L.jpg' WHERE `isbn` = '978-0451524935';
UPDATE `books` SET `cover_image` = 'https://covers.openlibrary.org/b/isbn/9780141439518-L.jpg' WHERE `isbn` = '978-0141439518';
UPDATE `books` SET `cover_image` = 'https://covers.openlibrary.org/b/isbn/9780316769488-L.jpg' WHERE `isbn` = '978-0316769488';
