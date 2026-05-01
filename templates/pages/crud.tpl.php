<?php

include(__DIR__ . '/../../logicals/crud.php');

?>

<button class="button primary" style="margin-bottom: 2rem;">Film felvétele</button>

<table class="w-fa text-center" id="crud-table">
    <tr>
        <th>ID</th>
        <th>Cím</th>
        <th>Év</th>
        <th>Hossz</th>
        <th></th>
    </tr>
    <?php if (!isset($response) || isset($response['error'])) : ?>
        <tr>
            <td colspan="4">
                <?= $response['error']; ?>
            </td>
        </tr>
    <?php else : ?>

        <?php foreach($response['data'] as $data) : ?>

            <tr>
                <td><?= $data['id'] ?></td>
                <td><?= $data['cim'] ?></td>
                <td><?= $data['ev'] ?></td>
                <td><?= $data['hossz'] ?></td>
                <td>
                    <div class="flex row items-center gap-1">
                        <button class="button primary">Szerkesztés</button>
                        <button class="button danger">Törlés</button>
                    </div>
                </td>
            </tr>

        <?php endforeach; ?>

    <?php endif; ?>
</table>

<script>

    

</script>