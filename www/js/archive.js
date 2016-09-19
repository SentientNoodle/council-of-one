function postLinkHeight() {
    var dl = document.getElementsByClassName('result-header');
    var al = document.getElementsByClassName('post-link');
    
    for (var i = 0; i < dl.length; i++) {
        al[i].style.height = dl[i].offsetHeight+2 + 'px';
    }
}

function dullEdge(o) {
    var p = o.parentElement;
    if (o.getAttribute('aria-expanded') == "true") {
        p.style.borderBottomRightRadius = "0px";
    } else {
        p.style.borderBottomRightRadius = "4px";
    }
}