CREATE TABLE IF NOT EXISTS users(
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL
);
CREATE TABLE IF NOT EXISTS links(
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    hash varchar(6) UNIQUE,
    title varchar(255) NOT NULL,
    real_link varchar(1024) NOT NULL,
    instant_redirect BOOLEAN DEFAULT 1
);

# A default user. Password is 'hunter2'
INSERT INTO `users` (`email`, `password`) VALUES
('parzibyte@gmail.com', '$2y$10$DVMlG/zp8rB3KrW6oRvpvOgbIkoRRfOXu/9H5DgTfVQXwZP5m.tQy');

