<?php include $this->tmplPath . '/header.php'?>

<div class="article">
    <div class="page-header">
        <h1><?php echo $assign['title'] ?> <small></small></h1>
        <p style="padding-top:24px;">posted <?php echo $assign['date'] ?></p>
    </div>

    <article class="markdown-body">
        <?php echo $assign['detail'] ?>
    </article >
</div>

<nav style="margin-top:50px;">
  <ul class="pager">
<?php if (isset($assign['previous'])): ?>
    <li class="previous"><a href="<?php echo $assign['previous']['wholeName'] ?>.html">&larr; <?php echo $assign['previous']['title'] ?></a></li>
<?php endif?>
<?php if (isset($assign['next'])): ?>
    <li class="next"><a href="<?php echo $assign['next']['wholeName'] ?>.html"><?php echo $assign['next']['title'] ?> &rarr;</a></li>
<?php endif?>
  </ul>
</nav>

<!-- 多说评论框 start -->
<div class="ds-thread" style="margin-top:50px;" data-thread-key="<?php echo $assign['wholeName'] ?>" data-title="<?php echo $assign['title'] ?>" data-url="<?php echo $this->url . '/' . $assign['wholeName'] . '.html' ?>"></div>
<!-- 多说评论框 end -->
<!-- 多说公共JS代码 start (一个网页只需插入一次) -->
<script type="text/javascript">
var duoshuoQuery = {short_name:"pmzhang"};
    (function() {
        var ds = document.createElement('script');
        ds.type = 'text/javascript';ds.async = true;
        ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
        ds.charset = 'UTF-8';
        (document.getElementsByTagName('head')[0]
         || document.getElementsByTagName('body')[0]).appendChild(ds);
    })();
</script>
<!-- 多说公共JS代码 end -->


<?php include $this->tmplPath . '/footer.php'?>