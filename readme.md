WP Acceleration for China
=========================

替换Google CDN文件、Gravatar头像链接，加快WordPress打开速度，为WordPress中国用户提供加速。

众所周知的一些原因，在国内使用WordPress建站会发现打开非常慢，所以就需要我们做一些优化工作了，`WP Acceleration for China`插件旨在为国内WordPress加速。

**目前插件可以为常见的两种打开慢的情况进行提速：**

1. Google CDN国内无法访问；
2. Gravatar头像国内无法访问。

**加速原理：**

1. 谷歌的静态资源提供`中国科学技术大学`、`360网站卫士`、`极客族`三家可选替代方案；
2. Gravatar的头像提供`Gravatar https访问`、`Gravatar CN`、`V2EX`、`极客族`三家可替代方案。

**使用方法**

1. 将`wp-acceleration-for-china.php`里面的代码加入主题`functions.php`内；
2. 将`wp-acceleration-for-china.php`文件上传到主题目录，在`functions.php`文件里使用`include 'wp-acceleration-for-china.php';`引入；
3. 以插件的形式直接安装，在后台搜索插件名称，或者到<a target="_blank" href="https://wordpress.org/plugins/wp-acceleration-for-china/">https://wordpress.org/plugins/wp-acceleration-for-china/</a>下载插件。

**更新日志**
V1.5.0

https优化

V1.4.0

新增极客族CDN节点

V1.3.0

修复php5.2、PHP5.3不兼容问题

V1.2.0

1. 新增后台设置：设置->WP加速；
2. 增加可选择加速CDN镜像。
