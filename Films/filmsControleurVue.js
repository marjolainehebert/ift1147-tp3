//vue films
function listerF(listFilms){
	var taille;
	var rep="<h3>Liste des films</h3><hr>";
	rep+="<div class='container'>";
	rep+='<div class="row">';

	taille=listFilms.length;
	for(var i=0; i<taille; i++){
		
		rep+='<div class="col-sm-6 mb-5">';
        rep+='    <div class="card">';
        rep+='        <img class="card-img-top" src="pochettes/'+listFilms[i].pochette+'" alt="'+listFilms[i].titre+'">';
        rep+='        <div class="montrerID">#'+listFilms[i].id+'</div>';
        rep+='        <div class="card-body">';
        rep+='            <h5 class="card-title"><strong>'+listFilms[i].titre+'</strong> ('+listFilms[i].annee+')</h5>';
        rep+='            <p class="card-text">';
        rep+=                 listFilms[i].categorie;
        rep+='            </p>';
        rep+='            <p class="prix">';
        rep+=                 listFilms[i].prix+' $';
        rep+='            </p>';
        rep+='            <p class="card-text">';
        rep+='                 <i class="fa fa-id-card-o" aria-hidden="true"></i> '+listFilms[i].realisateur+'<br>';
        rep+='                 <i class="fa fa-clock-o" aria-hidden="true"></i> '+listFilms[i].duree+' minutes<br>';
        rep+='                 Langue: '+listFilms[i].langue;
        rep+='             </p>';
        rep+='             <div class="block flex-wrap mb-3">';
        rep+='                 <button class="btn btn-outline-warning" data-src="'+listFilms[i].urlPreview+'"  data-title="'+listFilms[i].titre+'"  onClick="$(\'#lienDuFilm\').attr(\'src\', $(this).data(\'src\')); $(\'#titreDuFilm\').text($(this).data(\'title\')); $(\'#bandeAnnonceModal\').modal(\'show\')">Bande Annonce</button>';
        rep+='             </div>';

        rep+='             <div class="block flex-wrap">';
        rep+='             <button class="btn btn-warning ajouterAuPanier"';
        rep+='             data-title="'+listFilms[i].titre+'"';
        rep+='             data-lefilm="'+listFilms[i].id+'"';
        rep+='             data-pochette="'+listFilms[i].pochette+'" ';
		rep+='             data-prix="'+listFilms[i].prix+'" ';
        rep+='             onClick="ajoutPanier(this); $(\'#titreDuFilmAjout\').text($(this).data(\'title\')); $(\'#ajout\').modal(\'show\');">';
                                                    
        rep+='             <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> Ajouter';
        rep+='             </button>';
		rep+='             </div>';
        rep+='        </div>';
        rep+='    </div>';
        rep+='</div>';

	}
	rep+="</div>";//fermer le dernier row
    rep+="</div>";//fermer le container
	$('#contenu').html(rep);
}

function afficherFiche(reponse){
  var uneFiche;
  if(reponse.OK){
	uneFiche=reponse.fiche;
	$('#formFicheF h3:first-child').html("Fiche du film numero "+uneFiche.id);
	$('#idf').val(uneFiche.id);
	$('#titreF').val(uneFiche.titre);
	$('#dureeF').val(uneFiche.duree);
	$('#resF').val(uneFiche.res);
	$('#divFormFiche').show();
	document.getElementById('divFormFiche').style.display='block';
  }else{
	$('#messages').html("<span class='alert alert-danger'>Film "+$('#numF').val()+" introuvable</span>");
	setTimeout(function(){ $('#messages').html(""); }, 5000);
  }

}

var filmsVue=function(reponse){
	var action=reponse.action; 
	switch(action){
		case "enregistrer" :
		case "enlever" :
		case "modifier" :
			$('#messages').html(reponse.msg);
			setTimeout(function(){ $('#messages').html(""); }, 5000);
		break;
		case "lister" :
			listerF(reponse.listeFilms);
		break;
		case "fiche" :
			afficherFiche(reponse);
		break;
		
	}
}

