<?php
$servername = "127.0.0.1"; //"localhost";
$dbusername = "root";
$dbpassword = "";

// Creating a connection
$conn = new mysqli($servername, $dbusername, $dbpassword);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// Creating a database named newDB
$sql = "CREATE DATABASE helpdesk";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
    header("refresh:2;url=index.php");
} else {
  echo "Error creating database: " . $conn->error;
}
// closing connection
$conn->close();

$database = "helpdesk";
$con = mysqli_connect($servername, $dbusername, $dbpassword, $database) or die("incorrect credation!");
/* mysql_select_db($database) or die("Unknownbase"); */
$queryDept = "
CREATE TABLE `departments` (
`id` int NOT NULL AUTO_INCREMENT,
`name` varchar(50) NOT NULL,
`hidden` int NOT NULL,
PRIMARY KEY (`id`)
)";
$result = mysqli_query($con, $queryDept) or die(mysqli_error($con));

$queryInq = "CREATE TABLE IF NOT EXISTS `inquiries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uniqid` varchar(20) NOT NULL,
  `user` int NOT NULL,
  `title` varchar(250) NOT NULL,
  `init_msg` text NOT NULL,
  `department` int NOT NULL,
  `date` varchar(250) NOT NULL,
  `last_reply` int NOT NULL,
  `user_read` int NOT NULL,
  `admin_read` int NOT NULL,
  `resolved` int NOT NULL,
  PRIMARY KEY (`id`)
)";
$result = mysqli_query($con, $queryInq) or die(mysqli_error($con));

$queryLog = "CREATE TABLE IF NOT EXISTS `loginlogs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `TryTime` bigint NOT NULL,
  PRIMARY KEY (`id`)
)";
$result = mysqli_query($con, $queryLog) or die(mysqli_error($con));

$queryRep = "CREATE TABLE IF NOT EXISTS `replies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` int NOT NULL,
  `text` text NOT NULL,
  `ticket_id` text NOT NULL,
  `date` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
)";
$result = mysqli_query($con, $queryRep) or die(mysqli_error($con));

$queryUser = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `department` int NOT NULL DEFAULT '0',
  `user_group` int NOT NULL DEFAULT '0',
  `allowed` int DEFAULT '0',
  PRIMARY KEY (`id`)
)";
$result = mysqli_query($con, $queryUser) or die(mysqli_error($con));

$queryInsert = "INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `surname`, `dob`, `department`, `user_group`, `allowed`) VALUES
(1, 'mwachandea@hotmail.com', '202cb962ac59075b964b07152d234b70', 'Alexander', 'Mwachande', '2021-05-12', 0, 1, 1),
(2, 'admin@horizonhealth.com', '202cb962ac59075b964b07152d234b70', 'HorizonHealth', 'Admin', '2021-07-08', 0, 1, 1)
";
$result = mysqli_query($con, $queryInsert) or die(mysqli_error($con));

$queryInsert = "INSERT INTO `departments` (`id`, `name`, `hidden`) VALUES
(1, 'GENERAL', 0),
(2, 'ADMINISTRATION ', 0),
(3, 'MEDICIAL', 0),
(4, 'FINANCE', 0)
";
$result = mysqli_query($con, $queryInsert) or die(mysqli_error($con));
