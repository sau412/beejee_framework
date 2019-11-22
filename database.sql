SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `edited_by_admin` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tasks` (`id`, `username`, `email`, `description`, `status`, `edited_by_admin`) VALUES
(1, 'sau412', 'sau412@example.com', '5dd25d19bdaf9', 0, 0),
(2, 'sau412', 'sau412@example.com', '5dd25d4c04f9c', 0, 0),
(3, 'test', 'test@example.com', 'djjtytjf', 0, 0),
(4, 'sau412', 'sau412@example.com', 'Task need to be done!', 0, 0);


ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
