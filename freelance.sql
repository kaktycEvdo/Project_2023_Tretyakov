SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `card` (
  `number` int(11) NOT NULL,
  `expiry` date NOT NULL,
  `sc` int(11) NOT NULL,
  `user_email` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `certificate` (
  `certificate_id` int(11) NOT NULL,
  `verified` tinyint(4) NOT NULL,
  `associated_company` varchar(70) NOT NULL,
  `about` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `document` (
  `document_id` int(11) NOT NULL,
  `certificate_certificate_id` int(11) DEFAULT NULL,
  `text` varchar(600) NOT NULL,
  `type` varchar(40) NOT NULL,
  `freelancer_user_email` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `freelancer_user_email` varchar(70) NOT NULL,
  `task_task_id` int(11) NOT NULL,
  `task_data_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `feedback` (`feedback_id`, `freelancer_user_email`, `task_task_id`, `task_data_id`) VALUES
(2, 'ilya.2005.tretyakov@gmail.com', 3, 7);

CREATE TABLE `freelancer` (
  `user_email` varchar(70) NOT NULL,
  `characteristics` varchar(200) DEFAULT NULL,
  `about` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `freelancer` (`user_email`, `characteristics`, `about`) VALUES
('ilya.2005.tretyakov@gmail.com', '', 'Я только что создал аккаунт!'),
('ilya.tretyakov.2005@bk.ru', '', 'Я только что создал аккаунт!');

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `user_author` varchar(40) NOT NULL,
  `user_recepient` varchar(40) NOT NULL,
  `text` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `official_task` (
  `official_task_id` int(11) NOT NULL,
  `chosen_freelancer` varchar(70) NOT NULL,
  `task_task_id` int(11) NOT NULL,
  `task_purchaser_user_email` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `personal_data` (
  `login` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `personal_data` (`login`, `password`) VALUES
('admin', 'admin'),
('admin2', 'admin');

CREATE TABLE `purchaser` (
  `user_email` varchar(70) NOT NULL,
  `characteristics` varchar(200) DEFAULT NULL,
  `about` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `purchaser` (`user_email`, `characteristics`, `about`) VALUES
('ilya.2005.tretyakov@gmail.com', '', 'Я только что создал аккаунт!'),
('ilya.tretyakov.2005@bk.ru', '', 'Я только что создал аккаунт!');

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `purchaser_user_email` varchar(70) NOT NULL,
  `task_data_id` int(11) NOT NULL,
  `tags` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `task` (`task_id`, `purchaser_user_email`, `task_data_id`, `tags`) VALUES
(2, 'ilya.2005.tretyakov@gmail.com', 2, 'tags'),
(3, 'ilya.tretyakov.2005@bk.ru', 3, 'тег');

CREATE TABLE `task_data` (
  `idtask_data` int(11) NOT NULL,
  `deadline` datetime NOT NULL,
  `payment_method` tinyint(4) NOT NULL,
  `reward` int(11) NOT NULL,
  `text` varchar(2000) NOT NULL,
  `is_fulfilled` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `task_data` (`idtask_data`, `deadline`, `payment_method`, `reward`, `text`, `is_fulfilled`) VALUES
(2, '2024-06-28 15:00:00', 0, 200, 'Текст заказа лол Текст заказа лол Текст заказа лол Текст заказа лол Текст заказа лол Текст заказа лол Текст заказа лол Текст заказа лол Текст заказа лол Текст заказа лол Текст заказа лол Текст заказа лол Текст заказа лол Текст заказа лол Текст заказа лол ', 0),
(3, '2024-06-29 19:13:00', 0, 1000, 'таск 2 текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст ', 0),
(7, '2024-07-02 15:00:00', 1, 1000, 'ghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbdghbd', 0);

CREATE TABLE `user` (
  `name` varchar(52) NOT NULL,
  `surname` varchar(52) NOT NULL,
  `patronymic` varchar(52) DEFAULT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(70) NOT NULL,
  `last_online` datetime DEFAULT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `personal_data_login` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user` (`name`, `surname`, `patronymic`, `phone`, `email`, `last_online`, `verified`, `is_admin`, `personal_data_login`) VALUES
('Илья', 'Третьяков', 'В', 7, 'ilya.2005.tretyakov@gmail.com', NULL, 0, 0, 'admin'),
('Игорь', 'Третий', NULL, 7, 'ilya.tretyakov.2005@bk.ru', '2024-06-28 14:06:56', 0, 0, 'admin2');


ALTER TABLE `card`
  ADD PRIMARY KEY (`number`,`user_email`),
  ADD UNIQUE KEY `number_UNIQUE` (`number`),
  ADD KEY `fk_card_user1_idx` (`user_email`);

ALTER TABLE `certificate`
  ADD PRIMARY KEY (`certificate_id`),
  ADD UNIQUE KEY `certificate_id_UNIQUE` (`certificate_id`);

ALTER TABLE `document`
  ADD PRIMARY KEY (`document_id`,`freelancer_user_email`),
  ADD UNIQUE KEY `document_id_UNIQUE` (`document_id`),
  ADD KEY `fk_document_certificate1_idx` (`certificate_certificate_id`),
  ADD KEY `fk_document_freelancer1_idx` (`freelancer_user_email`);

ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`,`freelancer_user_email`,`task_task_id`,`task_data_id`),
  ADD UNIQUE KEY `feedback_id_UNIQUE` (`feedback_id`),
  ADD KEY `fk_feedback_freelancer1_idx` (`freelancer_user_email`),
  ADD KEY `fk_feedback_task1_idx` (`task_task_id`),
  ADD KEY `fk_feedback_task_data1_idx` (`task_data_id`);

ALTER TABLE `freelancer`
  ADD PRIMARY KEY (`user_email`),
  ADD KEY `fk_freelancer_user1_idx` (`user_email`);

ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`,`user_author`,`user_recepient`),
  ADD KEY `fk_message_user1_idx` (`user_author`),
  ADD KEY `fk_message_user2_idx` (`user_recepient`);

ALTER TABLE `official_task`
  ADD PRIMARY KEY (`official_task_id`,`chosen_freelancer`,`task_task_id`,`task_purchaser_user_email`),
  ADD UNIQUE KEY `official_task_id_UNIQUE` (`official_task_id`),
  ADD KEY `fk_official_task_freelancer1_idx` (`chosen_freelancer`),
  ADD KEY `fk_official_task_task1_idx` (`task_task_id`,`task_purchaser_user_email`);

ALTER TABLE `personal_data`
  ADD PRIMARY KEY (`login`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`);

ALTER TABLE `purchaser`
  ADD PRIMARY KEY (`user_email`),
  ADD KEY `fk_purchaser_user1_idx` (`user_email`);

ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`,`purchaser_user_email`,`task_data_id`),
  ADD UNIQUE KEY `task_id_UNIQUE` (`task_id`),
  ADD KEY `fk_task_purchaser1_idx` (`purchaser_user_email`),
  ADD KEY `fk_task_task_data1_idx` (`task_data_id`);

ALTER TABLE `task_data`
  ADD PRIMARY KEY (`idtask_data`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`email`,`personal_data_login`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `personal_data_login_UNIQUE` (`personal_data_login`),
  ADD KEY `fk_user_personal_data_idx` (`personal_data_login`);


ALTER TABLE `certificate`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `document`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `official_task`
  MODIFY `official_task_id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `task_data`
  MODIFY `idtask_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


ALTER TABLE `card`
  ADD CONSTRAINT `fk_card_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `document`
  ADD CONSTRAINT `fk_document_certificate1` FOREIGN KEY (`certificate_certificate_id`) REFERENCES `certificate` (`certificate_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `fk_document_freelancer1` FOREIGN KEY (`freelancer_user_email`) REFERENCES `freelancer` (`user_email`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_feedback_freelancer1` FOREIGN KEY (`freelancer_user_email`) REFERENCES `freelancer` (`user_email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_feedback_task1` FOREIGN KEY (`task_task_id`) REFERENCES `task` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_feedback_task_data1` FOREIGN KEY (`task_data_id`) REFERENCES `task_data` (`idtask_data`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `freelancer`
  ADD CONSTRAINT `fk_freelancer_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `message`
  ADD CONSTRAINT `fk_message_user1` FOREIGN KEY (`user_author`) REFERENCES `user` (`personal_data_login`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_message_user2` FOREIGN KEY (`user_recepient`) REFERENCES `user` (`personal_data_login`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `official_task`
  ADD CONSTRAINT `fk_official_task_freelancer1` FOREIGN KEY (`chosen_freelancer`) REFERENCES `freelancer` (`user_email`),
  ADD CONSTRAINT `fk_official_task_task1` FOREIGN KEY (`task_task_id`,`task_purchaser_user_email`) REFERENCES `task` (`task_id`, `purchaser_user_email`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `purchaser`
  ADD CONSTRAINT `fk_purchaser_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `task`
  ADD CONSTRAINT `fk_task_purchaser1` FOREIGN KEY (`purchaser_user_email`) REFERENCES `purchaser` (`user_email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_task_task_data1` FOREIGN KEY (`task_data_id`) REFERENCES `task_data` (`idtask_data`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_personal_data` FOREIGN KEY (`personal_data_login`) REFERENCES `personal_data` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
