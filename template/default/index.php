<?php include $this->tmplPath . '/header.php'?>
    <div id="list">
        <ul class="list-group">
        <?php foreach ($assign['articles'] as $key => $article): ?>
            <li class="list-group-item">
                <a href="<?php echo $key ?>.html" style="font-size:20px;">
                    <?php echo $article['title'] ?>

                </a>
                <span class="pull-right"><?php echo $article['fileDate'] ?></span>
            </li>
        <?php endforeach?>
        </ul>
    </div>
    <nav>
        <ul class="pagination">
        <?php foreach ($assign['pagination'] as $page): ?>
            <li <?php if ($page['active']): ?>class="active"<?php endif?>>
                <a href="<?php echo $page['filename'] ?>.html"><?php echo $page['name'] ?></a>
            </li>
        <?php endforeach?>
        </ul>
    </nav>
<?php include $this->tmplPath . '/footer.php'?>