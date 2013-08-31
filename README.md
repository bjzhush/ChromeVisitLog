ChromeVisitLog
==============

Log all chrome visit history ,search history ,and analyse your own habit data

1.关于本程序的起源
    本意是想记录一下自己所使用的chrome浏览器上 ，使用google的搜索关键词和所有访问url的记录，用于达到一定数据量以后,对于自己行为和习惯的一个分析 
#    建立自己的搜索/知识数据库
#        （并可能以后增加扩展功能，如搜索phpinfo not working这个问题时，找到了一个好的解决 方案，可以通过扩展或者其他方
#    式标记为有用，下次在搜索完全相同的关键词时，可以通过程序检索出来，并进行提示）
#        (达到一定数据量级以后，可以针对自己访问的历史记录进行分类，并建立自己的知识搜索库保存高质量的有用的知识)
#    上面以#开头的想法,目前还没有完成
2.功能
    记录你的chrome访问过的所有的URL地址到mysql
    记录到mysql后,PHP 抓取你访问过的URL的title保存到mysql,积攒到一定量之后,可以对自己的行为产生的数据进行分析(目前还没有完成对应的程序,不过这个数据的使用就仁者见仁智者见智了)
    通过chrome上的tampermonkey运行js脚本,在你访问到历史访问过的页面时,在页面顶部展示一个小tips栏,里面有你访问过当前url的次数,第一次和最后一次访问的时间
    对于不想展示的页面,可以点击tips栏里面的链接关闭对于当前页面/当前域名(二级)的提示


3.安装配置
    主要包括 apache配置vhost , 本机绑定hosts , chrome基于tampermonkey扩展运行脚本
    a.在你的vps上(如果已经安装了git), git clone git@github.com:bjzhush/ChromeVisitLog.git ,获得一个ChromeVisitLog 文件夹
      如果没有安装git,可以通过下载 https://codeload.github.com/bjzhush/ChromeVisitLog/zip/master 解压后,获得一个ChromeVisitLog 文件夹
      ps: 如果你只需要记录一台电脑,并且这台电脑上也有apache,那么可以把这套程序部署到你电脑本机上 (不管是部署到vps还是本机,以后提到此机器统称为server)
    b.修改需要记录的电脑的hosts文件,将toolbarqueries.google.com toolbarqueries.google.com.hk 的hosts指向server的ip (vps的ip,如果是本机,则绑定127.0.0.1)
    d.在server上配置2个apapche的vhost,域名分别为 toolbarqueries.google.com  toolbarqueries.google.com.hk ,根目录为刚刚git或下载解压后形成的文件夹的根目录(ChromeVisitLog)
    e.在server上mysql里建立一个叫做google的库,导入文件夹内的 chromeurllog.sql 这个文件
    f.复制demo.config.php ,重命名为config.php ,设置自己的mysql密码,authkey
    g.重启apapche
    h.Chrome安装tampermonkey,手动新建一个,将visisedUrlTips.js的内容复制进去
    i.搜索 var baseUrl ,将值修改为你自己的http://toolbarqueries.google.com (也可以单独配一个vhost)
    j.修改 authkey为config.php内对应的值

4. 各种小问题及细节
    a.chrome通过全局代理浏览网页时,由于dns解析完全从远程发起(包括localhost),所以可能记录不到浏览记录
    b.https页面由于chrome默认的安全策略,无法运行脚本,所以目前只能记录浏览历史,不能通过脚本显示访问记录,故js脚本内匹配的也是http://
    c.目前已经采取了jquery的noconflict模式,但是在某些引入了jquery的html页面内,还是会引起问题,导致部分功能不正常(待解决)
