ChromeVisitLog
==============

Log all chrome visit history ,search history ,and analyse your own habit data

1.关于本程序
    本意是想记录一下自己所使用的chrome浏览器上 ，使用google的搜索关键词和所有访问url的记录，用于达到一定数据量以后
    对于自己行为和习惯的一个分析 
    建立自己的搜索/知识数据库
        （并可能以后增加扩展功能，如搜索phpinfo not working这个问题时，找到了一个好的解决 方案，可以通过扩展或者其他方
    式标记为有用，下次在搜索完全相同的关键词时，可以通过程序检索出来，并进行提示）
        (达到一定数据量级以后，可以针对自己访问的历史记录进行分类，并建立自己的知识搜索库保存高质量的有用的知识)

2.具体实现
       
       所使用浏览器确定为Chrome

        要对搜索的输入实现ajax提示？ 比如输入ph ，使用下拉来显示 php phpinfo等 ？

        记录在google搜索的关键词    并不困难，只要在设置选项自定义地址栏搜索的引擎，通过php记录keyword以后，然后再重定向到
    google即可，目前没能记录的是对于搜索结果的访问情况（如你访问了搜索结果中的哪个页面等诸如此类）

        记录所有URL的历史记录      目前可以通过手动导出chrome浏览器的history文件来完成（网上搜到的，没测试），但是并不是
    比较好的解决办法

        记录所有URL的一个相对比较完美的办法是自己编写chrome的extension，通过js进行记录，但是很可能出现的一个问题是对于数据的
    向服务器的跨域同步，不过这个应该 也是可以解决的

        目前有一个做的比较好的扩展可以参考：    timeStats （它自己的介绍是：You will be surprised how much time you spent on particular web pages.）
        还有一个扩展，可以同步历史记录到google的， https://chrome.google.com/webstore/detail/updater-for-google-web-hi/ibhehjeahclandhcpbajhdfjeffnbcoa
        名字叫做：Updater for Google Web History
        PS: Chrome 浏览器的API可以参考这里  http://developer.chrome.com/extensions/overview.html

3.项目进度
    如有兴趣共同参与，欢迎通过email: bjzhush#gmail.com 联系我
    
    2013/06/24   刚刚启动，还有很多想法和做法都还没完善，需要进一步实验和测试
    2013/06/26   已经通过劫持toolbarqueries.google.com{.hk} 记录了chrome的所有访问记录，本项目之前的文件作废
                usage: 1.在你的VPS上新建2个vhost，可以为同一目录，host name 为 toolbarqueries.google.com.hk 和 toolbarqueries.google.com
                       2.上传index.php 和 .htaccess ，chromeurllog.sql到此文件夹
                       3.修改index.php 的数据库配置
                       4.导入sql文件，库名为google
                       5.重启apache
                       6.修改 toolbarqueries.google.com.hk  toolbarqueries.google.com 的DNS指向为你自己的php所在的ip
                       7.访问一个url，察看是否运行正常
                       

4.ToDoList
    1.在记录的同时，file_get_contengs去抓取title？(由于目前使用的是浏览器自身发送的，为保持通用性和兼容性，不适合修改api或自己写插件去发送title到server)

