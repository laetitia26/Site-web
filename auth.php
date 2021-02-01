<?php

function est_connecte():bool{

	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}

	return !empty($_SESSION['connecte']);
}


function forcer_utilisateur_connecte(){
	if (!est_connecte()) {
		header('Location: loginAdmin.php');
		exit();
	}
}

?>

