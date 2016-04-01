// Ecouter le click sur notre affiche de gauche dans le caroussel "Your Rooms"
$('.firstroom').on('click',function(){

    var $this = $(this),
        url = $this.data('url')
        document.location.href="link.php?id="+url;
});
// Ecouter le click sur notre affiche de droite dans le caroussel "Your Rooms"
$('.secondroom').on('click',function(){

    var $this = $(this),
        url = $this.data('url')
        document.location.href="link.php?id="+url;
});

//openIt (!le nom de la fonction doit être différent de 'open' qui se trouve être une fonction native et dont le nom ne peut pas être repris. Idem pour la fonction closeIt
//La fonction ferme le bloc de description de la ligne renseignée de plus on récupère la colonne pour afficher une petite flèche en dessous
//part : ligne
//pos : colonne
function openIt(part, pos, id){

    // Get the description corresponding to the line
    var $show_description = $('#desc'+part);

    // Open the description
    $show_description.addClass('open');

    // lecture des episdes de la saison 1 automatique
    chSais(part,1,id);

    // closeIt(part);
    // document.getElementById("desc"+part).className = "descBlock open";
    // var ul = document.getElementById(part);
    // console.log(ul.childNodes[(pos*2)-1]);
    // ul.childNodes[(pos*2)-1].className = "descBlock open";
    // ul.childNodes[(pos*2)-1].onclick=function(){
    //     closeIt(part);
    // };

    // initialisation des variables
    var $title              = $show_description.find('.title'), // le titre de la série
        $synopsis           = $show_description.find('.synopsis'),
        $id_serie           = $show_description.find('.id_serie_title'),
        $type               = $show_description.find('.type'),
        $list_season        = $show_description.find('.listSais'),
        $list_season_tmp    = '';
        $list_season.html('');
        // console.log($id_serie);

    // récupérer les infos de base de la série
    $.ajax({
        url      : 'inc/basic_show_infos.php?id=' + id,
        dataType : 'json',
        success  : function(res){
            $title.text(res.title);
            $type.text(res.genres) + ' ';
            $synopsis.text(res.synopsis);
            $id_serie.text(id);
            for(var i = 1;i<=res.num_seasons; i++) {
                // console.log(part);
                $list_season_tmp += '<li onclick="chSais(\''+part+'\', '+i+', \''+id+'\')">S'+i+'</li>';
            }
            $list_season.html($list_season_tmp);
        },
        error : function()
        {
          console.log('error');
        }
    });

    // récupérer les infos des épisodes de la série
    // $.ajax({
    //     url      : 'inc/episodes_infos.php?id=' + id,
    //     dataType : 'json',
    //     success  : function(res){
    //         for(var i=1;i<=res.length;i++) {
    //             $episode_num.text(res[i].num_episode);
    //             $episode_title.text(' - ' + res[i].ep_title); 
    //         }
    //     },
    //     error : function()
    //     {
    //       console.log('error');
    //     }
    // });

    return false;


}
//Cette fonction ouvre le bloc de description après avoir cliqué sur un poster. Chaque ligne possède son propre bloc de description. Chaque bloc de description se voit affecté une lettre. Les cinqs premières images veront donc leurs informations affichées dans le bloc A et ainsi de suite.
//part : ouvre la description de la ligne en question
function closeIt(part){
    document.getElementById("desc"+part).className = "descBlock";
    var ul = document.getElementById(part);
    ul.childNodes[1].className = "";
    ul.childNodes[1].onclick = function(){
        openIt(part,1);
    };
    ul.childNodes[3].className = "";
    ul.childNodes[3].onclick = function(){
        openIt(part,2);
    };
    ul.childNodes[5].className = "";
    ul.childNodes[5].onclick = function(){
        openIt(part,3);
    };
    ul.childNodes[7].className = "";
    ul.childNodes[7].onclick = function(){
        openIt(part,4);
    };
    ul.childNodes[9].className = "";
    ul.childNodes[9].onclick = function(){
        openIt(part,5);
    };
    setTimeout(function(){
        document.getElementById("setup"+part).className = "setup";
        document.getElementById("listEpi"+part).className = "listEpi open";
    }, 1000);
}

