<h1>Grybai visi</h1>
<ul>

<?php foreach($grybai as $grybas) : ?>

    
<li>
    <b>Id:<?= $grybas['id'] ?></b>  <?= $grybas['title'] ?> <?= $grybas['color'] ?> <?= $grybas['weight'] ?>
    <a href="<?= URL . 'grybai/edit/' . $grybas['id']?>">Redaguoti</a>
    <form action="<?= URL . 'grybai/delete/' . $grybas['id']?>" method="post">
        <button type="submit">trinti</button>
    </form>
</li>

<?php endforeach ?>

</ul>