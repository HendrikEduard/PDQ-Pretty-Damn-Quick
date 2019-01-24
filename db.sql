
CREATE TABLE `persons` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(56) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(56) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE VIEW `person` AS
SELECT * FROM persons WHERE deleted=0;

INSERT INTO `persons` (`fname`, `lname`, `location`) VALUES
('John', 'Brown', 'Merrysville'),
('Susan', 'Smith', 'Geneva '),
('Tim', 'Leary', 'San Francisco'),
('Edward', 'Scissorhands', 'London'),
('Monty', 'Python', 'Glascow'),
('Eyore', ' ',	'the forest'),
('John Q', 'Public', 'Everywhere'),
('Tom', 'Sawyer', 'Huckletown'),
('Wiley E', 'Coyote', 'Palm Desert'),
('Osprey', 'Hawk', 'Seaside'),
('Jacob', 'Smith', 'Warsaw'),
('Tabitha', 'West', 'Vegas'),
('Martin', 'Martian', 'Mars'),
('George', 'of the', 'Jungle'),
('Tony', 'Baloney', 'New York');
