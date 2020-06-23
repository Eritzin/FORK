
--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `jobsId` int(11) NOT NULL,
  `jobTitle` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `jLocation` varchar(255) NOT NULL,
  `technologies` varchar(255) NOT NULL,
  `salary` varchar(255) NOT NULL,
  `hours` varchar(255) NOT NULL,
  `active` enum('0','1') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `moreSkills` varchar(500) NOT NULL,
  `fk_businessId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jobsId`, `jobTitle`, `description`, `jLocation`, `technologies`, `salary`, `hours`, `active`, `timestamp`, `moreSkills`, `fk_businessId`) VALUES
(1, 'Junior front end developer Symfony', 'asdLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'Vienna', '', '2500$', '38', '1', '2020-05-13 15:17:12', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 5),
(2, 'Junior back-end developer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'Vienna', '', '2500$', '30', '1', '2020-05-13 15:17:24', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 5),
(3, 'Junior back-end developer JAVA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'Graz', '', '2500$', '38', '1', '2020-05-13 15:17:33', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 5),
(4, 'Junior back-end developer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 's', '', '2500€', '30', '1', '2020-05-13 15:18:14', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 5),
(6, 'Junior front end developer Symfony', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'Japane', '', '2500$', '40', '1', '2020-05-13 15:17:47', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 5),
(8, 'Junior back-end developer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'Vienna', '', '2500$', '38', '1', '2020-05-13 15:18:24', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 5),
(9, 'Junior back-end developer', '141414', 'Vienna', '', '2500$', '38', '1', '2020-04-25 13:45:57', '14141', 5),
(10, 'Junior back-end developer', '141414', 'Vienna', '', '2500$', '38', '1', '2020-04-25 13:48:16', '14141', 5),
(13, 'Junior back-end developer', '1111111111111111', 'Vienna', '', '2500$', '38', '1', '2020-04-25 13:53:33', '14141', 5);

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `skillId` int(11) NOT NULL,
  `skill_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`skillId`, `skill_name`) VALUES
(1, 'HTML'),
(2, 'CSS'),
(3, 'JavaScript'),
(4, 'Bootstrap'),
(5, 'MySql'),
(6, 'php'),
(7, 'symfony'),
(8, 'python'),
(9, 'JAVA'),
(10, 'Typescript'),
(11, 'C++'),
(12, 'Jquery'),
(13, 'Latex'),
(14, 'Angular');

-- --------------------------------------------------------

--
-- Table structure for table `skill_alumni`
--

CREATE TABLE `skill_alumni` (
  `skillAlId` int(11) NOT NULL,
  `fk_alumniId` int(11) NOT NULL,
  `fk_skillId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skill_alumni`
--

INSERT INTO `skill_alumni` (`skillAlId`, `fk_alumniId`, `fk_skillId`) VALUES
(1, 11, 8);

-- --------------------------------------------------------

--
-- Table structure for table `skill_jobs`
--

CREATE TABLE `skill_jobs` (
  `skillJId` int(11) NOT NULL,
  `fk_jobsId` int(11) NOT NULL,
  `fk_skillId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`alumniId`);

--
-- Indexes for table `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`businessId`);

--
-- Indexes for table `favalumni`
--
ALTER TABLE `favalumni`
  ADD PRIMARY KEY (`favalumniId`),
  ADD KEY `fk_businessId` (`fk_businessId`),
  ADD KEY `fk_alumniId` (`fk_alumniId`);

--
-- Indexes for table `fav_jobs`
--
ALTER TABLE `fav_jobs`
  ADD PRIMARY KEY (`favJobId`),
  ADD KEY `fk_alumniId` (`fk_alumniId`),
  ADD KEY `fk_jobsId` (`fk_jobsId`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jobsId`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`skillId`);

--
-- Indexes for table `skill_alumni`
--
ALTER TABLE `skill_alumni`
  ADD PRIMARY KEY (`skillAlId`),
  ADD KEY `fk_alumniId` (`fk_alumniId`),
  ADD KEY `fk_skillId` (`fk_skillId`);

--
-- Indexes for table `skill_jobs`
--
ALTER TABLE `skill_jobs`
  ADD KEY `fk_skillId` (`fk_skillId`),
  ADD KEY `fk_jobsId` (`fk_jobsId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `alumniId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `business`
--
ALTER TABLE `business`
  MODIFY `businessId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `favalumni`
--
ALTER TABLE `favalumni`
  MODIFY `favalumniId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fav_jobs`
--
ALTER TABLE `fav_jobs`
  MODIFY `favJobId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `skillId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `skill_alumni`
--
ALTER TABLE `skill_alumni`
  MODIFY `skillAlId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favalumni`
--
ALTER TABLE `favalumni`
  ADD CONSTRAINT `favalumni_ibfk_1` FOREIGN KEY (`fk_businessId`) REFERENCES `business` (`businessId`),
  ADD CONSTRAINT `favalumni_ibfk_2` FOREIGN KEY (`fk_alumniId`) REFERENCES `alumni` (`alumniId`);

--
-- Constraints for table `fav_jobs`
--
ALTER TABLE `fav_jobs`
  ADD CONSTRAINT `fav_jobs_ibfk_1` FOREIGN KEY (`fk_alumniId`) REFERENCES `alumni` (`alumniId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fav_jobs_ibfk_2` FOREIGN KEY (`fk_jobsId`) REFERENCES `jobs` (`jobsId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `skill_alumni`
--
ALTER TABLE `skill_alumni`
  ADD CONSTRAINT `skill_alumni_ibfk_1` FOREIGN KEY (`fk_alumniId`) REFERENCES `alumni` (`alumniId`),
  ADD CONSTRAINT `skill_alumni_ibfk_2` FOREIGN KEY (`fk_skillId`) REFERENCES `skill` (`skillId`);

--
-- Constraints for table `skill_jobs`
--
ALTER TABLE `skill_jobs`
  ADD CONSTRAINT `skill_jobs_ibfk_1` FOREIGN KEY (`fk_skillId`) REFERENCES `skill` (`skillId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `skill_jobs_ibfk_2` FOREIGN KEY (`fk_jobsId`) REFERENCES `jobs` (`jobsId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
