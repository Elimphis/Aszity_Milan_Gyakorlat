<?php

    include('./includes/config.inc.php');

    $target_dir     = $uploads['target'];
    $images         = glob($target_dir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

?>

<h2>Képek</h2>
<hr />

<div class="flex row gap-1 w-fa">

    <div class="flex row wrap gallery-container"> 
        
        <?php foreach ($images as $image) : ?>
    
            <img src="<?= $image; ?>" />

        <?php endforeach; ?>

    </div>

    <?php if(isset($_SESSION['login'])): ?>

        <?php if(isset($errormessage)) { ?>
            <h2><?= $errormessage ?></h2>
        <?php } ?>

        <div class="flex col gap-1">
            <h3>Kép feltöltése</h3>
            <form class="flex col gap-1" method="POST" action="feltoltes" enctype="multipart/form-data">
                <input type="file" name="imageUpload" accept="image/*" />
                <button type="submit" name="submit" class="w-mc">Képek feltöltése</button>
            </form>
        </div>

    <?php endif; ?>

</div>