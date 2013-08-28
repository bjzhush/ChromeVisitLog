// ==UserScript==
// @name          Visited URL Tips
// @description   Show a simple tips when you visit a url you have visited
// @author        bjzhush@gmail.com
// @match         http://*/*
// ==/UserScript==

var $;

// Add jQuery
(function(){
    if (typeof unsafeWindow.jQuery == 'undefined') {
        var GM_Head = document.getElementsByTagName('head')[0] || document.documentElement,
            GM_JQ = document.createElement('script');

        GM_JQ.src = 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js';
        GM_JQ.type = 'text/javascript';
        GM_JQ.async = true;

        GM_Head.insertBefore(GM_JQ, GM_Head.firstChild);
    }
    GM_wait();
})();

// Check if jQuery's loaded
function GM_wait() {
    if (typeof unsafeWindow.jQuery == 'undefined') {
        window.setTimeout(GM_wait, 100);
    } else {
        $ = unsafeWindow.jQuery.noConflict(true);
        letsJQuery();
    }
}

// All your GM code must be inside this function
function letsJQuery() {
     $.ajax({
            type:       'post',
            url:        'http://localhost/ChromeVisitLog/tips.php',
         data:       {key : 666888 , url : document.URL},
            dataType:   'json',
            success:    function (ajax) {
                if (ajax.status =='0') {
                    alert('An error occured when query chrome log ,error info : invalid key');
                } else {
                    if (ajax.info.count > 0) {
                    $('body').prepend('<div id ="zsTips">You visited current page  ' + ajax.info.count +' times ,The latest 5 time is  (' + ajax.info.time + ')</div>');
                    $('#zsTips').css('background-color', 'yellow');
                    }
                    
                       }
            }
        });

}
