
<nav class="flex-layout flex-layout-horizontal">
<!--
<ul class="menu">
<?php foreach( $navitems as $a){ ?>
<li>
    <a href="<?= $a['link']?>" style="width:<?= (int)(99.9/count($navitems)) ?>vw;"><?= $a["title"] ?></a>
</li>
<?php } ?>
</ul>
-->
<?php foreach( $navitems as $a){ ?>

        <a href="<?= $a['link']?>" class="flex-item-lv1" style="height:100%"><div><p><?= $a["title"] ?></p></div></a>
<?php } ?>
</nav>