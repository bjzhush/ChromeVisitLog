// ==UserScript==
// @name          Visited URL Tips
// @description   Show a simple tips when you visit a url you have visited
// @author        bjzhush@gmail.com
// @run-at document-start
// @match         http://*/*
// @Run only in top frame default 
// ==/UserScript==

// Add jQuery
(function(){
    if ( !window.jQuery ) {
        var GM_Head = document.getElementsByTagName('head')[0] || document.documentElement,
        GM_JQ = document.createElement('script');
        GM_JQ.src = 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js';
        GM_JQ.type = 'text/javascript';
        GM_JQ.async = true;
        GM_Head.insertBefore(GM_JQ, GM_Head.firstChild);
    }
    function GM_wait() {
        if (typeof unsafeWindow.jQuery == 'undefined') {
            window.setTimeout(GM_wait, 100);
        } else {
            jquerymonkey = unsafeWindow.jQuery.noConflict(true);
            letsJQuery();
        }
    }
    
    GM_wait();
    function letsJQuery() {
        var baseUrl = 'http://localhost/ChromeVisitLog';
        jquerymonkey.ajax({
            type:       'post',
            //url:        'http://query.shuaizhu.com/tips.php',
            url:        baseUrl + '/tips.php',
            data:       {key : 'bj' , url : document.URL},
            dataType:   'json',
            success:    function (ajax) {
                if (ajax.status =='0') {
                    alert('An error occured when query chrome log ,error info : invalid key');
                }else if (ajax.status == '2') {
                // exclude domain or url
                } else {
                    if (ajax.info.count > 0) {
                        
                        jquerymonkey('body').prepend('<div align="center" id="zsTips"><h2><font color = "#ff0000">' 
                                                     + ajax.info.count 
                                                     +' </font>times visited ,first time at ' 
                                                     + ajax.info.time.first 
                                                     + ', last time at ' 
                                                     + ajax.info.time.last 
                                                     + '| <a target = "_blank" href="' + baseUrl + '/viewall.php?s=' 
                                                     + document.URL 
                                                     + '" >ViewAll</a> | ' 
                                                     + '<a target = "_blank" href = "' + baseUrl +'/disableshow.php?type=url&url=' + document.URL + '">Disable URL Tips</a>'
                                                     + ' | '
                                                     + '<a target = "_blank" href = "' + baseUrl + '/disableshow.php?type=domain&url=' + document.URL + '">Disable Domain Tips </a>'
                                                     + '<div id="zclose">x</div></h2></div>');
                        jquerymonkey('#zsTips').css('background-color', 'LightGoldenRodYellow');
                        jquerymonkey('#zclose').click(function(){ jquerymonkey('#zsTips').hide();});
                        
                    }
                }
            }
        });
    };
})();

