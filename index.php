<?php 
require 'config/config.php';

require 'libs/ReceiveMail.php';

require 'libs/Application.php';
require 'libs/View.php';
require 'libs/Database.php';
require 'libs/Session.php';
require 'libs/Redirect.php';
require 'libs/Cookie.php';
require 'libs/Paging.php';
require 'libs/Controller.php';

session_name(sha1('DASHBOARD CS VERSION '.APP_VER));

$application = new Application();
?>