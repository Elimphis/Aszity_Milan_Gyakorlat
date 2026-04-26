<?php

if (!isset($_SESSION['login'])) {

    die('A keresett oldal nem található!');

}

include(__DIR__ . '/../../logicals/uzenetek.php');

?>

<table id="kapcsolat_table" class="w-fa text-center">
    <tr>
        <th>ID</th>
        <th>Név</th>
        <th>Szöveg</th>
        <th>Beküldve</th>
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
                <td><?= $data['nev'] ?></td>
                <td><?= $data['szoveg'] ?></td>
                <td><?= $data['bekuldve'] ?></td>
            </tr>

        <?php endforeach; ?>

    <?php endif; ?>
</table>

<script>

    // fetch("/logicals/uzenetek.php")
    // .then(res => res.text())
    // .then(data => {

    //     console.log(data)           

    // })

</script>