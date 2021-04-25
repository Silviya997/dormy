<?php

session_start();

	if(!isset($_SESSION['user']) || $_SESSION['user'] != 2){
		header('Location:index.php');
	}

    require_once('conn.php');
    include_once('header.php');
    include_once('menu.php');
    ?>

    <div>
        <h1>Dragana</h1>
    </div>