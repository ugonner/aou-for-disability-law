<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/api/includes/db/connect.php';


//create law section
$sql5='CREATE TABLE section(
	id INT(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255),
	paragraphtext TEXT,
	paragraphigbotext TEXT,
	paragraphannotation TEXT,
	dateofpublication VARCHAR(255)
	)DEFAULT CHARSET UTF8 ENGINE INNODB';

if(!mysqli_query($link,$sql5)){
    $error = mysqli_error($link).' unable create sections';
    include $_SERVER['DOCUMENT_ROOT'].'/api/includes/errors/error.html.php';
    exit();
}

//create section-paragraph table

$sql5='CREATE TABLE sectionparagraph(
	id INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255),
	paragraphtext TEXT,
	paragraphigbotext TEXT,
	paragraphannotation TEXT,
	dateofpublication VARCHAR(255),
	sectionid INT(3),
	subsectionno INT(3)
	)DEFAULT CHARSET UTF8 ENGINE INNODB';

if(!mysqli_query($link,$sql5)){
    $error = mysqli_error($link).' unable create sectionparagraphs';
    include $_SERVER['DOCUMENT_ROOT'].'/api/includes/errors/error.html.php';
    exit();
}

$sql5='CREATE TABLE subsectionparagraph(
	id INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255),
	paragraphtext TEXT,
	paragraphigbotext TEXT,
	paragraphannotation TEXT,
	dateofpublication VARCHAR(255),
	sectionid INT(3),
	subsectionid INT(3)
	)DEFAULT CHARSET UTF8 ENGINE INNODB';

if(!mysqli_query($link,$sql5)){
    $error = mysqli_error($link).' unable create subsectionparagraphs';
    include $_SERVER['DOCUMENT_ROOT'].'/api/includes/errors/error.html.php';
    exit();
}



$sql2='CREATE TABLE role(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(32)
	)DEFAULT CHARSET UTF8';

if(!mysqli_query($link,$sql2)){
    $error = mysqli_error($link).' unable create role';
    include $_SERVER['DOCUMENT_ROOT'].'/api/includes/errors/error.html.php';
    exit();
}

$sql2='INSERT INTO role (name) VALUES
("President"),("Registered Member"),("Board"),("Executives"),("Staff"),("Volunteer Staff")';

if(!mysqli_query($link,$sql2)){
    $error = mysqli_error($link).' unable populate role';
    include $_SERVER['DOCUMENT_ROOT'].'/api/includes/errors/error.html.php';
    exit();
}


$sql5='CREATE TABLE location(
	id INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255)
	)DEFAULT CHARSET UTF8';

if(!mysqli_query($link,$sql5)){
    $error = mysqli_error($link).' unable create location';
    include $_SERVER['DOCUMENT_ROOT'].'/api/includes/errors/error.html.php';
    exit();
}

$sql5='CREATE TABLE sublocation(
	id INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255),
	locationid INT(3),
	INDEX sublocationlocationid (locationid)
	)DEFAULT CHARSET UTF8 ENGINE INNODB';

if(!mysqli_query($link,$sql5)){
    $error = mysqli_error($link).' unable create sublocation';
    include $_SERVER['DOCUMENT_ROOT'].'/api/includes/errors/error.html.php';
    exit();
}


//create wardadmin users;
$sql4='CREATE TABLE blockeduser(
	userid INT(3) PRIMARY KEY
	)DEFAULT CHARSET UTF8';

if(!mysqli_query($link,$sql4)){
    $error = mysqli_error($link).' unable create block user';
    include $_SERVER['DOCUMENT_ROOT'].'/api/includes/errors/error.html.php';
    exit();
}
//end of wardadmin user;


//create wardadmin users;
$sql4='CREATE TABLE superadmin(
	userid INT(3) PRIMARY KEY
	)DEFAULT CHARSET UTF8';

if(!mysqli_query($link,$sql4)){
    $error = mysqli_error($link).' unable create superadmin';
    include $_SERVER['DOCUMENT_ROOT'].'/api/includes/errors/error.html.php';
    exit();
}
//end of superadmin user;


//create wardadmin users;
$sql4='INSERT INTO superadmin (userid) VALUES (1)';

if(!mysqli_query($link,$sql4)){
    $error = mysqli_error($link).' unable INSERT superadmin';
    include $_SERVER['DOCUMENT_ROOT'].'/api/includes/errors/error.html.php';
    exit();
}
//end of superadmin user;


$sql3='CREATE TABLE user(
	id INT(6) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	firstname VARCHAR(200),
	surname VARCHAR(200),
	email VARCHAR(255) UNIQUE,
	password CHAR(32),
	mobile VARCHAR(32),
	school VARCHAR(255),
	gender ENUM("M", "F"),
	dateofbirth DATE,
	dateofregistration DATE,
	about TEXT,
	profilepic VARCHAR(255),
	locationid INT(3),
	sublocationid INT(3),
	smscount INT(3),
	roleid INT(3),
	rolenote VARCHAR(255),
	public ENUM("Y", "N"),
	lastactivity VARCHAR(255),
	lastarticlescount INT DEFAULT 0,
	lastnotificationcount INT DEFAULT 0,
	lastdonationcount INT DEFAULT 0,
	lastadvertcount INT DEFAULT 0,
	lastuserpostnotificationcount INT DEFAULT 0,
	facebookid VARCHAR(255),
    INDEX userroleid (roleid),
    INDEX usersublocationid (sublocationid),
    INDEX userlocationid (locationid),
    INDEX userlastactivity (lastactivity),
    INDEX useremailpsaaword (email,password)
	)DEFAULT CHARSET UTF8 ENGINE INNODB';

if(!mysqli_query($link,$sql3)){
    $error = mysqli_error($link).' unable create Person';
    include $_SERVER['DOCUMENT_ROOT'].'/api/includes/errors/error.html.php';
    exit();
}

?>