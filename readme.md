#Mark2blog

mark2blog是用于将markdown文档生成博客的php程序。目前支持简单的模板，分页索引等功能。

##依赖
* https://github.com/erusev/parsedown
* https://github.com/sindresorhus/github-markdown-css

##安装
* 下载代码后使用composer安装依赖
* 不使用composer也可以下载包含完整代码的zip压缩包
* markdown文档中使用#标记作为博客标题

##例子
```php
<?php
include 'vendor/autoload.php';

define('APP_PATH', dirname(__FILE__));

$mark2blogConfig = array(
    'title' => 'mark2blog',
    'auth' => 'citywill',
    'description' => 'mark2blog是用于将md文档生成博客的php程序。目前支持简单的模板，分页索引等功能。',
    'mdPath' => APP_PATH . '/markdown',
    'htmlPath' => APP_PATH . '/blog',
    'tmplPath' => APP_PATH . '/template/default',
    'pageSize' => 10,
);

$mark2blog = new lib\mark2blog($mark2blogConfig);
$mark2blog->run();
$generated = $mark2blog->generated;

echo
'本次执行生成了' . $generated['article'] . '篇文章<br>',
'以及' . $generated['index'] . '个索引页<br>',
'生成目录为' . $mark2blog->htmlPath;
```

##todo list
* 生成rss
* 美化模板
* about等单页的处理
* 临近文章导航
* 分类和标签
* 兼容jekyll
* ~~增加评论模块~~