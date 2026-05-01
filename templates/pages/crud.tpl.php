<?php

include(__DIR__ . '/../../logicals/crud.php');

?>

<a id="add_film" class="button primary flex w-fc" style="margin-bottom: 2rem;" href="/createfilm">Film felvétele</a>

<table class="w-fa text-center" id="crud-table">
    <tr>
        <th>ID</th>
        <th>Cím</th>
        <th>Év</th>
        <th>Hossz</th>
        <th></th>
    </tr>
    <?php if (empty($response) || isset($response['error'])) : ?>
        <tr>
            <td colspan="5">
                <?= htmlspecialchars($response['error'] ?? 'Nincs adat') ?>
            </td>
        </tr>
    <?php else : ?>

        <?php foreach($response['data'] as $data) : ?>

            <tr>
                <td><?= htmlspecialchars($data['id']) ?></td>
                <td><?= htmlspecialchars($data['cim']) ?></td>
                <td><?= htmlspecialchars($data['ev']) ?></td>
                <td><?= htmlspecialchars($data['hossz']) ?></td>
                <td>
                    <div class="flex row items-center gap-1">
                        <a href="/editfilm?id=<?= $data['id']; ?>" class="button primary">Szerkesztés</a>
                        <button class="button danger">Törlés</button>
                    </div>
                </td>
            </tr>

        <?php endforeach; ?>

    <?php endif; ?>
</table>