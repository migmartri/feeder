CREATE TABLE `feeder`.`favourites` (
  `user_id` int  NOT NULL,
  `post_id` int  NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`user_id`, `post_id`)
)
ENGINE = MyISAM;

