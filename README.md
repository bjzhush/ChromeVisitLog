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

        记录在google搜索的关键词    并不困难，只要在设置选项自定义地址栏搜索的引擎，通过php记录keyword以后，然后再重定向到
    google即可，目前没能记录的是对于搜索结果的访问情况（如你访问了搜索结果中的哪个页面等诸如此类）

        记录所有URL的历史记录      目前可以通过手动导出chrome浏览器的history文件来完成（网上搜到的，没测试），但是并不是
    比较好的解决办法

        记录所有URL的一个相对比较完美的办法是自己编写chrome的extension，通过js进行记录，但是很可能出现的一个问题是对于数据的
    向服务器的跨域同步，不过这个应该 也是可以解决的

        目前有一个做的比较好的扩展可以参考：    timeStats （它自己的介绍是：You will be surprised how much time you spent on particular web pages.）

3.项目进度
    如有兴趣共同参与，欢迎通过email: bjzhush#gmail.com 联系我
    
    2013/06/24   刚刚启动，还有很多想法和做法都还没完善，需要进一步实验和测试


