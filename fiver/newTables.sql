
CREATE TABLE `flyies` (
  `ID` INT NOT NULL AUTO_INCREMENT,
  `routeID` VARCHAR(3) NULL,
  `direction` INT(1) NULL,
  `day` INT(1) NULL,
  `time` TIME NULL,
  `craftID` VARCHAR(3) NULL,
  PRIMARY KEY (`ID`),
  INDEX `FK_2_idx` (`craftID` ASC),
  INDEX `FK_1_idx` (`routeID` ASC),
  CONSTRAINT `FK_1`
    FOREIGN KEY (`routeID`)
    REFERENCES `routes` (`routeID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_2`
    FOREIGN KEY (`craftID`)
    REFERENCES `aircraft` (`craftID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
CREATE TABLE `user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  PRIMARY KEY (`user_id`));

CREATE TABLE `bookings` (
  `bookingID` INT NOT NULL AUTO_INCREMENT,
  `flyID` INT NULL,
  `dateTime` DATETIME NULL,
  `user_id` INT NULL,
  PRIMARY KEY (`bookingID`),
  INDEX `FK_3_idx` (`flyID` ASC),
  INDEX `FK_4_idx` (`user_id` ASC),
  CONSTRAINT `FK_3`
    FOREIGN KEY (`flyID`)
    REFERENCES `flyies` (`ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK_4`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

ALTER TABLE `aircraft` 
ADD COLUMN `pricemi` FLOAT NOT NULL AFTER `cruisekn`;

#R01
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R01', '0', '5', '13:00', 'A01');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R01', '1', '0', '13:00', 'A01');
#R02
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '0', '1', '7:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '0', '2', '7:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '0', '3', '7:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '0', '4', '7:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '0', '5', '7:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '1', '1', '12:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '1', '2', '12:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '1', '3', '12:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '1', '4', '12:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '1', '5', '12:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '0', '1', '14:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '0', '2', '14:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '0', '3', '14:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '0', '4', '14:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '0', '5', '14:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '1', '1', '19:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '1', '2', '19:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '1', '3', '19:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '1', '4', '19:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R02', '1', '5', '19:00', 'A02');
#R03
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R03', '0', '2', '4:00', 'A03');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R03', '0', '5', '4:00', 'A03');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R03', '1', '3', '9:00', 'A03');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R03', '1', '6', '9:00', 'A03');
#R04
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R04', '0', '1', '4:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R04', '0', '3', '4:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R04', '0', '5', '4:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R04', '1', '2', '9:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R04', '1', '5', '9:00', 'A02');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R04', '1', '6', '9:00', 'A02');
#R05
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R05', '0', '1', '10:00', 'A03');
INSERT INTO `flyies` (`routeID`, `direction`, `day`, `time`, `craftID`) VALUES ('R05', '1', '5', '10:00', 'A03');

UPDATE `aircraft` SET `pricemi`='20' WHERE `craftID`='A01';
UPDATE `aircraft` SET `pricemi`='15' WHERE `craftID`='A02';
UPDATE `aircraft` SET `pricemi`='10' WHERE `craftID`='A03';
