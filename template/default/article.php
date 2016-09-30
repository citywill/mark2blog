<?php include $this->tmplPath . '/header.php'?>

<div id="article">
    <div class="page-header">
        <h1><?php echo $assign['title'] ?> <small></small></h1>
        <?php if (isset($assign['update'])): ?>
            <p class="status" title="posted <?php echo $assign['date'] ?>">update <?php echo $assign['update'] ?></p>
        <?php else: ?>
            <p class="status">posted <?php echo $assign['date'] ?></p>
        <?php endif?>
    </div>

    <article class="markdown-body">
        <?php echo $assign['detail'] ?>
    </article >
</div>

<nav>
  <ul class="pager">
<?php if (isset($assign['previous'])): ?>
    <li class="previous"><a href="<?php echo $assign['previous']['wholeName'] ?>.html">&larr; <?php echo $assign['previous']['title'] ?></a></li>
<?php endif?>
<?php if (isset($assign['next'])): ?>
    <li class="next"><a href="<?php echo $assign['next']['wholeName'] ?>.html"><?php echo $assign['next']['title'] ?> &rarr;</a></li>
<?php endif?>
  </ul>
</nav>

<div class="comment">
    <div class="page-header">
        <h3>评论</h3>
    </div>
<!-- 多说评论框 start -->
    <div class="ds-thread" data-thread-key="<?php echo $assign['wholeName'] ?>" data-title="<?php echo $assign['title'] ?>" data-url="<?php echo $this->url . '/' . $assign['wholeName'] . '.html' ?>"></div>
<!-- 多说评论框 end -->
<!-- 多说公共JS代码 start (一个网页只需插入一次) -->
</div>
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