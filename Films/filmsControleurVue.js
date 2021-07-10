//vue films
function listerF(listFilms){
	var taille;
	var rep="<h3>Liste des films</h3><hr>";
	rep+='<table class="table table-striped">';
    rep+='<tr><th>ID</th><th>Titre</th><th>Durée</th><th>Réalisateur</th><th>Pochette</th></tr>';

	taille=listFilms.length;
	for(var i=0; i<taille; i++){
		rep+="<tr><td>"+listFilms[i].idf;
		rep+="</td><td>"+listFilms[i].titre;
		rep+="</td><td>"+listFilms[i].duree;
		rep+="</td><td>"+listFilms[i].res;
		rep+="</td><td><img src='pochettes/"+listFilms[i].pochette+"' width=80 height=80></td>";
		rep+="</tr>";		 
	}
	rep+="</table>";
	$('#contenu').html(rep);
}

function afficherFiche(reponse){
  var uneFiche;
  if(reponse.OK){
	uneFiche=reponse.fiche;
	$('#formFicheF h3:first-child').html("Fiche du film numero "+uneFiche.idf);
	$('#idf').val(uneFiche.idf);
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

