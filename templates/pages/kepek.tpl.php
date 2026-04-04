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

        <div class="flex col gap-1">
            <h3>Kép feltöltése</h3>
            <form class="flex col gap-1" method="POST" action="/includes/upload.image.inc.php">
                <input type="file" accept="image/*" />
                <button type="submit" class="w-mc">Képek feltöltése</button>
            </form>
        </div>

    <?php endif; ?>

</div>