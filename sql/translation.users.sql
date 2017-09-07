/*
-- Query: SELECT * FROM translations.users
LIMIT 0, 1000

-- Date: 2017-09-07 16:43
*/
CREATE TABLE `users` (
  `user_id` varchar(255) NOT NULL,
  `task_id` varchar(45) NOT NULL,
  `talent` varchar(255) NOT NULL COMMENT 'name of Trivago staff',
  `email` varchar(255) DEFAULT NULL COMMENT 'Placeholder for name?',
  PRIMARY KEY (`user_id`,`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `users` (`user_id`,`task_id`,`talent`,`email`) VALUES ('acristovao','XCNT-1833','Adelina Cristovao','adelina.cristovao@trivago.com');
INSERT INTO `users` (`user_id`,`task_id`,`talent`,`email`) VALUES ('acristovao','XCNT-2199','Adelina Cristovao','adelina.cristovao@trivago.com');
INSERT INTO `users` (`user_id`,`task_id`,`talent`,`email`) VALUES ('acristovao','XCNT-2665','Adelina Cristovao','adelina.cristovao@trivago.com');
INSERT INTO `users` (`user_id`,`task_id`,`talent`,`email`) VALUES ('agras','XCNT-2199','Angeline Gras','Angeline.Gras@trivago.com');
INSERT INTO `users` (`user_id`,`task_id`,`talent`,`email`) VALUES ('amarcione','XCNT-1833','Andrew Marcione','Andrew.Marcione@trivago.com');
INSERT INTO `users` (`user_id`,`task_id`,`talent`,`email`) VALUES ('amarcione','XCNT-2199','Andrew Marcione','Andrew.Marcione@trivago.com');
INSERT INTO `users` (`user_id`,`task_id`,`talent`,`email`) VALUES ('amarcione','XCNT-2665','Andrew Marcione','Andrew.Marcione@trivago.com');
INSERT INTO `users` (`user_id`,`task_id`,`talent`,`email`) VALUES ('ecaschera','XCNT-1833','Emanuela Caschera','Emanuela.Caschera@trivago.com');
INSERT INTO `users` (`user_id`,`task_id`,`talent`,`email`) VALUES ('ecaschera','XCNT-2199','Emanuela Caschera','Emanuela.Caschera@trivago.com');
INSERT INTO `users` (`user_id`,`task_id`,`talent`,`email`) VALUES ('fhuettenhoff','XCNT-1833','Fabian Huettenhoff','Fabian.Huettenhoff@trivago.com');
INSERT INTO `users` (`user_id`,`task_id`,`talent`,`email`) VALUES ('kkaveh','XCNT-2199','Kiana Kaveh','Kiana.Kaveh@trivago.com');
INSERT INTO `users` (`user_id`,`task_id`,`talent`,`email`) VALUES ('mcarletti','XCNT-2199','Michela Carletti','michela.carletti@trivago.com');
INSERT INTO `users` (`user_id`,`task_id`,`talent`,`email`) VALUES ('pribeiro','XCNT-1833','Pedro Ribeiro','Pedro.Ribeiro@trivago.com');
INSERT INTO `users` (`user_id`,`task_id`,`talent`,`email`) VALUES ('rmunoz','XCNT-2199','Ricardo Muñoz','Ricardo.Munoz@trivago.com');
INSERT INTO `users` (`user_id`,`task_id`,`talent`,`email`) VALUES ('rmunoz','XCNT-2665','Ricardo Muñoz','Ricardo.Munoz@trivago.com');
