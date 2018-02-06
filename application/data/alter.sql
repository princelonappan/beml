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