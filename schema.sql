CREATE TABLE IF NOT EXISTS users(
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL
);

# A default user. Password is 'hunter2'
INSERT INTO `users` (`email`, `password`) VALUES
('parzibyte@gmail.com', '$2y$10$DVMlG/zp8rB3KrW6oRvpvOgbIkoRRfOXu/9H5DgTfVQXwZP5m.tQy');

