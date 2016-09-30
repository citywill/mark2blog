#Mark2blog，将markdown文档生成博客的php程序

mark2blog是用于将markdown文档生成博客的php程序。目前支持简单的模板，分页索引等功能。

##github
* http://github.com/citywill/mark2blog

##依赖
* https://github.com/erusev/parsedown
* https://github.com/sindresorhus/github-markdown-css

##安装
* 下载代码后使用composer安装依赖
* 不使用composer也可以下载包含完整代码的zip压缩包
* markdown文档中使用#标记作为博客标题

##DEMO
* [blog.pmzhang.com](http://blog.pmzhang.com)

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

##markdown
* 文档命名格式参考：`2015-08-31_note-agilely-with-workflowy.md`
* 头信息必须在文件的开始部分，并且需要按照YAML的格式（目前不支持多层）写在两行三个（或以上）虚线之间。头信息可以在模板中通过$assign数组获取
* 文档首行#标注的标题，将作为title头信息处理

```markdown
---
title: 用 Workflowy 高效记笔记
---

常在知乎看到有人这么推销笔记技巧：

![糟糕的笔记](src/2015-08-31_note-agilely-with-workflowy_godness.jpg)
```

或者

```markdown
#用 Workflowy 高效记笔记

常在知乎看到有人这么推销笔记技巧：

![糟糕的笔记](src/2015-08-31_note-agilely-with-workflowy_godness.jpg)
```

##todo list
* 生成rss
* 美化模板
    * ~~摘要~~
    * ~~标题图片~~
* about等单页的处理
* 分类和标签
* ~~临近文章导航~~
* ~~增加评论模块~~
* ~~解析头信息~~