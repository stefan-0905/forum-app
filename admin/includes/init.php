<?php

defined("DS") ? NULL : define("DS", DIRECTORY_SEPARATOR); // DS represents Directory Separator

define('SITE_ROOT', 'C:'.DS.'xampp'.DS.'htdocs'.DS.'forum-app');

require_once "functions.php";
require_once "db_config.php";
require_once "database.php";
require_once "db_object.php";
require_once "user.php";
require_once "privileged_user.php";
require_once "role.php";
require_once "permission.php";
require_once "session.php";
require_once "board_list.class.php";
require_once "topic.class.php";
require_once "thread.class.php";
require_once "post.class.php";