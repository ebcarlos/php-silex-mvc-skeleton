CREATE TABLE `user` (
  `id`           INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name`   VARCHAR(50)      NOT NULL,
  `last_name`    VARCHAR(50)      NOT NULL,
  `password`     CHAR(128)        NOT NULL,
  `username`     VARCHAR(20)      NOT NULL,
  `created_date` DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_udx` (`username`)
)
  ENGINE =InnoDB
AUTO_INCREMENT
  DEFAULT CHARSET = latin1;

CREATE TABLE `finance` (
  `id`      INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `store`   VARCHAR(50)      NOT NULL,
  `amount`  DECIMAL(19, 2)   NOT NULL,
  `user_id` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE =InnoDB
AUTO_INCREMENT
  DEFAULT CHARSET = latin1;

CREATE TABLE `finance_to_tag` (
  `id`         INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `finance_id` INT(10) UNSIGNED NOT NULL,
  `tag_id`     INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `finance_id` (`finance_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `finance_id_fk` FOREIGN KEY (`finance_id`) REFERENCES `finance` (`id`),
  CONSTRAINT `tag_id_fk` FOREIGN KEY (`tag_id`) REFERENCES `finance_tag` (`id`)
)
  ENGINE =InnoDB
AUTO_INCREMENT
  DEFAULT CHARSET = latin1

CREATE TABLE `finance_to_tag` (
  `id`         INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `finance_id` INT(10) UNSIGNED NOT NULL,
  `tag_id`     INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `finance_tag_udx` (`finance_id`, `tag_id`),
  KEY `finance_id` (`finance_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `finance_id_fk` FOREIGN KEY (`finance_id`) REFERENCES `finance` (`id`),
  CONSTRAINT `tag_id_fk` FOREIGN KEY (`tag_id`) REFERENCES `finance_tag` (`id`)
)
  ENGINE =InnoDB
AUTO_INCREMENT
  DEFAULT CHARSET = latin1;

INSERT INTO `finance_tag`
(tag)
VALUES
  ('Restaurant'),
  ('Gas');