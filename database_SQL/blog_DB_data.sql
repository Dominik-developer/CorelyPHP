SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

USE `blog`;

--
-- Inserting data into table `admin`
--

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'admin', '$2y$10$L9fQlnPTTuYkNhLnXh68..F8R.bJdLaAJBJjXU8RjhiHUHFVVJyCe');

--
-- Inserting data into table `service`
--

INSERT INTO `service` (`id`, `service_status`) VALUES
(1, 1);


COMMIT;
