<?php
    session_start();
    if (isset($_GET['msg'])){
	    $msg=$_GET['msg'];
    }
    else {
	       $msg="";
    }
    if (isset($_GET['liste'])){
	    $liste= $_GET['liste'];
     }
    else {
	       $liste="";
    }
    
?>

<!DOCTYPE php>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>StreamTopia</title>
	<head>
		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

		<!-- Css Styles -->
		<link rel="stylesheet" href="public/utilitaires/css/bootstrap.min.css" type="text/css">
		<link rel="stylesheet" href="public/utilitaires/css/font-awesome.min.css" type="text/css">
		<link rel="stylesheet" href="public/utilitaires/css/themify-icons.css" type="text/css">
		<link rel="stylesheet" href="public/utilitaires/css/elegant-icons.css" type="text/css">
		<link rel="stylesheet" href="public/utilitaires/css/owl.carousel.min.css" type="text/css">
		<link rel="stylesheet" href="public/utilitaires/css/nice-select.css" type="text/css">
		<link rel="stylesheet" href="public/utilitaires/css/jquery-ui.min.css" type="text/css">
		
		<link rel="stylesheet" href="public/utilitaires/css/slicknav.min.css" type="text/css">
		<link rel="stylesheet" href="public/utilitaires/css/style.css" type="text/css">
		<link rel="stylesheet" href="public/css/styles.css" type="text/css">
		<script src="public/javascript/fonctions.js"></script>
		<script src="public/javascript/panier.js"></script>
		<script language="javascript" src="public/utilitaires/js/jquery-3.3.1.min.js"></script>
		<script language="javascript" src="public/javascript/global.js"></script>
		<!-- Javascript -->
		
		<script language="javascript" src="Films/filmsRequetes.js"></script>
		<script language="javascript" src="Films/filmsControleurVue.js"></script>
		<link rel="stylesheet" href="css/films.css" type="text/css" />
		<link rel="stylesheet" href="css/table.css" type="text/css" />
		<link rel="stylesheet" href="css/normalize.min.css" type="text/css" />
	</head>
	
	
	
	<body>
		<h2>Gestion des films</h2><br><br>
		<input type="button" value="Enregistrer(C)" onClick="rendreVisible('divEnreg');">
		<input type="button" value="Lister(R)" onClick="lister();$('#contenu').show();">
		<input type="button" value="Modifier(U)" onClick="rendreVisible('divFiche');">
		<input type="button" value="Enlever(D)" onClick="rendreVisible('divEnlever');">
		<div id="divEnreg">
			<form id="formEnreg">
				<h3>Enregistrer film</h3><br><br>
				<span onClick="rendreInvisible('divEnreg')">X</span><br>
				Titre:<input type="text" id="titre" name="titre"><br>
				Duree:<input type="text" id="duree" name="duree"><br>
				Realisateur:<input type="text" id="res" name="res"><br><br>
				Pochette:<input type="file" id="pochette" name="pochette"><br><br>
				<!--<input type="hidden" name="action" value="enregistrer"> -->
				<input type="button" value="Envoyer" onClick="enregistrer();"><br>
			</form>
		</div>
		
		<div id="divEnlever">
			<form id="formEnlever">
				<h3>Enlever film</h3><br><br>
				<span onClick="rendreInvisible('divEnlever')">X</span><br>
				Numero:<input type="text" id="numE" name="numE"><br>
				<!--<input type="hidden" name="action" value="enlever"> pour serialize() dans Requetes -->
				<input type="button" value="Envoyer" onClick="enlever();"><br>
			</form>
		</div>
		<div id="divFiche">
			<form id="formFiche">
				<h3>Obtenir fiche film</h3><br><br>
				<span onClick="rendreInvisible('divFiche')">X</span><br>
				Numero:<input type="text" id="numF" name="numF"><br>
				<input type="button" value="Envoyer" onClick="obtenirFiche();"><br>
			</form>
		</div>
		
		
		
		<div id="divFormFiche" style="position:absolute;top:10%;left:50%; display:none">
			<form id="formFicheF">
				<h3></h3><br><br>
				<span onClick="rendreInvisible('divFormFiche')">X</span><br>
				<input type="hidden" id="idf" name="idf">
				Titre:<input type="text" id="titreF" name="titreF"><br>
				Duree:<input type="text" id="dureeF" name="dureeF"><br>
				Realisateur:<input type="text" id="resF" name="resF"><br><br>
				Pochette:<input type="file" id="pochette" name="pochette"><br><br>
				<input type="button" value="Modifier" onClick="modifier();"><br>
			</form>
		</div>
		<div id="contenu" style="position:absolute;top:25%;left:20%;"></div>
		<div id="messages" style="position:absolute;top:2%;left:80%;color:red;"></div>
	</body>
</html>