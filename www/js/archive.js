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

function setPostboxHeight() {
    var b = document.getElementsByClassName('navbar-toggle')[0];
    var d = document.getElementsByClassName('postbox')[0];
    if (b.getAttribute('aria-expanded') == 'true') {
        d.style.height = 'calc(100vh - 70px)';
    } else {
        d.style.height = 'calc(100vh - 208px)';
    }
}

function resizePostboxHeight() {
    var b = document.getElementsByClassName('navbar-toggle')[0];
    var d = document.getElementsByClassName('postbox')[0];
    if (document.body.clientWidth >= 768) {
        d.style.height = 'calc(100vh - 70px)';
    } else {
        if (b.getAttribute('aria-expanded') == 'true') {
            d.style.height = 'calc(100vh - 208px)';
        } else {
            d.style.height = 'calc(100vh - 70px)';
        }
    }

    postLinkHeight();
}

function updateWeight(r,iw,fw,s) {
    $.ajax({
        type: 'POST',
        url: 'posts.php',
        data: {
            result: r,
            iweight: iw,
            fweight: fw,
            searches: s
        }
    });
}