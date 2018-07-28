--
-- 08/01/2018
--

ALTER TABLE  `users` ADD  `mobile_number` INT( 15 ) NULL DEFAULT NULL AFTER  `employee_id` ;

--
-- Table structure for table `otp_authentication`
--

CREATE TABLE `otp_authentication` (
  `id` int(11) NOT NULL,
  `mobile_number` int(11) NOT NULL,
  `otp` int(11) NOT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT '0',
  `created_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `otp_authentication`
--
ALTER TABLE `otp_authentication`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `otp_authentication`
--
ALTER TABLE `otp_authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `otp_authentication` ADD `type` TINYINT NULL COMMENT '1- signup 2 - forgot password' AFTER `created_date`;
ALTER TABLE `otp_authentication` CHANGE `created_date` `created_date` DATETIME NULL DEFAULT NULL;
ALTER TABLE `users` CHANGE `mobile_number` `mobile_number` VARCHAR(15) NULL DEFAULT NULL;
ALTER TABLE `otp_authentication` CHANGE `mobile_number` `mobile_number` VARCHAR(15) NOT NULL;
ALTER TABLE `otp_authentication` CHANGE `otp` `otp` VARCHAR(8) NOT NULL;
--
ALTER TABLE `otp_authentication` ADD `message_response` TEXT NULL AFTER `type`;
ALTER TABLE `users` ADD `reset_password_token` VARCHAR(120) NULL AFTER `is_registered`;
ALTER TABLE `otp_authentication` CHANGE `is_verified` `is_verified` TINYINT(4) NOT NULL DEFAULT '0' COMMENT '1 - Yes 0 - No';


ALTER TABLE `otp_authentication` ADD `employee_id` VARCHAR(255) NULL AFTER `mobile_number`;

ALTER TABLE `like` ADD `like_type` INT(4) NULL AFTER `liked_by`;
ALTER TABLE `users` ADD `email` VARCHAR(155) NULL AFTER `name`;

ALTER TABLE `post` CHANGE `like_count` `like_count` TEXT NULL;
ALTER TABLE `post` CHANGE `like_count` `like_count` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'json format for each like type ';
UPDATE `post` SET `like_count` = NULL;
ALTER TABLE `post` ADD `like_total_count` TINYINT(5) NOT NULL DEFAULT '0' AFTER `like_count`;

ALTER TABLE `post` ADD `created_by` INT NULL AFTER `created_date`;
UPDATE post set created_by = '3';

ALTER TABLE `users` ADD `is_comment_share_post` TINYINT(2) NULL AFTER `email`, ADD `admin_role` TINYINT(2) NOT NULL DEFAULT '0' AFTER `is_comment_share_post`;
ALTER TABLE `users` ADD `is_admin_user` TINYINT(2) NOT NULL AFTER `is_comment_share_post`;

INSERT INTO `users` (`id`, `employee_id`, `mobile_number`, `name`, `email`, `is_comment_share_post`, `is_admin_user`, `admin_role`, `password`, `date_of_birth`, `date_of_join`, `user_profile_image`, `is_registered`, `reset_password_token`, `status`, `created_date`, `modified_date`) VALUES (NULL, NULL, NULL, NULL, 'princelonappan07@gmail.com', NULL, '1', '1', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, '0', NULL, '1', '2018-02-18', '2018-02-18');
ALTER TABLE `users` CHANGE `is_comment_share_post` `is_comment_share_post` TINYINT(2) NULL DEFAULT '1';

ALTER TABLE `post` CHANGE `created_date` `created_date` DATETIME NOT NULL;
ALTER TABLE `post` CHANGE `modified_date` `modified_date` DATETIME NOT NULL

ALTER TABLE `post` ADD `media_available` TINYINT(3) NOT NULL DEFAULT '1' AFTER `category_id`;