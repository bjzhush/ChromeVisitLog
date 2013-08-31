// ==UserScript==
// @name          Visited URL Tips
// @description   Show a simple tips when you visit a url you have visited
// @author        bjzhush@gmail.com
// @run-at document-end
// @match         http://*/*
// @require       http://query.shuaizhu.com/jquery.js
// @Run only in top frame default 
// @noframe
// ==/UserScript==

var baseUrl = 'http://query.shuaizhu.com';
var $ = unsafeWindow.jQuery;

$.ajax({
    type:       'post',
    //url:        'http://query.shuaizhu.com/tips.php',
    url:        baseUrl + '/tips.php',
    data:       {key : 'replaceYourOwnKeyHere' , url : document.URL},
    dataType:   'json',
    success:    function (ajax) {
        if (ajax.status =='0') {
            alert('An error occured when query chrome log ,error info : invalid key');
        }else if (ajax.status == '2'){
            // exclude domain or url
        } else {
            if (ajax.info.count > 0) {
                
                $('body').prepend('<div align="center" id="zsTips"><h2><font color = "#ff0000">' 
                                  + ajax.info.count 
                                  +' </font>times visited ,first time at ' 
                                  + ajax.info.time.first 
                                  + ', last time at ' 
                                  + ajax.info.time.last 
                                  + '| <a target = "_blank" href="' + baseUrl + '/viewall.php?s=' 
                                  + document.URL 
                                  + '" >ViewAll</a> | ' 
                                  + '<span id="hideUrl"><a target = "_blank" href = "' + baseUrl +'/disableshow.php?type=url&url=' + document.URL + '">Disable URL Tips</a></span>'
                                  + ' | '
                                  + '<span id="hideDomain"><a target = "_blank" href = "' + baseUrl + '/disableshow.php?type=domain&url=' + document.URL + '">Disable Domain Tips </a></span>'
                                  + '<div id="zclose">x</div></h2></div>');
                $('#zsTips').css('background-color', 'LightGoldenRodYellow');
                $('#zclose').click(function(){ $('#zsTips').remove();});
                $('#hideUrl').click(function(){
                    $('#zsTips').remove();
                });
                $('#hideDomain').click(function(){
                    $('#zsTips').remove();
                });
                
                
            }
        }
    }
});



