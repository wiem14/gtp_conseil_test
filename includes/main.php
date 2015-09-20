<?php

/*
	This is the main include file.
	It is only used in index.php and keeps it much cleaner.
*/

require_once "includes/config.php";
require_once "includes/connect.php";
require_once "includes/helpers.php";



require_once "includes/models/tache.model.php";
require_once "includes/models/employe.model.php";

require_once "includes/controllers/controller.php";


require_once "includes/controllers/login.controller.php";
require_once "includes/controllers/saisie.controller.php";
require_once "includes/controllers/taches.controller.php";
require_once "includes/controllers/employes.controller.php";
?>