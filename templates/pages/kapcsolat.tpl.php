<form id="kapcsolat_form" method="POST" action="kapcsolat" enctype="multipart/form-data">

    <fieldset>

        <legend>
            <h3>Vegye fel velünk a kapcsolatot!</h3>
        </legend><br />

        <div>
            <label for="teljes_nev">Teljes név</label><br />
            <input type="text" name="teljes_nev" id="teljes_nev" placeholder="Adja meg a teljes nevét" />
        </div><br />

        <div>
            <label for="szoveg">Teljes név</label><br />
            <textarea id="szoveg" name="szoveg" placeholder="Írja le üzenetét" rows="8" cols="64"></textarea>
        </div><br />

        <p style="color: red;" id="errorMessageCon">
            <?php if(isset($errormessage)) { ?>
                <?= $errormessage ?>
            <?php } ?>
        </p>

        <input type="submit" id="kapcsolat_submit" name="submit" value="Küldés"><br>

    </fieldset>

</form>