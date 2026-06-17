-- SUM itu digunakan pada waktu "total"
-- COUNT itu digunakan pada waktu "jumlah"

-- NOMOR 1 --
SELECT * FROM users

-- NOMOR 2 --
SELECT city, username FROM users;

-- NOMOR 3 --
SELECT username FROM users WHERE age > 20;

-- NOMOR 4 --
SELECT username FROM users WHERE city = "Surabaya";

-- NOMOR 5 --
SELECT * FROM users ORDER BY age DESC;

-- NOMOR 6 --
SELECT COUNT(id) FROM users;

-- NOMOR 7 --
SELECT AVG(age) FROM users;

-- NOMOR 8 --
SELECT * FROM orders WHERE total > 100000;

-- NOMOR 9 --
SELECT u.username AS username, o.total 
FROM users u JOIN orders o ON u.id = o.id;

-- NOMOR 10 --
SELECT u.username AS username, o.total AS total 
FROM users u JOIN orders o ON u.id = o.id 
GROUP BY u.username, o.total;

-- NOMOR 11 --
SELECT u.username AS username 
FROM users u 
LEFT JOIN orders o ON u.id = o.user_id 
WHERE o.user_id IS NULL;

-- NOMOR 12 --
SELECT u.username AS username, o.total AS total
FROM users u
JOIN orders o ON u.id = o.id
ORDER BY o.total DESC;

-- NOMOR 13 --
SELECT u.username AS username, o.total AS total
FROM users u
JOIN orders o ON u.id = o.id
ORDER BY o.total DESC
LIMIT 3;

-- NOMOR 14 --
SELECT city AS kota, COUNT(id) AS jumlah
FROM users
GROUP BY city;

-- NOMOR 15 --
SELECT city AS kota, COUNT(id) AS jumlah
FROM users
GROUP BY city
LIMIT 1;

-- NOMOR 1 
SELECT name AS produk, CONCAT("Rp. ", price) AS harga
FROM products
LIMIT 2;

-- NOMOR 2
SELECT name AS produk, CONCAT(stock, " pcs") AS stok
FROM products
LIMIT 2;

-- NOMOR 3
SELECT name AS produk, price AS price
FROM products
WHERE price > 500000;

-- NOMOR 4
SELECT COUNT(stock) AS jumlah_produk
FROM products;

-- NOMOR 5
SELECT SUM(stock) AS total_stok
FROM products;

-- NOMOR 6
SELECT category AS category, COUNT(stock) AS jumlah_produk
FROM products
GROUP BY category;

-- NOMOR 7
SELECT category AS category, SUM(price * stock) AS total_nilai
FROM products
GROUP BY category;

-- NOMOR 8
SELECT name as name, price as price
FROM products
ORDER BY price DESC
LIMIT 1;

-- NOMOR 9
SELECT name as name, price as price
FROM products
ORDER BY price DESC
LIMIT 3;

-- NOMOR 10
SELECT category, COUNT(stock) AS jumlah_produk
FROM products
GROUP BY category
ORDER BY jumlah_produk DESC
LIMIT 1;

-- NOMOR 1
SELECT CONCAT(username, ' - ', city) AS ""
FROM users;

-- NOMOR 2
SELECT CONCAT(u.username, ' | ', p.name, ' | ', o.qty, ' | ', p.price) AS ""
FROM orders o
JOIN users u ON u.id = o.user_id
JOIN products p ON p.id = o.product_id;
GROUP BY u.username, p.name, o.qty, p.price;

-- NOMOR 3
SELECT CONCAT(u.username, ' - Rp. ', (o.qty * p.price)) AS ""
FROM orders o
JOIN users u ON u.id = o.user_id
JOIN products p ON p.id = o.product_id;

-- NOMOR 4
SELECT CONCAT(u.username, ' | Rp. ', SUM(o.qty * p.price)) AS ""
FROM orders o
JOIN users u ON u.id = o.user_id
JOIN products p ON p.id = o.product_id
GROUP BY u.username, p.price;

-- NOMOR 5
SELECT CONCAT(p.name, ' | ', SUM(o.qty)) AS ""
FROM orders o 
JOIN products p ON p.id = o.product_id
GROUP BY p.name
ORDER BY SUM(o.qty) DESC;
