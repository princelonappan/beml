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