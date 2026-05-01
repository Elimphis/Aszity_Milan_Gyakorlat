<?php

include(__DIR__ . '/../../logicals/crud.php');

?>

<?php if (empty($response) || isset($response['error'])) : ?>
    <h3 style="color: red">
        <?= htmlspecialchars($response['error'] ?? 'Nincs adat') ?>
    </h3>
<?php else : ?>

    <?php $data = $response['data'][0]; ?>

    <form class="flex col items-center gap-1" id="crud-form" method="POST" action="crud" enctype="multipart/form-data">

        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="<?= $data['id'] ?? '' ?>">

        <div class="flex col">
            <label for="film_cim">Film címe</label>
            <input type="text" id="film_cim" name="film_cim" value="<?= $data['cim'] ?? '' ?>" placeholder="Film címe" required />
        </div>

        <div class="flex col">
            <label for="film_ev">Film éve</label>
            <input type="number" id="film_ev" name="film_ev" min="0"  value="<?= $data['ev'] ?? '' ?>" placeholder="Film éve" required />
        </div>

        <div class="flex col">
            <label for="film_hossz">Film hossza</label>
            <input type="number" id="film_hossz" name="film_hossz" min="0"  value="<?= $data['hossz'] ?? '' ?>" placeholder="Film hossza" required />
        </div>

        <div class="flex row items-center gap-1">
            <button class="button primary" type="submit">Mentés</button>
            <a class="button" href="/crud">Mégsem</a>
        </div>

    </form>

<?php endif; ?>