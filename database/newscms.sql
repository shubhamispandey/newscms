-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2021 at 01:28 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newscms`
--

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `category` varchar(100) NOT NULL,
  `post_date` varchar(50) NOT NULL,
  `author` int(11) NOT NULL,
  `post_img` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `title`, `description`, `category`, `post_date`, `author`, `post_img`) VALUES
(1, 'Punjab BJP leaders stage a sit-in oustside CM’s residence to protest attack on party legislator', 'Several Punjab BJP leaders on Sunday staged a sit-in outside the official residence of Chief Minister Amarinder Singh to protest against the attack on party legislator from Abohar in Muktsar.\r\n\r\nBJP MLA Arun Narang was allegedly roughed up and his clothes ripped off by a group of protesting farmers at Malout in Muktsar district on Saturday. The BJP leader had gone to Malout to address a press conference.\r\n\r\nAfter meeting the Punjab Governor on Sunday morning, BJP leaders under the leadership of chief of the party’s state unit Ashwani Sharma headed towards the chief minister\'\'s residence.\r\n\r\nA few BJP leaders even took off their shirts as a mark of protest.\r\n\r\nThe protesters raised slogans against the Congress-led government in the state, alleging that law and order has completely failed.\r\n\r\n“Does the opposition party (BJP) has no right to put forth its views,” asked Sharma while condemning the incident.', '1', '2021-03-21', 1, 'punjab.webp'),
(2, '3rd ODI: Moeen Ali dismisses Virat Kohli for 9th time in international cricket, joint 2nd most by an', 'India captain Virat Kohli fell to England spinner Moeen Ali for the 9th time in his international career during the third and decisive ODI in Pune on Sunday. The 32-year-old was batting on 7 when a Moeen Ali delivery took him by surprise and cleaned his leg stump.\r\n\r\nThe off-spinner has dismissed the talismanic batsman for the joint second most time in international cricket now. His bowling partner and \'good friend\' Adil Rashid has also got the better of Kohli on as many occasions.\r\n\r\nNotably, Moeen Ali had clean bowled Virat Kohli for a duck in the first innings of the 2nd Test match between India and England in Chennai. With that wicket, Moeen Ali had become the first spinner to dismiss the India skipper without even allowing him to open his account in the longest format.\r\n\r\nNew Zealand pacer Tim Southee has dismissed Kohli 10 times, the most by any bowler. Former England spinner Graeme Swann, Test specialist James Anderson and all-rounder Ben Stokes have got the wicket of Virat Kohli 8 times each.\r\n\r\nVirat Kohli\'s wicket on Sunday put India in a spot of bother as the team had lost the wickets of openers Rohit Sharma and Shikhar Dhawan in a span of 3 overs. Kohli departed 5 deliveries after the departure of Dhawan.', '5', '2021-03-26', 1, 'sport.webp'),
(3, 'Rajasthan: Man, daughter found dead, suicide suspected', 'Bikaner: A 65-year-old man and his daughter were found dead inside their home here, in a suspected case of suicide, police said on Sunday.\r\n\r\nShaukat Ali and his daughter Jonia (30) allegedly consumed poison and slit their wrists, police said.\r\n\r\nThe man’s elder daughter Babli (32) too slit her wrist but survived and is recuperating at a hospital, they added.\r\n\r\nThe incident took place in Dhobitalai area of the district, they said.\r\n\r\nAs no one from the family was answering the door, the neighbours informed police who broke into the house.\r\n\r\n“When we entered, Shaukat and Jonia were found dead while Babli was lying unconscious,” police said.\r\n\r\nSHO Kotegate Police Station Manoj Machra said prima facie, Shaukat and Jonia died due to poisoning because there was not much bleeding.\r\n\r\n“Babli is under treatment at the PBM hospital. The reason behind the suspected suicide is not clear yet and no suicide note was recovered from the house. The matter is under investigation,” he said.', '6', '2021-03-27', 1, 'suc.jpg'),
(4, 'Retired high court judge to probe corruption charges against me, says Anil Deshmukh', 'Maharashtra Home Minister Anil Deshmukh said on Sunday that the state government has decided to conduct a probe into the corruption allegations against him by a retired high court judge.\r\n\r\n“In the cabinet meeting, I had requested the chief minister to conduct an inquiry into the corruption allegations that were levelled against me by the former Mumbai police commissioner (Param Bir Singh). And the chief minister and state government has decided to conduct the probe through a retired high court judge. And now all the allegations will be probed and whatever the truth is, will come out,” Deshmukh said.\r\n\r\nAnil Deshmukh was asked to comment on the sharp attack on him made in the Shiv Sena’s party mouthpiece Saamana, which has said that Anil Deshmukh got the high-profile post only because senior NCP leaders Jayant Patil and Dileep Wales Patil had refused to accept it.\r\n\r\nBut while Deshmukh didn’t comment directly on the Saamana article, cabinet minister and NCP leader Nawab Malik hit back at the Sena saying they would not accept the remark that Anil Deshmukh was an ‘accidental home minister’.\r\n\r\nNawab Malik said, “Saamana has the right over its editorial content but we will not accept that Anil Deshmukh was an accidental home minister. He has been an MLA for five terms and has experience of nearly 18 years in various posts.”', '6', '2021-03-28', 2, 'anil.webp'),
(5, 'Throwback Thursday: Kangana’s Thalaivi shows attack on Jayalalithaa in Tamil Nadu Assembly. Here is ', 'Exactly 32 years ago, on March 25, 1989, what happened in Tamil Nadu Assembly changed the nature of politics in the state. Many say it laid the foundation of vendetta politics in Tamil Nadu.\r\n\r\nOn that day, then Chief Minister M Karunanidhi was pushed to the ground by Opposition AIADMK MLAs. To avenge the attack on Karunanidhi, Opposition leader J Jayalalithaa’s saree was pulled, and she was pushed by ruling DMK leaders.\r\n\r\nNational Award-winning actor Kangana Ranaut’s Thalaivi’s trailer released earlier this week shows what happened that day in Tamil Nadu Assembly. The film is based on late Jayalalithaa’s life. The 3.22-minute trailer shows the violence that changed political discourse of Tamil Nadu.\r\n\r\nWhat Happened In 1989?\r\nFirst, a little context.\r\n\r\nKarunanidhi was into his third term as Tamil Nadu chief minister. Around two weeks before the violent incident in the Assembly, a case of cheating had been filed against Jayalalithaa’s close aide Natarajan (the husband of VK Sasisakala). The police had raided his residence.\r\n\r\nAn angry Jayalalithaa threatened to resign. Her letter to the Speaker was leaked to the press, forcing her to change her mind. Jayalalithaa launched an attack on the Karunanidhi government, accusing it of tapping her phone and alleged police high-handedness at the behest of the ruling party.', '4', '2021-03-28', 2, 'thaliavi.webp'),
(6, 'West Bengal, Assam Phase 1 voting | HIGHLIGHTS', 'West Bengal, Assam Phase 1 voting | HIGHLIGHTS: Voting in phase 1 of West Bengal and Assam Assembly elections 2021 was held on Saturday. The polling in phase 1 of West Bengal and Assam Assembly elections started at 7 am and concluded at 6 pm. As per the data released by the Election Commission (EC), Bengal saw 79.79 per cent voter turnout by 6:20 pm and the same in Assam was 72.30 per cent. In phase 1 of West Bengal and Assam Assembly elections, over 1.54 crore voters were eligible to exercise their franchise to elect the next governments in the states. In West Bengal, voting was for 30 seats while in Assam, 47 seats were in fray in Phase 1.', '1', '2021-03-28', 4, 'bengal_voting_pti_1200x768.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
