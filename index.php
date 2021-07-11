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
		<link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

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
					<div class="col-sm-12 col-md-2"></div>
					<div class="col-sm-12 col-md-10">
						<h2 class="text-center">Bienvenue <?php echo $_SESSION['prenomSess'];?></h2>
						<h3 class="text-center pb-4">dans l'espace administrateur</h3>
					</div>

					<div class="col-12 col-md-3 col-xl-2 ">
						<h5><strong>Gestion films</strong></h5>
						<div class="block flex-wrap mt-3 mb-5">
						<input type="button" value="Enregistrer" onClick="rendreVisible('divEnreg');" class="btn btn-outline-success mb-3">
						<input type="button" value="Lister" onClick="lister();$('#contenu').show();" class="btn btn-outline-warning mb-3" >
						<input type="button" value="Modifier" onClick="rendreVisible('divFiche');" class="btn btn-outline-info mb-3">
						<input type="button" value="Supprimer" onClick="rendreVisible('divEnlever');" class="btn btn-outline-danger mb-3">
						<!--?php
							if ($_SESSION['roleSess']=='A'){
								echo '<input type="button" value="Supprimer" onClick="rendreVisible(\'divEnlever\');" class="btn btn-outline-danger mb-3">';
							} else {
								echo '<input type="button" value="Supprimer" onclick="montrer(\'accesRefuse\');" class="btn btn-light mb-3">';
							}			
						?-->
							
						</div>

						<h5><strong>Gestion membres</strong></h5>
						<div class="block flex-wrap mt-3 mb-5">
							<button class="btn btn-outline-warning mb-3" onclick="envoyerListerMembres()">Lister</button>
							<button class="btn btn-outline-info mb-3" onclick="montrer('modifierMembre');">Modifier</button>
							
						</div>
					</div>
					
					<div class="col-12 col-md-9 col-xl-10 bgcolor pt-2 pb-2">
						<div id="divEnreg">
							<h3>Enregistrer film</h3>
							<hr>
							<form id="formEnreg">
								<!-- Titre:<input type="text" id="titre" name="titre"><br>
								Duree:<input type="text" id="duree" name="duree"><br>
								Realisateur:<input type="text" id="res" name="res"><br><br>
								Pochette:<input type="file" id="pochette" name="pochette"><br><br>
								<input type="button" value="Envoyer" onClick="validerFormEnregFilms();enregistrer();"><br>
							</form>
							<h3 class="mb-2">Enregistrer un film</h3>
							<hr>
							<form id="enregFilmForm" enctype="multipart/form-data" name="enregFilmForm" action="/tp2/serveur/films/enregistrerFilm.php" method="POST" onsubmit="return validerFormEnregFilms();"> -->
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
											<option value="EU">Basque</option>
											<option value="ES">Espagnol</option>
											<option value="ZH">Chinese (Mandarin)</option>
											<option value="DA">Danish</option>
											<option value="DE">German</option>
											<option value="PT">Portuguese</option>
											<option value="SV">Swedish </option>
											<option value="VI">Vietnamese</option>
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

								<input type="button" class="btn btn-success" value="Envoyer" onClick="gateEnreg();"><br>
							</form>
						</div>
						
						<div id="divEnlever">
							<form id="formEnlever">
								<h3>Supprimer un film</h3>
								<hr>
								<h5>Entrez le numéro du film à supprimer</h5>
								Numero:<input type="text" id="numE" name="numE"><br>
								<!--<input type="hidden" name="action" value="enlever"> pour serialize() dans Requetes -->
								<input type="button" value="Envoyer" onClick="enlever();"><br>
							</form>
						</div>
						<div id="divFiche">
							<form id="formFiche">
								<h3>Modifier un film</h3>
								<hr>
								<h5>Entrez le numéro du film à modifier</h5>
								<span onClick="rendreInvisible('divFiche')">X</span><br>
								Numero:<input type="text" id="numF" name="numF"><br>
								<input type="button" value="Envoyer" onClick="obtenirFiche();"><br>
							</form>
						</div>
						
						
						
						<div id="divFormFiche">
							<form id="formFicheF">
								<h3>Modifier un film</h3>
								<hr>
								<h5>Modifiez les informations du film</h5>
								<input type="hidden" id="idf" name="idf">
								Titre:<input type="text" id="titreF" name="titreF"><br>
								Duree:<input type="text" id="dureeF" name="dureeF"><br>
								Realisateur:<input type="text" id="resF" name="resF"><br><br>
								Pochette:<input type="file" id="pochette" name="pochette"><br><br>
								<input type="button" value="Modifier" onClick="modifier();"><br>
							</form>
						</div>
						<div id="contenu"></div>
						<div id="messages"></div>
					</div>
				</div>				
			</div>


			<!-- Modals -->
			<!-- Modal preview -->
			<div class="modal fade" id="bandeAnnonceModal" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Bande Annonce du Film <span id="titreDuFilm" class="bold"></span></h5>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body d-flex justify-content-center">
							<iframe  id="lienDuFilm" width="560" height="315" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>


			<div class="modal fade" id="ajout" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Ajout de film</h5>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<div class="modal-body">
							<p>Le film <span id="titreDuFilmAjout" class="bold"></span> a été ajouté</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-light" data-dismiss="modal">Ajouter d'autres films</button>
							<a class="btn btn-warning" href="public/pages/membre.php">voir le panier</a>
						</div>
					</div>
				</div>
			</div>

			<!-- modal s'enregistrer -->
			<div class="modal fade" id="enregistrer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Enregistrement Membre</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					</div>
					<div class="modal-body">
						<form class="formulaires" id="enregForm" name="enregForm" action="serveur/membres/enregistrementMembre.php" method="POST" onsubmit="return validerFormEnreg(this);">
							<label for="prenom"><b>Prénom</b></label><br>
							<div id="messagePrenom">Entrez votre prénom</div>
							<input type="text" placeholder="Enter votre prénom" title="Enter votre prénom" name="prenom" id="prenom" />
							
							<label for="nom"><b>Nom</b></label><br>
							<div id="messageNom">Entrez votre nom</div>
							<input type="text" placeholder="Enter votre nom" title="Enter votre nom" name="nom" id="nom" />
							
							<label for="email"><b>Courriel</b></label><br>
							<div id="messageCourriel">Entrez une adresse courriel valide dans le format votrenom@domaine.com</div>
							<input type="text" placeholder="Entrez votre adresse courriel" title="Entrez votre adresse courriel" name="courriel" id="courriel"/>
							
							<label for="motDePasse"><b>Mot de passe</b></label>
							<div id="messageMdpVide">Entrez un mot de passe</div>
							<div id="messageMdpErrone">Le mot de passe doit contenir entre 8 et 10 caractères. Les caractères acceptés sont les lettres minuscules et majuscules, les chiffres, les tirets et les caractères de soulignement.</div>
							<input type="password" placeholder="Entrez le mot de passe" title="Entrez le mot de passe" name="motDePasse" id="motDePasse" />
							
							<label for="repeterMDP"><b>Répétez le mot de passe</b></label><br>
							<div id="messageConfMdpVide">Entrez la confirmation du mot de passe</div>
							<div id="messageConfMdpErrone">Les mots de passe entrés sont différents, veuillez réessayer</div>
							<input type="password" placeholder="Répétez le mot de passe" title="Répétez le mot de passe" name="repeterMDP" id="repeterMDP" />

							<div class="col-50 bordureForm" >
								<div>
									<label for="sexe"><strong>Sexe*:</strong></label><br>
									<p class="genre">
										<input class="radio" type="radio" name="sexe" id="sexeFeminin" value="feminin" checked required/>
										<label for="sexeFeminin">Féminin</label>
									</p>
									<p class="genre">
										<input class="radio" type="radio" name="sexe" id="sexeMasculin" value="masculin"> 
										<label for="sexeMasculin">Masculin</label>
									</p>
								</div>

								<div>
									<label for="naissance"><strong>Date de naissance*:</strong></label>
									<div id="messageNaissance">Entrez votre date de naissance</div>
									<input type="date" name="naissance" id="naissance"/>
								</div>
							</div>
							<div class="pb-1"><small>* Pour des fins statistique uniquement.</small></div>

							
							<div class="modal-footer">
								<button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
								<button type="submit" class="btn btn-warning">S'enregistrer</button>
							</div>
						</form>
						<div id="messageErreur"></div>
						Vous avez déjà un compte? <a href="#" class="dark-link" onclick="connexionModal();">Cliquez-ici</a> pour vous connecter.
						
					</div>
				</div>
				</div>
			</div>

			<!-- modal connexion -->
			<div class="modal fade" id="connexion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Connexion</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						</div>
						<div class="modal-body">
							<form class="formulaires" id="connexionFrom" name="connexionFrom" action="serveur/membres/connexionMembre.php" method="POST" onsubmit="return validerConnexion(this);">
								<label for="courrielMembre"><b>Courriel</b></label><br>
								<div id="messageCourrielMembre">Entrez une adresse courriel valide dans le format votrenom@domaine.com</div>
								<input type="text" placeholder="Entrez votre adresse courriel" name="courrielMembre" id="courrielMembre" />
								
								<label for="motDePasseMembre"><b>Mot de passe</b></label><br>
								<div id="messageMdpMembreVide">Entrez un mot de passe</div>
								<div id="messageMdpMembreErrone">Le mot de passe doit contenir entre 8 et 10 caractères. Les caractères acceptés sont les lettres minuscules et majuscules, les chiffres, les tirets et les caractères de soulignement.</div>
								<input type="password" placeholder="Entrez le mot de passe" name="motDePasseMembre" id="motDePasseMembre">
								
								<div class="modal-footer">
									<button type="button" class="btn btn-light" data-dismiss="modal">Annuler</button>
									<button type="submit" class="btn btn-warning">Se connecter</button>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							Vous n'avez pas un compte? <a href="#" class="dark-link" onclick="enregistrementModal();">Cliquez-ici</a> pour vous enregistrer.

						</div>
					</div>
				</div>
			</div>

			<!-- Toast -->
			<div class="toast-container" aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="min-height: 200px;">
                    <div id="toastAcc" class="toast posToast" data-delay="3000" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <img src="public/images/streamtopia.png" width="24" height="auto" class="rounded me-2" alt="message">
                            <strong class="me-auto">Messages</strong>
                            <small class="text-muted"></small>
                        </div>
                        <div id="textToast" class="toast-body">
                        </div>
                    </div>
                </div>

		</section>

		    <!-- Footer Section Begin -->
			<footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-left">
                        
                        <div class="logo">
                            <img src="public/images/streamtopia.png" alt="StreamTopia">
                            <a href="index.php">
                                StreamTopia
                            </a>
                        </div>
                        <ul>
                            <li>1234 rue Nom de la rue, Montréal, Qc H1H 1H1</li>
                            <li>Téléphone: 1 (800) 555-1234</li>
                            <li>Courriel: support@StreamTopia.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-widget">
                        <h5>Information</h5>
                        <ul>
                            <li><a href="#">À propos</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-reserved">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Scripts -->
    <script>
        // on the footer of redirect page
        if (window.location.hash == "#openm") {
            $("#myModal").modal("show");
        }


        $('.ajouterAuPanier').click(function (event) {
            event.preventDefault();
            var ligne = $(this).data('ligne');
            $.ajax({
                method: "POST",
                cache: false,
                data: { ligne: ligne }
            });
        });
    </script>
    



    <!-- Js Plugins -->
    <script src="public/utilitaires/js/jquery-3.3.1.min.js"></script>
    <script src="public/utilitaires/js/bootstrap.min.js"></script>
    <script src="public/utilitaires/js/jquery-ui.min.js"></script>
    <script src="public/utilitaires/js/jquery.countdown.min.js"></script>
    <script src="public/utilitaires/js/jquery.nice-select.min.js"></script>
    <script src="public/utilitaires/js/jquery.zoom.min.js"></script>
    <script src="public/utilitaires/js/jquery.dd.min.js"></script>
    <script src="public/utilitaires/js/jquery.slicknav.js"></script>
    <script src="public/utilitaires/js/owl.carousel.min.js"></script>
    <script src="public/utilitaires/js/main.js"></script>
</body>

