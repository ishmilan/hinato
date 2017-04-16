<?php
/*BOARDS*/
$this->db->query("CREATE TABLE IF NOT EXISTS `boards` (
  `id_board` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `owner` int(12) NOT NULL,
  `limit_size_files` int(11) NOT NULL DEFAULT '2000000',
  PRIMARY KEY (`id_board`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;");

$this->db->query("CREATE TRIGGER `clean_BD_boards` BEFORE DELETE ON `boards` FOR EACH ROW BEGIN
	DELETE FROM labels
    WHERE labels.board=OLD.id_board;
	DELETE FROM lists
    WHERE lists.board=OLD.id_board;
END;");
/*CARDS*/
$this->db->query("CREATE TABLE IF NOT EXISTS `cards` (
  `id_card` int(12) NOT NULL AUTO_INCREMENT,
  `list` int(12) NOT NULL,
  `user` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `description` varchar(2048) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `position` int(4) NOT NULL,
  `deadline` datetime NOT NULL,
  `archived` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_card`,`list`,`user`),
  KEY `user` (`user`),
  KEY `list` (`list`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;");

$this->db->query("
CREATE TRIGGER `clean_BD_cards` BEFORE DELETE ON `cards` FOR EACH ROW BEGIN
	DELETE FROM comments
    WHERE comments.card=OLD.id_card;
    DELETE FROM card_labels
    WHERE card_labels.card=OLD.id_card;
    DELETE FROM tasks
    WHERE tasks.card=OLD.id_card;
END;");
/*card_labels*/
$this->db->query("CREATE TABLE IF NOT EXISTS `card_labels` (
  `card` int(12) NOT NULL,
  `label` int(12) NOT NULL,
  PRIMARY KEY (`card`,`label`),
  KEY `label` (`label`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;");
/*comments*/
$this->db->query("CREATE TABLE IF NOT EXISTS `comments` (
  `id_comment` int(12) NOT NULL AUTO_INCREMENT,
  `card` int(12) NOT NULL,
  `user` int(12) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(2048) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_comment`,`card`,`user`),
  KEY `card` (`card`),
  KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;");
/*labels*/
$this->db->query("CREATE TABLE IF NOT EXISTS `labels` (
  `id_label` int(4) NOT NULL AUTO_INCREMENT,
  `board` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `color_foreground` varchar(8) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `color_background` varchar(8) COLLATE utf8mb4_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_label`,`board`),
  KEY `board` (`board`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;");

$this->db->query("CREATE TRIGGER `clean_BD_labels` BEFORE DELETE ON `labels` FOR EACH ROW DELETE FROM card_labels
    WHERE card_labels.label=OLD.id_label;");
/*list*/
$this->db->query("CREATE TABLE IF NOT EXISTS `list` (
  `id_list` int(12) NOT NULL AUTO_INCREMENT,
  `board` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `position` int(4) NOT NULL,
  `archived` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_list`,`board`),
  KEY `board` (`board`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;");

$this->db->query("CREATE TRIGGER `clean_BD_list` BEFORE DELETE ON `list` FOR EACH ROW DELETE FROM cards
WHERE cards.list=OLD.id_list;");
/*members*/
$this->db->query("CREATE TABLE IF NOT EXISTS `members` (
  `board` int(12) NOT NULL,
  `user` int(12) NOT NULL,
  `user_type` varchar(8) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `color` varchar(8) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `position` int(4) NOT NULL,
  PRIMARY KEY (`board`,`user`),
  KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;");
/*tasks*/
$this->db->query("CREATE TABLE IF NOT EXISTS `tasks` (
  `card` int(12) NOT NULL,
  `user` int(12) NOT NULL,
  `task` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `done` tinyint(1) NOT NULL,
  PRIMARY KEY (`card`,`user`,`task`),
  KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;");
/*users*/
$this->db->query("CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(12) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `pass` varchar(128) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `alias` varchar(64) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `surname` varchar(128) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `img_path` varchar(256) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `lang` varchar(8) COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT 'es-ES',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email_2` (`email`),
  KEY `email` (`email`),
  KEY `email_3` (`email`,`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;");

$this->db->query("CREATE TRIGGER `clean_BD_users` BEFORE DELETE ON `users` FOR EACH ROW DELETE FROM members
WHERE members.user=OLD.id_user;");
/*linkeds*/
$this->db->query("ALTER TABLE `cards`
  ADD CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cards_ibfk_2` FOREIGN KEY (`list`) REFERENCES `list` (`id_list`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cards_ibfk_3` FOREIGN KEY (`id_card`) REFERENCES `tasks` (`card`) ON DELETE CASCADE ON UPDATE CASCADE;");

$this->db->query("ALTER TABLE `card_labels`
  ADD CONSTRAINT `card_labels_ibfk_1` FOREIGN KEY (`label`) REFERENCES `labels` (`id_label`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `card_labels_ibfk_2` FOREIGN KEY (`card`) REFERENCES `cards` (`id_card`) ON DELETE CASCADE ON UPDATE CASCADE;");

$this->db->query("ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`card`) REFERENCES `cards` (`id_card`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;");

$this->db->query("ALTER TABLE `labels`
  ADD CONSTRAINT `labels_ibfk_1` FOREIGN KEY (`board`) REFERENCES `boards` (`id_board`) ON DELETE CASCADE ON UPDATE CASCADE;");

$this->db->query("ALTER TABLE `list`
  ADD CONSTRAINT `list_ibfk_1` FOREIGN KEY (`board`) REFERENCES `boards` (`id_board`) ON DELETE CASCADE ON UPDATE CASCADE;");

$this->db->query("ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `members_ibfk_2` FOREIGN KEY (`board`) REFERENCES `boards` (`id_board`) ON DELETE CASCADE ON UPDATE CASCADE;");

$this->db->query("ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;");
