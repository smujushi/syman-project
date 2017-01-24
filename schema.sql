CREATE TABLE IF NOT EXISTS `beta_player` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `now` date NOT NULL,
  `player_id` int(11) NOT NULL,
  `score` varchar(32) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
)

CREATE TABLE IF NOT EXISTS `beta_rounds` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `open` int(11) NOT NULL,
  `start` date NOT NULL,
  PRIMARY KEY (`ID`)
)
