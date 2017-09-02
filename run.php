<?php
include 'vendor/autoload.php';

define('APP_PATH', dirname(__FILE__));

$m2bConfig = array(
    'url' => 'http://www.pmzhang.com',
    'title' => 'PM老张',
    'auth' => 'pmzhang',
    'description' => 'Product Management and PHP Development',
    'mdPath' => APP_PATH . '\..\md4blog/docs',
    'htmlPath' => APP_PATH . '\..\citywill.github.io',
    'tmplPath' => APP_PATH . '\template/default',
    'pageSize' => 10,
);

$mark2blog = new lib\mark2blog($m2bConfig);
$mark2blog->run();
$generated = $mark2blog->generated;

exec('cd ' . $m2bConfig['mdPath']);
echo 'cd ' . $m2bConfig['mdPath'];
exec('git commit -am "update"');
exec('git push origin');

echo '本次执行生成了' . $generated['article'] . '篇文章、' . $generated['index'] . '个索引页、' . $generated['rss'] . '；生成目录为' . $mark2blog->htmlPath;
