-- `admin`
INSERT INTO `admin` (`id`, `login`, `password`) VALUES
(1, 'admin', '$2y$10$w9GkWVGXxSTjw4A9QyjasuqyeJyUPp2JlWYnFGFEen7e2..YUXxNC');

-- `service`
INSERT INTO `service` (`id`, `service_status`) VALUES
(1, 0);

-- `settings`
INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'active_theme', 'purple-show');

COMMIT;
