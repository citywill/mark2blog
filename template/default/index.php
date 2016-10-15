<?php include $this->tmplPath . '/header.php'?>

<div id="articleList">

<?php foreach ($assign['articles'] as $wholeName => $article): ?>

    <div class="page-header">

        <h2>
            <a href="<?php echo $wholeName ?>.html">
                <?php echo $article['title'] ?>
            </a>
        </h2>

        <p class="status"><span<?php if (isset($article['update'])): ?> title="updated <?php echo $article['update'] ?>"<?php endif?>>posted <?php echo $article['date'] ?></span></p>

        <?php if (isset($article['excerpt'])): ?>
            <p class="excerpt"><?php echo $article['excerpt'] ?></p>
        <?php endif?>

        <?php if (isset($article['image'])): ?>
            <p class="image"><img class="img-responsive" src="<?php echo $article['image'] ?>" alt="<?php echo isset($article['imageAlt']) ? $article['imageAlt'] : $article['title']; ?>" /></p>
        <?php endif?>

        <p class="readmore" style="text-align: right">
            <a href="<?php echo $wholeName ?>.html" class="btn btn-danger">阅读全文</a>
        </p>

    </div>

<?php endforeach?>

</div>

<?php
/* if (count($assign['pagination']) > 1): ?>
<nav>
<ul class="pagination">
<?php foreach ($assign['pagination'] as $page): ?>
<li <?php if ($page['active']): ?>class="active"<?php endif?>>
<a href="<?php echo $page['filename'] ?>.html"><?php echo $page['name'] ?></a>
</li>
<?php endforeach?>
</ul>
</nav>
<?php endif;*/?>

<?php if (count($assign['pagination']) > 1): ?>
<nav>
    <ul class="pager">
<?php if (isset($assign['previous'])): ?>
        <li class="previous"><a href="<?php echo $assign['previous']['filename'] ?>.html">&larr; 上一页</a></li>
<?php endif?>
<?php if (isset($assign['next'])): ?>
        <li class="next"><a href="<?php echo $assign['next']['filename'] ?>.html">下一页 &rarr;</a></li>
<?php endif?>
    </ul>
</nav>
<?php endif?>

<?php include $this->tmplPath . '/footer.php'?>