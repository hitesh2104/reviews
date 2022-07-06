ALTER TABLE `users`
CHANGE `user_role` `user_role` enum('ADMIN','CLIENT','CANDIDATE') COLLATE 'latin1_swedish_ci' NOT NULL AFTER `id`;

ALTER TABLE `booking`
ADD `job_id` int NOT NULL AFTER `client_id`,
ADD `additional_assessments` text NOT NULL AFTER `job_id`;

TRUNCATE TABLE assessments;
     
     
     INSERT INTO `assessments` (`id`, `name`, `type`, `description`, `cost`, `attachment_needed`, `status`, `is_deleted`, `created_date`, `updated_date`) VALUES
(1,    'Credit check',    'Credit check',    'Credit check',    '100',    0,    '1',    0,    '2017-04-18 23:18:07',    '2017-04-18 23:18:07'),
(2,    'ID Verification',    'ID Verification',    'ID Verification',    '100',    0,    '1',    0,    '2017-04-18 23:18:27',    '2017-04-18 23:18:27'),
(3,    'Criminal check',    'Criminal check',    'Criminal check',    '100',    0,    '1',    0,    '2017-04-18 23:18:27',    '2017-04-18 23:18:27'),
(4,    'Reference check',    'Reference check',    'Reference check',    '100',    0,    '1',    0,    '2017-04-18 23:18:27',    '2017-04-18 23:18:27'),
(5,    'Citizenship check',    'Citizenship check',    'Citizenship check',    '100',    0,    '1',    0,    '2017-04-18 23:18:27',    '2017-04-18 23:18:27');