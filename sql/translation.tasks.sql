/*
-- Query: SELECT * FROM translations.tasks
LIMIT 0, 1000

-- Date: 2017-09-07 16:44
*/

CREATE TABLE `tasks` (
  `task_id` varchar(255) NOT NULL,
  `languages` varchar(45) DEFAULT NULL COMMENT 'needs a connection to a dictionary of languages',
  `tasks_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date of task creation',
  `user_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `original_document_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `tasks` (`task_id`,`languages`,`tasks_date`,`user_id`,`title`,`state`,`original_document_id`) VALUES ('XCNT-1833','MX,PL,RU,TR','2017-05-24 11:19:59','amarcione','Translation of the tHM PRO Playbook','Done',464905);
INSERT INTO `tasks` (`task_id`,`languages`,`tasks_date`,`user_id`,`title`,`state`,`original_document_id`) VALUES ('XCNT-2199','BR,DE,ES,FR,GR,IT,MX,NL,PL,PT,RU,TR','2017-07-11 11:46:43','amarcione','Translation of Zendesk PRO template','In Progress',481118);
INSERT INTO `tasks` (`task_id`,`languages`,`tasks_date`,`user_id`,`title`,`state`,`original_document_id`) VALUES ('XCNT-2665','ES,IT','2017-09-04 10:13:21','amarcione','Translation of event material (flyer, one-pagers, folder)','In Progress',498801);
