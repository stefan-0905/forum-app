<?php

//defined("DS") ? NULL : define("DS", DIRECTORY_SEPARATOR); // DS represents Directory Separator | Needed only for local version
define('SITE_ROOT', '//app//'); // for local version C:\xampp\htdocs\forum-app\

date_default_timezone_set('CET');

require_once "functions.php";
require_once "db_config.php";
require_once "models/database.php";
require_once "models/db_object.php";
require_once "models/user.php";
require_once "models/privileged_user.php";
require_once "models/role.php";
require_once "models/permission.php";
require_once "models/session.php";
require_once "models/board_list.class.php";
require_once "models/topic.class.php";
require_once "models/thread.class.php";
require_once "models/post.class.php";
require_once "models/reported_post.class.php";