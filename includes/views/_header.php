<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Test evaluation</title>


	<!-- Latest compiled and minified CSS -->

	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/assets/lib/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap-select.css">
	<!-- Jquery -->


	<!--<script src="/assets/lib/js/jquery-1.11.3.min.js"></script>-->

	<!-- Bootstrap -->
	<!--<script  src="/assets/bootstrap/js/bootstrap.min.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="/assets/lib/js/jquery.dataTables.min.js"></script>
	<script src="/assets/bootstrap/js/bootstrap-select.js"></script>

	<script  src="/assets/js/script.js"></script>

</head>
<body>
<style>
	body {
		padding-top: 70px;
	}
</style>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header pull-right">
			<a class="navbar-brand" href="index.php?saisie=1">Saisie Tâche</a>
			<a class="navbar-brand" href="index.php?taches=1">Liste Tâches</a>
			<a class="navbar-brand" href="/index.php?employes=1">Liste Employés</a>
			<a class="navbar-brand" href="index.php?login=1">Déconnexion</a>
		</div>
		<h3 class="text-muted">Gestion d'une file d'attente</h3>
	</div>
</nav>
<div class="container">
<div data-role="page">

	<div data-role="header" data-theme="b">
		<h1><?php echo $title?></h1>
	</div>

	<div data-role="content">