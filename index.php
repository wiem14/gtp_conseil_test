<?php

/*
	This is the index file of our simple website.
	It routes requets to the appropriate controllers
*/

require_once "includes/main.php";

try {

	if($_GET['login']){
		$c = new LoginController();
	}
	else if($_GET['saisie']){
		$c = new SaisieController();
	}
	else if($_GET['taches']){
		$c = new TachesController();
	}else if($_GET['employes']){
		$c = new EmployesController();
	}

	else throw new Exception('Wrong page!');

	$c->handleRequest();
}
catch(Exception $e) {
	// Display the error page using the "render()" helper function:
	render('error',array('message'=>$e->getMessage()));
}

?>