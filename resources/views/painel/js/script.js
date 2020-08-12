function getElementsByAttribute(attr, value) {
    var match = [];
    /* Get the droids we are looking for*/
    var elements = document.getElementsByTagName("*");
    /* Loop through all elements */
    for (var ii = 0, ln = elements.length; ii < ln; ii++) {
        if (elements[ii].nodeType === 1) {
            if (elements[ii].name != null) {
                /* If a value was passed, make sure it matches the elements */
                if (value) {
                    if (elements[ii].getAttribute(attr) === value)
                        match.push(elements[ii]);
                } else {
                    /* Else, simply push it */
                    match.push(elements[ii]);
                }
            }
        }
    }
    return match;
};


function isJson(item) {
    item = typeof item !== "string"
        ? JSON.stringify(item)
        : item;

    try {
        item = JSON.parse(item);
    } catch (e) {
        return false;
    }

    if (typeof item === "object" && item !== null) {
        return true;
    }

    return false;
}


function getOnlyNumbersOfString(string) {
    return string.replace(/\D/g, '');
}

function isFunction(functionToCheck) {
    return functionToCheck && {}.toString.call(functionToCheck) === '[object Function]';
}

function log(e) {
    console.log(e)
}

function redirect(url) {
    var ua = navigator.userAgent.toLowerCase(),
        isIE = ua.indexOf('msie') !== -1,
        version = parseInt(ua.substr(4, 2), 10);

    // Internet Explorer 8 and lower
    if (isIE && version < 9) {
        var link = document.createElement('a');
        link.href = url;
        document.body.appendChild(link);
        link.click();
    }

    // All other browsers can use the standard window.location.href (they don't lose HTTP_REFERER like Internet Explorer 8 & lower does)
    else {
        window.location.href = url;
    }
}

// Criação dinamica de links ajax
var ajaxLink = getElementsByAttribute('data-link-ajax', 'true');
$(ajaxLink).on('click', function (e) {

    var type = $(this).attr('data-json') ? 'POST' : 'GET';

    e.preventDefault();
    return new AjaxRequest($(this).attr('data-id'), 'data-id').setType(type).send() || false;
});


/**
 * Scripts de inicio
 */
style = "color:blue;font-size:2.1em;";
style2 = "color:green; font-weight:bold;font-size:1.1em;";
console.groupCollapsed("Creditos do desenvolvedor:");
console.info("%c-------------------------------------------------------------", style);
// console.info("%cEste é mais um site desenvolvido pela...", style2);
// console.info("%chttp://www.site.com.br",style);
console.info("%cTodos os direitos reservados © 2020", style);
console.info("%c-------------------------------------------------------------", style);
console.info("");
console.groupEnd();
