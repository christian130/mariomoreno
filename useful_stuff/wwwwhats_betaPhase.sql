-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 12, 2016 at 01:48 AM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wwwwhats_betaPhase`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=352 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `author_id`, `post_id`, `text`, `date`) VALUES
(251, 3, 637, 'Director of parts & maintenance & general manager argued & would not discuss a solution to buy a new car since problem was "minor". They had neither read repair order until forced to see main bearings replaced w/ correct ones after removing motor from new car w/ 20k miles. They fired service writer because he told truth & they didn''t.', '2015-12-30 19:42:20'),
(250, 3, 637, 'Director of parts & maintenance & general manager argued & would not discuss a solution to buy a new car since problem was "minor". They had neither read repair order until forced to see main bearings replaced w/ correct ones after removing motor from new car w/ 20k miles. They fired service writer because he told truth & they didn''t.', '2015-12-30 19:42:20'),
(249, 3, 637, 'Director of parts & maintenance & general manager argued & would not discuss a solution to buy a new car since problem was "minor". They had neither read repair order until forced to see main bearings replaced w/ correct ones after removing motor from new car w/ 20k miles. They fired service writer because he told truth & they didn''t.', '2015-12-30 19:42:20'),
(248, 3, 633, 'Hours after Bill Cosby set foot in a Pennsylvania courtroom to face sexual assault charges, the comedian''s attorneys called the criminal case against him "unjustified" and vowed to fight it.\r\n\r\n"The charge by the Montgomery County District Attorney''s Office came as no surprise, filed 12 years after the alleged incident and coming on the heels of a hotly contested election for this county''s DA during which this case was made the focal point," Cosby''s attorneys said in a statement released after his arraignment Wednesday. "Make no mistake, we intend to mount a vigorous defense against this unjustified charge and we expect that Mr. Cosby will be exonerated by a court of law."', '2015-12-30 19:11:56'),
(247, 3, 633, 'Hours after Bill Cosby set foot in a Pennsylvania courtroom to face sexual assault charges, the comedian''s attorneys called the criminal case against him "unjustified" and vowed to fight it.\r\n\r\n"The charge by the Montgomery County District Attorney''s Office came as no surprise, filed 12 years after the alleged incident and coming on the heels of a hotly contested election for this county''s DA during which this case was made the focal point," Cosby''s attorneys said in a statement released after his arraignment Wednesday. "Make no mistake, we intend to mount a vigorous defense against this unjustified charge and we expect that Mr. Cosby will be exonerated by a court of law."', '2015-12-30 19:11:56'),
(246, 3, 633, 'Hours after Bill Cosby set foot in a Pennsylvania courtroom to face sexual assault charges, the comedian''s attorneys called the criminal case against him "unjustified" and vowed to fight it.\r\n\r\n"The charge by the Montgomery County District Attorney''s Office came as no surprise, filed 12 years after the alleged incident and coming on the heels of a hotly contested election for this county''s DA during which this case was made the focal point," Cosby''s attorneys said in a statement released after his arraignment Wednesday. "Make no mistake, we intend to mount a vigorous defense against this unjustified charge and we expect that Mr. Cosby will be exonerated by a court of law."', '2015-12-30 19:11:56'),
(245, 3, 634, 'Synthpop so indie you''ve never heard of it, emphasizing beauty over oontz.', '2015-12-30 19:09:26'),
(244, 3, 634, 'Synthpop so indie you''ve never heard of it, emphasizing beauty over oontz.', '2015-12-30 19:09:26'),
(243, 3, 634, 'Synthpop so indie you''ve never heard of it, emphasizing beauty over oontz.', '2015-12-30 19:09:26'),
(242, 3, 635, 'Synthpop so indie you''ve never heard of it, emphasizing beauty over oontz.', '2015-12-30 19:09:19'),
(241, 3, 635, 'Synthpop so indie you''ve never heard of it, emphasizing beauty over oontz.', '2015-12-30 19:09:19'),
(240, 3, 635, 'Synthpop so indie you''ve never heard of it, emphasizing beauty over oontz.', '2015-12-30 19:09:19'),
(239, 3, 636, 'Synthpop so indie you''ve never heard of it, emphasizing beauty over oontz.', '2015-12-30 19:08:57'),
(238, 3, 636, 'Synthpop so indie you''ve never heard of it, emphasizing beauty over oontz.', '2015-12-30 19:08:57'),
(237, 3, 636, 'Synthpop so indie you''ve never heard of it, emphasizing beauty over oontz.', '2015-12-30 19:08:57'),
(236, 3, 631, 'sad things are happening!!!', '2015-12-30 17:24:03'),
(235, 3, 631, 'sad things are happning', '2015-12-30 17:23:43'),
(234, 3, 567, 'This is a cool photo album!! ', '2015-12-25 18:29:43'),
(233, 3, 552, 'Can''t Wait for this to drop!!!', '2015-12-25 17:46:35'),
(232, 3, 539, 'Testing', '2015-12-25 17:24:32'),
(231, 3, 539, 'Testing', '2015-12-25 17:24:32'),
(230, 3, 539, 'Testing', '2015-12-25 17:24:32'),
(229, 3, 539, 'Testing', '2015-12-25 17:24:32'),
(228, 3, 539, '', '2015-12-25 17:24:18'),
(227, 3, 539, '', '2015-12-25 17:24:15'),
(226, 3, 540, 'That Baseline is SICCKKKKK!', '2015-12-25 17:19:48'),
(225, 2, 547, 'This is one hell of a track i remember when it first dropped!', '2015-12-25 17:18:54'),
(224, 2, 540, 'Classic shit!!!!!!', '2015-12-25 17:17:39'),
(223, 2, 547, 'test test test', '2015-12-25 17:17:06'),
(222, 2, 547, 'test test test', '2015-12-25 17:17:06'),
(221, 2, 547, 'test test test', '2015-12-25 17:17:06'),
(220, 2, 547, 'test test test', '2015-12-25 17:17:06'),
(252, 3, 637, 'Director of parts & maintenance & general manager argued & would not discuss a solution to buy a new car since problem was "minor". They had neither read repair order until forced to see main bearings replaced w/ correct ones after removing motor from new car w/ 20k miles. They fired service writer because he told truth & they didn''t.', '2015-12-30 19:42:20'),
(253, 2, 637, 'I took it to the dealer. Dealer said there is a recall on a leaking camshaft solenoid part that was causing oil to leak into the car''s wiring harness and all sorts of problems. It even sent oil into the Electronic Control Unit (ECU). Dealer said that the wiring harness, recalled part and ECU would be replaced which he did replaced.', '2015-12-30 19:43:01'),
(254, 2, 638, 'Lady face shaving ... The technical term for the practice is â€˜dermaplaningâ€™.', '2015-12-30 20:01:23'),
(255, 3, 638, 'While Somerville wonâ€™t reveal which of her A-list faces razor up, the proof is in her own flawless face.', '2015-12-30 20:02:05'),
(256, 3, 639, 'Wow!! She''s Hot!!!', '2015-12-30 20:31:55'),
(257, 2, 639, 'if i could get one night with her...I love asian women!', '2015-12-30 20:33:36'),
(258, 3, 654, 'Kingston Fire and Rescue recently announced support for a potentially lifesaving mobile application â€“ PulsePoint. CPR-trained individuals, who have downloaded the app, can be alerted when someone nearby is in cardiac arrest', '2016-01-02 09:32:56'),
(259, 3, 654, 'Kingston Fire and Rescue recently announced support for a potentially lifesaving mobile application â€“ PulsePoint. CPR-trained individuals, who have downloaded the app, can be alerted when someone nearby is in cardiac arrest', '2016-01-02 09:32:56'),
(260, 3, 651, 'The Mercedes-Benz SLK roadster was one of the earliest examples of the modern day open-top car. Earlier versions weren''t really sports cars; rather, they were open-top tourers. With each new model, the SLK moved more in the direction of genuine sports driving, perhaps not a full-on sports machine, except in AMG variants, but getting mighty close.', '2016-01-02 09:33:37'),
(261, 3, 651, 'The Mercedes-Benz SLK roadster was one of the earliest examples of the modern day open-top car. Earlier versions weren''t really sports cars; rather, they were open-top tourers. With each new model, the SLK moved more in the direction of genuine sports driving, perhaps not a full-on sports machine, except in AMG variants, but getting mighty close.', '2016-01-02 09:33:37'),
(262, 3, 655, 'The Mercedes-Benz SLK roadster was one of the earliest examples of the modern day open-top car. Earlier versions weren''t really sports cars; rather, they were open-top tourers. With each new model, the SLK moved more in the direction of genuine sports driving, perhaps not a full-on sports machine, except in AMG variants, but getting mighty close.', '2016-01-02 09:34:11'),
(263, 3, 655, 'The Mercedes-Benz SLK roadster was one of the earliest examples of the modern day open-top car. Earlier versions weren''t really sports cars; rather, they were open-top tourers. With each new model, the SLK moved more in the direction of genuine sports driving, perhaps not a full-on sports machine, except in AMG variants, but getting mighty close.', '2016-01-02 09:34:11'),
(264, 3, 656, 'Also in 2010, Ross made an offer to rapper Wiz Khalifa to sign to Maybach Music Group. Khalifa at the time was already signed with Atlantic Records', '2016-01-02 09:43:20'),
(265, 3, 656, 'Also in 2010, Ross made an offer to rapper Wiz Khalifa to sign to Maybach Music Group. Khalifa at the time was already signed with Atlantic Records', '2016-01-02 09:43:20'),
(266, 3, 648, 'Trevor Tahiem Smith, Jr., (born May 20, 1972)[2][3] better known by his stage name Busta Rhymes, is an American hip hop recording artist. Chuck D of Public Enemy gave him the moniker Busta Rhymes, after NFL wide receiver George "Buster" Rhymes. Early in his career, he was known for his wild style and fashion, and today is best known for his intricate rapping technique, which involves rapping at a fast rate with a lot of internal rhyme and half rhyme, and to date has received eleven Grammy nominations for his musical work.', '2016-01-02 10:08:44'),
(267, 3, 648, 'Trevor Tahiem Smith, Jr., (born May 20, 1972)[2][3] better known by his stage name Busta Rhymes, is an American hip hop recording artist. Chuck D of Public Enemy gave him the moniker Busta Rhymes, after NFL wide receiver George "Buster" Rhymes. Early in his career, he was known for his wild style and fashion, and today is best known for his intricate rapping technique, which involves rapping at a fast rate with a lot of internal rhyme and half rhyme, and to date has received eleven Grammy nominations for his musical work.', '2016-01-02 10:08:44'),
(268, 3, 648, 'Trevor Tahiem Smith, Jr., (born May 20, 1972)[2][3] better known by his stage name Busta Rhymes, is an American hip hop recording artist. Chuck D of Public Enemy gave him the moniker Busta Rhymes, after NFL wide receiver George "Buster" Rhymes. Early in his career, he was known for his wild style and fashion, and today is best known for his intricate rapping technique, which involves rapping at a fast rate with a lot of internal rhyme and half rhyme, and to date has received eleven Grammy nominations for his musical work.', '2016-01-02 10:08:44'),
(269, 3, 648, 'This was released in September 1997 under the Flipmode and Elektra label. This album also reached platinum status selling 1,677,000 copies in the US and reached number one in the R&B charts and number three in the regular charts in the US. It got to number 21 in Canada, 34 in the UK and 62 in Germany. ', '2016-01-02 10:35:21'),
(270, 3, 660, '$3 THURSDAY @BLNDTGER EVERY THURSDAY 559 COLLEGE STREET WEST @ BLND TGER\r\n\r\n$3 THURSDAY @BLNDTGER EVERY THURSDAY 559 COLLEGE STREET WEST Details\r\n\r\n\r\n#â€ŽLadiesFreeB4Midnight $3THURSDAYS COLLEGE/UNIVERSITY NIGHT W/$100 BOTTLES â€ª#â€ŽEveryThursdayNightâ€¬ Torontoâ€™s New Social Experiment at BLND TGER w/Hip Hop, R&B, TRAP & Reggae #EveryThursdayNight with a prohibition theme\r\n', '2016-01-02 12:13:26'),
(271, 3, 661, 'Raekwon rings in the new year with a new mixtape "Unexpected Victory" ft. Mobb Deep, Capone N Noreaga, Styles P & production from 9th wonder & more. Enjoy, and Happy New Year!', '2016-01-02 12:39:27'),
(272, 2, 662, 'Anybody but me catch how French Montana basically stole this entire beat and used it for off the rip with chinx and nore? I feel like nobody knows this shit but me lolï»¿', '2016-01-02 12:50:57'),
(273, 2, 664, 'Club magazine, which contains in-depth reports about the latest trends throughout the world as well as a unique selection of local, regional and global events.', '2016-01-02 13:05:07'),
(274, 2, 661, 'He never seem to disappoint Legend!! Wu-Tang FOREVER!!!', '2016-01-02 13:49:12'),
(275, 2, 661, 'He never seem to disappoint Legend!! Wu-Tang FOREVER!!!', '2016-01-02 13:49:12'),
(276, 3, 664, 'This shit is Siiicccckkkkk', '2016-01-02 13:50:12'),
(277, 3, 662, 'Classic track boyyyy! #Fire', '2016-01-02 13:50:30'),
(278, 3, 591, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:07:57'),
(279, 3, 628, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:08:35'),
(280, 3, 629, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:08:40'),
(281, 3, 640, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:08:49'),
(282, 3, 640, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:08:52'),
(283, 3, 640, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:08:56'),
(284, 3, 629, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:09:03'),
(285, 3, 628, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:09:06'),
(286, 3, 587, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:09:20'),
(287, 3, 588, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:09:22'),
(288, 3, 567, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:09:27'),
(289, 3, 559, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:09:42'),
(290, 3, 539, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:09:56'),
(291, 3, 537, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:10:15'),
(292, 3, 537, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:10:20'),
(293, 3, 538, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:10:29'),
(294, 3, 556, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:12:23'),
(295, 3, 555, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:12:29'),
(296, 3, 554, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:12:37'),
(297, 3, 540, 'Anthony Cruz (born March 9, 1972), better known by his stage name AZ, is an American rapper. Born in Brooklyn, NY. He is known for being a longtime and frequent rhyme partner of Nas, and also a member of hip-hop group The Firm alongside Nas, Foxy Brown, Cormega and Nature.', '2016-01-03 11:12:45'),
(298, 3, 677, 'It will help you to explore your web page around the world market.', '2016-01-04 01:27:25'),
(299, 3, 677, 'It will help you to explore your web page around the world market.', '2016-01-04 01:27:25'),
(300, 3, 671, 'The Guinness Record for the Largest Synchronized Car Dance was set in Dubai on July 24 2015 and had 121 cars form an animated peace sign. Source:', '2016-01-04 11:39:24'),
(301, 3, 671, 'The Guinness Record for the Largest Synchronized Car Dance was set in Dubai on July 24 2015 and had 121 cars form an animated peace sign. Source:', '2016-01-04 11:39:24'),
(302, 3, 672, 'The Guinness Record for the Largest Synchronized Car Dance was set in Dubai on July 24 2015 and had 121 cars form an animated peace sign. Source:', '2016-01-04 11:39:30'),
(303, 3, 672, 'The Guinness Record for the Largest Synchronized Car Dance was set in Dubai on July 24 2015 and had 121 cars form an animated peace sign. Source:', '2016-01-04 11:39:30'),
(304, 3, 673, 'The Guinness Record for the Largest Synchronized Car Dance was set in Dubai on July 24 2015 and had 121 cars form an animated peace sign. Source:', '2016-01-04 11:39:37'),
(305, 3, 673, 'The Guinness Record for the Largest Synchronized Car Dance was set in Dubai on July 24 2015 and had 121 cars form an animated peace sign. Source:', '2016-01-04 11:39:37'),
(306, 3, 674, 'The Guinness Record for the Largest Synchronized Car Dance was set in Dubai on July 24 2015 and had 121 cars form an animated peace sign. Source:', '2016-01-04 11:39:57'),
(307, 3, 674, 'The Guinness Record for the Largest Synchronized Car Dance was set in Dubai on July 24 2015 and had 121 cars form an animated peace sign. Source:', '2016-01-04 11:39:57'),
(308, 3, 675, 'The Guinness Record for the Largest Synchronized Car Dance was set in Dubai on July 24 2015 and had 121 cars form an animated peace sign. Source:', '2016-01-04 11:40:10'),
(309, 3, 675, 'The Guinness Record for the Largest Synchronized Car Dance was set in Dubai on July 24 2015 and had 121 cars form an animated peace sign. Source:', '2016-01-04 11:40:10'),
(310, 3, 678, 'The Guinness Record for the Largest Synchronized Car Dance was set in Dubai on July 24 2015 and had 121 cars form an animated peace sign. Source:', '2016-01-04 11:40:31'),
(311, 3, 678, 'The Guinness Record for the Largest Synchronized Car Dance was set in Dubai on July 24 2015 and had 121 cars form an animated peace sign. Source:', '2016-01-04 11:40:31'),
(312, 3, 681, 'Done in pure cotton, this hoodie features a cool crossover neckline and stitched paneling at the sides. By Sean John.\r\nHood with crossover front; V-neck\r\nStitch details at sides\r\nRibbed cuffs and hem\r\nCotton\r\nMachine washable\r\nImported\r\nWeb ID: 2250687', '2016-01-04 20:17:48'),
(313, 3, 682, 'New Yorkâ€”often called New York City or the City of New York to distinguish it from the State of New York, of which it is a partâ€”is the most populous city in the United States[1] and the center of the New York metropolitan area, the premier gateway for legal immigration to the United States[9][10][11] and one of the most populous urban agglomerations in the world.', '2016-01-04 20:32:02'),
(314, 3, 683, 'Toronto (Listeni/tÉµËˆrÉ’ntoÊŠ/, local /tÉ™ËˆrÉ’noÊŠ/ or /ËˆtrÉ’n-/) is the most populous city in Canada,[10] the provincial capital of Ontario,[11] and the centre of the Greater Toronto Area, the most populous metropolitan area in Canada.', '2016-01-04 20:37:44'),
(315, 3, 680, 'Toronto (Listeni/tÉµËˆrÉ’ntoÊŠ/, local /tÉ™ËˆrÉ’noÊŠ/ or /ËˆtrÉ’n-/) is the most populous city in Canada,[10] the provincial capital of Ontario,[11] and the centre of the Greater Toronto Area, the most populous metropolitan area in Canada.', '2016-01-04 20:40:29'),
(316, 3, 679, 'Toronto (Listeni/tÉµËˆrÉ’ntoÊŠ/, local /tÉ™ËˆrÉ’noÊŠ/ or /ËˆtrÉ’n-/) is the most populous city in Canada,[10] the provincial capital of Ontario,[11] and the centre of the Greater Toronto Area, the most populous metropolitan area in Canada.', '2016-01-04 20:40:34'),
(317, 3, 684, 'Toronto (Listeni/tÉµËˆrÉ’ntoÊŠ/, local /tÉ™ËˆrÉ’noÊŠ/ or /ËˆtrÉ’n-/) is the most populous city in Canada,[10] the provincial capital of Ontario,[11] and the centre of the Greater Toronto Area, the most populous metropolitan area in Canada.', '2016-01-05 20:41:23'),
(318, 3, 684, 'Toronto (Listeni/tÉµËˆrÉ’ntoÊŠ/, local /tÉ™ËˆrÉ’noÊŠ/ or /ËˆtrÉ’n-/) is the most populous city in Canada,[10] the provincial capital of Ontario,[11] and the centre of the Greater Toronto Area, the most populous metropolitan area in Canada.', '2016-01-05 20:41:23'),
(319, 3, 684, 'Toronto (Listeni/tÉµËˆrÉ’ntoÊŠ/, local /tÉ™ËˆrÉ’noÊŠ/ or /ËˆtrÉ’n-/) is the most populous city in Canada,[10] the provincial capital of Ontario,[11] and the centre of the Greater Toronto Area, the most populous metropolitan area in Canada.', '2016-01-05 20:41:23'),
(320, 3, 684, 'Toronto (Listeni/tÉµËˆrÉ’ntoÊŠ/, local /tÉ™ËˆrÉ’noÊŠ/ or /ËˆtrÉ’n-/) is the most populous city in Canada,[10] the provincial capital of Ontario,[11] and the centre of the Greater Toronto Area, the most populous metropolitan area in Canada.', '2016-01-05 20:41:23'),
(321, 3, 684, 'Toronto (Listeni/tÉµËˆrÉ’ntoÊŠ/, local /tÉ™ËˆrÉ’noÊŠ/ or /ËˆtrÉ’n-/) is the most populous city in Canada,[10] the provincial capital of Ontario,[11] and the centre of the Greater Toronto Area, the most populous metropolitan area in Canada.', '2016-01-05 20:41:23'),
(322, 3, 685, 'Toronto (Listeni/tÉµËˆrÉ’ntoÊŠ/, local /tÉ™ËˆrÉ’noÊŠ/ or /ËˆtrÉ’n-/) is the most populous city in Canada,[10] the provincial capital of Ontario,[11] and the centre of the Greater Toronto Area, the most populous metropolitan area in Canada.', '2016-01-05 20:42:01'),
(323, 3, 686, 'Toronto (Listeni/tÉµËˆrÉ’ntoÊŠ/, local /tÉ™ËˆrÉ’noÊŠ/ or /ËˆtrÉ’n-/) is the most populous city in Canada,[10] the provincial capital of Ontario,[11] and the centre of the Greater Toronto Area, the most populous metropolitan area in Canada.', '2016-01-05 20:42:06'),
(324, 3, 688, 'heyyy girl i like what i see. Why dont you send me a direct messages is i know its real...', '2016-01-05 21:47:17'),
(325, 3, 688, 'heyyy girl i like what i see. Why dont you send me a direct messages is i know its real...', '2016-01-05 21:47:17'),
(326, 11, 702, 'wowwww she''ssss hot....does she want a girl friend????', '2016-01-07 19:14:17'),
(327, 3, 703, 'looks like fun!!', '2016-01-07 19:50:13'),
(328, 3, 730, 'Cool congrats on your new purchase!!!', '2016-01-08 19:21:32'),
(329, 3, 744, 'Toronto (Listeni/tÉµËˆrÉ’ntoÊŠ/, local /tÉ™ËˆrÉ’noÊŠ/ or /ËˆtrÉ’n-/) is the most populous city in Canada,[10] the provincial capital of Ontario,[11] and the centre of the Greater Toronto Area, the most populous metropolitan area in Canada.', '2016-01-11 18:50:01'),
(330, 3, 744, 'Toronto (Listeni/tÉµËˆrÉ’ntoÊŠ/, local /tÉ™ËˆrÉ’noÊŠ/ or /ËˆtrÉ’n-/) is the most populous city in Canada,[10] the provincial capital of Ontario,[11] and the centre of the Greater Toronto Area, the most populous metropolitan area in Canada.', '2016-01-11 18:50:01'),
(331, 3, 744, 'Toronto (Listeni/tÉµËˆrÉ’ntoÊŠ/, local /tÉ™ËˆrÉ’noÊŠ/ or /ËˆtrÉ’n-/) is the most populous city in Canada,[10] the provincial capital of Ontario,[11] and the centre of the Greater Toronto Area, the most populous metropolitan area in Canada.', '2016-01-11 18:50:01'),
(332, 3, 749, 'Tidal (stylized as TIDAL, also known as TIDALHiFi) is a subscription-based music streaming service that combines lossless audio and high definition music videos with curated editorial. The service has over 35 million tracks and 85,000 music videos.', '2016-01-11 21:42:59'),
(333, 3, 749, 'Tidal (stylized as TIDAL, also known as TIDALHiFi) is a subscription-based music streaming service that combines lossless audio and high definition music videos with curated editorial. The service has over 35 million tracks and 85,000 music videos.', '2016-01-11 21:43:00'),
(334, 3, 749, 'Tidal (stylized as TIDAL, also known as TIDALHiFi) is a subscription-based music streaming service that combines lossless audio and high definition music videos with curated editorial. The service has over 35 million tracks and 85,000 music videos.', '2016-01-11 21:43:00'),
(335, 3, 754, 'Every great innovation inspires the next. 127 years of sound led to our next great leap in listening: Apple Music.\r\n', '2016-01-11 21:54:59'),
(336, 3, 753, 'Every great innovation inspires the next. 127 years of sound led to our next great leap in listening: Apple Music.\r\n', '2016-01-11 21:55:06'),
(337, 3, 752, 'Every great innovation inspires the next. 127 years of sound led to our next great leap in listening: Apple Music.\r\n', '2016-01-11 21:55:21'),
(338, 3, 775, 'dope music', '2016-01-20 21:08:17'),
(339, 3, 817, '"No Pimpin''!" "Straight Preachin''!." - The Pastor & Message Behind One of Detroit''s Most Provocative Billboards: ', '2016-01-26 16:50:57'),
(340, 3, 843, 'hihi', '2016-02-01 12:31:31'),
(341, 3, 843, 'hihi', '2016-02-01 12:31:31'),
(342, 3, 843, 'hihi', '2016-02-01 12:31:31'),
(343, 3, 812, 'hi', '2016-02-03 11:50:12'),
(344, 3, 812, 'hi', '2016-02-03 11:50:12'),
(345, 3, 812, 'hi ihi', '2016-02-03 11:50:20'),
(346, 3, 812, 'hi ihi', '2016-02-03 11:50:20'),
(347, 3, 812, 'hi ihi', '2016-02-03 11:50:26'),
(348, 3, 812, 'hi ihi', '2016-02-03 11:50:26'),
(349, 3, 1239, 'write something', '2016-03-12 00:21:47'),
(350, 3, 1238, 'write it down', '2016-03-12 01:46:55'),
(351, 3, 1238, 'write it down write it down again', '2016-03-12 01:46:55');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
