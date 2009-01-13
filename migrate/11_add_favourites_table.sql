CREATE TABLE `feeder`.`favourites` (
  `user_id` int  NOT NULL,
  `post_id` int  NOT NULL,
  `created_at` datetime  NOT NULL,
  PRIMARY KEY (`user_id`, `post_id`)
)
ENGINE = MyISAM;
