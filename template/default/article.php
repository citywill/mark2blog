<?php include $this->tmplPath . '/header.php'?>
    <article class="markdown-body">
    <p class="pull-right" style="padding-top:24px;">posted <?php echo $assign['date'] ?></p>
    <?php echo $assign['detail'] ?>
    </article >

<!-- 多说评论框 start -->
    <div class="ds-thread" style="margin-top:30px;" data-thread-key="<?php echo $assign['wholeName'] ?>" data-title="<?php echo $assign['title'] ?>" data-url="<?php echo $this->url . '/' . $assign['wholeName'] . '.html' ?>"></div>
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