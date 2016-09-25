#Mark2blog

mark2blog是用于将md文档生成博客的php程序。目前支持简单的模板，分页索引等功能。

##依赖
* https://github.com/erusev/parsedown
* https://github.com/sindresorhus/github-markdown-css

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
    'htmlPath' => APP_PATH . '/citywill.github.io',
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