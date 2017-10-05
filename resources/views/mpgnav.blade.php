
<nav>
<ul class="menu">
<?php foreach( $navitems as $a){ ?>
<li>
    <a href="<?=$a['link']?>" style="width:<?= (int)(99.9/count($navitems)) ?>vw;"><?= $a["title"] ?></a>
</li>
<? } ?>
</ul>
</nav>