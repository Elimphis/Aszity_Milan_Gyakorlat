<h2>Képek</h2>
<hr />

<div class="flex row gap-1 w-fa">

    <div class="flex row wrap gallery-container"> 
        <img src="/images/arc.jpg">
        <img src="/images/arc.jpg">
        <img src="/images/arc.jpg">
        <img src="/images/arc.jpg">
        <img src="/images/arc.jpg">
        <img src="/images/arc.jpg">
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