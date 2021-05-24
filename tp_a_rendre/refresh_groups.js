function writediv(texte, endroit) {
    document.getElementById(endroit).innerHTML = texte;
}

function afficher(fileToRefresh, id) {
    if (texte = file(fileToRefresh)) // Ton fichier à inclure dans la <div>
    {
        writediv(texte, id); // chat = <div id='chat'>, c'est l'emplacement où tu veux placer ta page
    }
}

function file(fichier) {
    if (window.XMLHttpRequest) // FIREFOX
        xhr_object = new XMLHttpRequest();
    else if (window.ActiveXObject) // IE
        xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
    else return (false);
    xhr_object.open("GET", fichier, false);
    xhr_object.send(null);

    if (xhr_object.readyState == 4) return (xhr_object.responseText);
    else return (false);
}

setInterval('afficher("show_msgs_groups.php", "show_msg")', 1000); // nombre de milisecondes entre deux rafraichissements : ici 1 secondes
