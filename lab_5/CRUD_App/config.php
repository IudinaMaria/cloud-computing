<?php

$master = new PDO(
    "mysql:host=project-rds-mysql-prod-maria.cpkwacqk64d0.eu-central-1.rds.amazonaws.com;dbname=project_db_maria;charset=utf8",
    "admin",
    "123456789"
);

$replica = new PDO(
    "mysql:host=project-rds-mysql-read-replica-maria.cpkwacqk64d0.eu-central-1.rds.amazonaws.com;dbname=project_db_maria;charset=utf8",
    "admin",
    "123456789"
);

$master->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$replica->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
