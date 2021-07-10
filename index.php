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
		
		<!---->
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
		<!---->
		<script language="javascript" src="public/utilitaires/js/jquery-3.3.1.min.js"></script>
		<script language="javascript" src="js/global.js"></script>
		<script language="javascript" src="Films/filmsRequetes.js"></script>
		<script language="javascript" src="Films/filmsControleurVue.js"></script>

		<link rel="stylesheet" href="public/css/films.css" type="text/css" />
	</head>
	
	
	
	<body>

		<!-- Header Section Begin -->
		<header class="header-section">
			<div class="container">
				<div class="inner-header">
					<div class="row">
						<div class="col-md-2 col-sm-12">
							<div class="logo">
								<img src="/tp2/public/images/streamtopia.png" alt="StreamTopia">
								<a href="/tp2/index.php">
									StreamTopia
								</a>
							</div>
						</div>
						<div class="text-right col-md-10 col-sm-12">
							<ul class="nav-right">
								<?php
									
									if(!isset($_SESSION['courrielSess'])){
										echo "<li><a href=\"#\" data-toggle=\"modal\" data-target=\"#connexion\">Connexion</a></li>";
										echo "<li><button type=\"button\" class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#enregistrer\">Devenir Membre</button></li>";
									}else if($_SESSION['roleSess']=='A'){
										echo "<li><a href=\"/tp2/public/pages/membre.php\">".$_SESSION['prenomSess']." ".$_SESSION['nomSess']."</a></li>";
										echo "<li><a href=\"/tp2/public/pages/admin.php\">Page Admin</a></li>";
										echo "<li><a href=\"/tp2/serveur/membres/deconnexion.php\" class=\"btn btn-warning\">Déconnexion</a></li>";
									}else {
										echo "<li><a href=\"/tp2/public/pages/membre.php\">".$_SESSION['prenomSess']." ".$_SESSION['nomSess']."</a></li>";
										echo "<li><a href=\"/tp2/public/pages/membre.php\"><i class=\"fa fa-shopping-cart\"></i> <span id=\"nbItems\"></span></a></li>";
										echo "<li><a href=\"/tp2/public/pages/membre.php\">Profil</a></li>";
										echo "<li><a href=\"/tp2/serveur/membres/deconnexion.php\" class=\"btn btn-warning\">Déconnexion</a></li>";
									}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			
		</header>

		<section>
			<div class="container my-5">
				<div class="row">
					<!---->
					<div class="col-sm-12">
						<h2 class="text-center">Bienvenue <?php echo $_SESSION['prenomSess'];?></h2>
						<h3 class="text-center mb-5 pb-4">dans l'espace administrateur</h3>
					</div>

					<div class="col-12 col-md-3 col-xl-2 ">
						<h5><strong>Gestion films</strong></h5>
						<div class="block flex-wrap mt-3 mb-5">
						<input type="button" value="Enregistrer" onClick="rendreVisible('divEnreg');" class="btn btn-outline-success mb-3">
						<input type="button" value="Lister" onClick="lister();$('#contenu').show();" class="btn btn-outline-warning mb-3" >
						<input type="button" value="Modifier" onClick="rendreVisible('divFiche');" class="btn btn-outline-info mb-3">
						<?php
							if ($_SESSION['roleSess']=='A'){
								echo '<input type="button" value="Supprimer" onClick="rendreVisible(\'divEnlever\');" class="btn btn-outline-danger mb-3">';
							} else {
								echo '<input type="button" value="Supprimer" onclick="montrer(\'accesRefuse\');" class="btn btn-light mb-3">';
							}			
						?>
							
						</div>

						<h5><strong>Gestion membres</strong></h5>
						<div class="block flex-wrap mt-3 mb-5">
							<button class="btn btn-outline-warning mb-3" onclick="envoyerListerMembres()">Lister</button>
							<button class="btn btn-outline-info mb-3" onclick="montrer('modifierMembre');">Modifier</button>
							
						</div>
					</div>
					
					<div class="col-12 col-md-9 col-xl-10 bgcolor pt-2 pb-2">
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
							<h3 class="mb-2">Enregistrer un film</h3>
							<hr>
							<form id="enregFilmForm" enctype="multipart/form-data" name="enregFilmForm" action="/tp2/serveur/films/enregistrerFilm.php" method="POST" onsubmit="return validerFormEnregFilms();">
								<div class="mb-3">
									<label for="titreFilm" class="form-label">Titre du film</label>
									<div id="messageTitre">Entrez le titre</div>
									<input type="text" class="form-control" id="titreFilm" name="titreFilm">
								</div>

								<div class="mb-3">
									<label for="realisateur" class="form-label">Réalisateur</label>
									<div id="messageRealis">Entrez le nom du réalisateur</div>
									<input type="text" class="form-control" id="realisateur" name="realisateur">
								</div>

								<div class="row mb-3">
									<div class="col-sm">
										<label for="dureeFilm" class="form-label">Durée du film (minutes)</label>
										<div id="messageDuree">Entrez la durée en minutes (entre 1 et 999)</div>
										<input type="text" class="form-control" id="dureeFilm" name="dureeFilm">
									</div>

									<div class="col-sm">
										<label for="dateFilm" class="form-label">Année de sortie</label>
										<div id="messageDate">Entrez l'année de la sortie du film (supérieur à 1800)</div>
										<input type="text" class="form-control" id="dateFilm" name="dateFilm">
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-sm">
										<label for="categFilm" class="form-label">Catégorie</label>
										<div id="messageCateg">Choisissez la catégorie</div>
										<select id="categFilm" name="categFilm" class="form-control" data-placeholder="Choisir la catégorie...">
											<option value="Action">Action</option>
											<option value="Comédie">Comédie</option>
											<option value="Drame">Drame</option>
											<option value="Science Fiction">Science Fiction</option>
											<option value="Suspense">Suspense</option>
											<option value="Thriller">Thriller</option>
										</select>
									</div>
									<div class="col-sm">
										<label for="langueFilm" class="form-label">Langue du film</label>
										<div id="messageLangue">Entrez le langue</div>
										<select type="text" class="form-control" id="langueFilm" name="langueFilm" data-placeholder="Choisir la langue...">
											<option value="FR">Français</option>
											<option value="EN">English</option>
											<option value="AF">Afrikaans</option>
											<option value="SQ">Albanian</option>
											<option value="AR">Arabic</option>
											<option value="HY">Armenian</option>
											<option value="EU">Basque</option>
											<option value="BN">Bengali</option>
											<option value="BG">Bulgarian</option>
											<option value="CA">Catalan</option>
											<option value="KM">Cambodian</option>
											<option value="ZH">Chinese (Mandarin)</option>
											<option value="HR">Croatian</option>
											<option value="CS">Czech</option>
											<option value="DA">Danish</option>
											<option value="NL">Dutch</option>
											<option value="ET">Estonian</option>
											<option value="FJ">Fiji</option>
											<option value="FI">Finnish</option>
											<option value="KA">Georgian</option>
											<option value="DE">German</option>
											<option value="EL">Greek</option>
											<option value="GU">Gujarati</option>
											<option value="HE">Hebrew</option>
											<option value="HI">Hindi</option>
											<option value="HU">Hungarian</option>
											<option value="IS">Icelandic</option>
											<option value="ID">Indonesian</option>
											<option value="GA">Irish</option>
											<option value="IT">Italian</option>
											<option value="JA">Japanese</option>
											<option value="JW">Javanese</option>
											<option value="KO">Korean</option>
											<option value="LA">Latin</option>
											<option value="LV">Latvian</option>
											<option value="LT">Lithuanian</option>
											<option value="MK">Macedonian</option>
											<option value="MS">Malay</option>
											<option value="ML">Malayalam</option>
											<option value="MT">Maltese</option>
											<option value="MI">Maori</option>
											<option value="MR">Marathi</option>
											<option value="MN">Mongolian</option>
											<option value="NE">Nepali</option>
											<option value="NO">Norwegian</option>
											<option value="FA">Persian</option>
											<option value="PL">Polish</option>
											<option value="PT">Portuguese</option>
											<option value="PA">Punjabi</option>
											<option value="QU">Quechua</option>
											<option value="RO">Romanian</option>
											<option value="RU">Russian</option>
											<option value="SM">Samoan</option>
											<option value="SR">Serbian</option>
											<option value="SK">Slovak</option>
											<option value="SL">Slovenian</option>
											<option value="ES">Spanish</option>
											<option value="SW">Swahili</option>
											<option value="SV">Swedish </option>
											<option value="TA">Tamil</option>
											<option value="TT">Tatar</option>
											<option value="TE">Telugu</option>
											<option value="TH">Thai</option>
											<option value="BO">Tibetan</option>
											<option value="TO">Tonga</option>
											<option value="TR">Turkish</option>
											<option value="UK">Ukrainian</option>
											<option value="UR">Urdu</option>
											<option value="UZ">Uzbek</option>
											<option value="VI">Vietnamese</option>
											<option value="CY">Welsh</option>
											<option value="XH">Xhosa</option>
											</select>
									</div>
								</div>

								<div class="mb-3">
									<label for="pochette" class="form-label">Ajouter une image de la pochette</label>
									<input type="file" class="form-control" id="pochette" name="pochette">
								</div>

								<div class="row mb-3">
									<div class="col-sm">
										<label for="urlPreview" class="form-label">URL de la bande annonce</label>
										<div id="messageUrl">SVP entrez un URL provenant de Youtube</div>
										<input type="text" class="form-control" id="urlPreview" name="urlPreview">
									</div>

									<div class="col-sm">
										<label for="prix" class="form-label">Prix en dollars (CAD) </label>
										<div id="messagePrix">SVP entrez un montant contenant un point et 2 décimales.</div>
										<input type="text" class="form-control" id="prix" name="prix">
									</div>
								</div>

								<button type="submit" class="btn btn-warning">Soumettre</button>
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
						<div id="messages" class="alert alert-success"></div>
					</div>
				</div>				
			</div>
		</section>
	</body>
</html>