$('.listItems ul.series li').on('click',function(){

    var $this = $(this),
        ul_id = $this.data('ulid'),
        j     = $this.data('j'),
        id    = $this.data('id');

    openIt(ul_id,j,id);
    // console.log(ul_id);

    return false;
});
//Applique un changement de classe en vu de changer de section dans la bannière. Ainsi on passe de l'onglet "Programme du soir" à "Rechercher" et ainsi de suite
//state : lettre d'état: A : premier screen, B : deuxième screen, etc
//menu : il faut renseigner le nom du menu afin de pointer le bon élément pour le changement de classe
function showBan(state, menu){
    var a = document.getElementById("rooms"),
        b = document.getElementById("programm"),
        c = document.getElementById("mostViews"),
        d = document.getElementById("search"),
        m = document.getElementsByName(menu);
    
    a.className = "state"+state;
    b.className = "state"+state;
    c.className = "state"+state;
    d.className = "state"+state;
    
    document.getElementsByName("rooms")[0].className = "rooms";
    document.getElementsByName("programm")[0].className = "programm";
    document.getElementsByName("mostViews")[0].className = "mostViews";
    document.getElementsByName("search")[0].className = "search";
    
    m[0].className = menu + " slct";
}
//On ouvre le slide B par défaut
showBan('B','programm');

//Fonction actualisant les données de la bannière "Programmes du soir"
//pos : numéro de la ligne
//d : date de sortie
//r : note /5
//c : nombre de personne connectées à la room en question
//v : nombre de vue de la série
function pgrm(pos,d,r,c,v){
    var ul = document.getElementById("selection");
    ul.childNodes[1].className = "state"+pos;
    
    var sel = document.getElementById("selectPgrm");
    sel.childNodes[1].className = "";
    sel.childNodes[3].className = "";
    sel.childNodes[5].className = "";
    
    var rdv = document.getElementById("rdv");
    var date = document.getElementById("date");
    var stars = document.getElementById("stars");
    var connected = document.getElementById("connected");
    var views = document.getElementById("views");
    
    starS(r);
    date.innerHTML=d;
    connected.innerHTML=c;
    views.innerHTML=v;
    date.innerHTML=d;
    
    if(pos=="A"){
        sel.childNodes[1].className = "selected";
        rdv.innerHTML="19h30";
    }
    if(pos=="B"){
        sel.childNodes[3].className = "selected";
        rdv.innerHTML="20h30";
    }
    if(pos=="C"){
        sel.childNodes[5].className = "selected";
        rdv.innerHTML="21h30";
    }
}

//Fonction d'affichage créant un nombre d'étoiles pleines/vides selon la note (nb)
//nb : la note
function starS(nb){
    document.getElementById("stars").innerHTML = "";
    for(var i = 0; i<nb;i++){
        var st = document.createElement("div");
        st.className="full";
        document.getElementById("stars").appendChild(st);
    }
    for(var i = 0; i<(5-nb);i++){
        var st = document.createElement("div");
        st.className="empty";
        document.getElementById("stars").appendChild(st);
    }
    return true;
}

//Lorsque l'on clique sur un épisode, on écrit dans des inputs hidden renseignant quel épisode de quelle saison nous souhaitons regarder
//sai : numéro de la saison
//epi : numéro de l'épisode
// id_serie : id de la serie
//part : ligne
function choose(sai,epi,part,id_serie){
    // document.getElementById("num_sais"+part).value = sai;
    // document.getElementById("num_epi"+part).value = epi;
    // document.getElementById("id_serie"+part).value = id_serie;
    
    document.getElementById("setup"+part).className = "setup open";
    document.getElementById("listEpi"+part).className = "listEpi";
}

//Ouverture des episodes selon les boutons saisons
//part : numéro de la ligne
//sais : numéro de la saison
function chSais(part, sais, id){
    document.getElementById("setup"+part).className = "setup";
    document.getElementById("listEpi"+part).className = "listEpi open";
    var list = document.getElementById("listEpi"+part);
    list.innerHTML = "";
    var cpt = 1;
    // appeler ajax pour récupérer nombre d'épisodes pour la saison demandés
    $.ajax({
        url      : 'inc/episodes_infos.php?id=' + id,
        dataType : 'json',
        success  : function(res){
            while(res[sais][cpt]){
                
                if(res[sais][cpt] == undefined) {
                    list.innerHTML += '<li> 0'+cpt+' - Episode non disponible</li>';
                }
                else {
                    list.innerHTML += '<li onclick="choose('+sais+','+cpt+',\''+part+'\')"> 0'+cpt+' - ' + res[sais][cpt].ep_title + '</li>';
                }
                cpt++;
            }
            // for(var i=1;i<=res[sais].length;i++) {
            //     if(res[sais][i].ep_title == undefined) {
            //         list.innerHTML += '<li> 0'+i+' - Episode non disponible</li>';
            //     }
            //     else {
            //         list.innerHTML += '<li onclick="choose('+sais+','+i+',\''+part+'\')"> 0'+i+' - ' + res[sais][i].ep_title + '</li>';
            //     }
            // }
        },
        error : function()
        {
          console.log('error');
        }
    });
}