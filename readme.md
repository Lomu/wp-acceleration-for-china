WP Acceleration for China
=========================

替换Google CDN文件、Gravatar头像链接，加快WordPress打开速度，为WordPress中国用户提供加速

众所周知的一些原因，在国内使用WordPress建站会发现打开非常慢，所以就需要我们做一些优化工作了，`WP Acceleration for China`插件旨在为国内WordPress加速。

目前插件可以为常见的两种打开慢的情况进行提速：

1. Google CDN国内无法访问；
2. Gravatar头像国内无法访问。

加速原理：

1. 谷歌的静态资源之前一直用的是360的，但是感觉也不太稳定，偶尔也比较慢，并且360的不支持`https`，所以现在换成了`中国科学技术大学`提供的CDN链接；
2. Gravatar的头像链接替换成了https。