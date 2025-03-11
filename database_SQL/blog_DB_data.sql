START TRANSACTION;

INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'admin', '$2y$10$w9GkWVGXxSTjw4A9QyjasuqyeJyUPp2JlWYnFGFEen7e2..YUXxNC');

-- --------------------------------------------------------

INSERT INTO `service` (`id`, `service_status`) VALUES
(1, 0);

COMMIT;
