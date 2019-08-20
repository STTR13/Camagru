CREATE TABLE IF NOT EXISTS `user` (
  `id_user` INT UNSIGNED AUTO_INCREMENT NOT NULL,
  `pseudo` <type>,
  `email` <type>,
  `password` <type>,
  `account_verification_key` <type>,
  `pref_mail_notifications` <type>,

  PRIMARY KEY (`id_user`)
);




CREATE TABLE IF NOT EXISTS `session` (
  `id_session` INT UNSIGNED AUTO_INCREMENT NOT NULL,
  `id_user` INT UNSIGNED,
  `start` <type>,
  `end` <type>,
  `device_info` <type>,
  `id_last_session` INT UNSIGNED,

  PRIMARY KEY (`id_session`),

  FOREIGN KEY (`id_user`)
  REFERENCES `user`(`id_user`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,

  FOREIGN KEY (`id_last_session`)
  REFERENCES `session`(`id_session`)
  ON DELETE CASCADE
  ON UPDATE CASCADE
);




CREATE TABLE IF NOT EXISTS `picture` (
  `id_picture` INT UNSIGNED AUTO_INCREMENT NOT NULL,
  `id_session` INT UNSIGNED,
  `date` DATETIME,
  `path` <type>,
  `filter_path` <type>,

  PRIMARY KEY (`id_picture`),

  FOREIGN KEY (`id_session`)
  REFERENCES `session`(`id_session`)
  ON DELETE CASCADE
  ON UPDATE CASCADE
);




CREATE TABLE IF NOT EXISTS `like` (
  `id_session` INT UNSIGNED,
  `id_picture` INT UNSIGNED,

  PRIMARY KEY (`id_session`, `id_picture`),

  FOREIGN KEY (`id_session`)
  REFERENCES `session`(`id_session`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,

  FOREIGN KEY (`id_picture`)
  REFERENCES `picture`(`id_picture`)
  ON DELETE CASCADE
  ON UPDATE CASCADE
);




CREATE TABLE IF NOT EXISTS `comment` (
  `id_comment` INT UNSIGNED AUTO_INCREMENT NOT NULL,
  `id_session` INT UNSIGNED,
  `id_picture` INT UNSIGNED,
  `id_respond_to` INT UNSIGNED,
  `date` <type>,
  `content` <type>,

  PRIMARY KEY (`id_comment`),

  FOREIGN KEY (`id_session`)
  REFERENCES `session`(`id_session`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,

  FOREIGN KEY (`id_picture`)
  REFERENCES `picture`(`id_picture`)
  ON DELETE CASCADE
  ON UPDATE CASCADE,

  FOREIGN KEY (`id_respond_to`)
  REFERENCES `comment`(`id_comment`)
  ON DELETE CASCADE
  ON UPDATE CASCADE
);
