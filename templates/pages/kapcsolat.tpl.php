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

<script>

    /**
     * Kapcsolat urlap adatainak ellenorzese, majd fetch api meghivasaval
     * elkuldjuk az adatokat a backend fele.
     */

    document.getElementById("kapcsolat_form").addEventListener("submit", async (e) => {

        e.preventDefault();

        const teljesNev = document.getElementById('teljes_nev');
        const szoveg    = document.getElementById('szoveg');
        const errCon    = document.getElementById('errorMessageCon');

        if (teljesNev.value < 1) {

            errCon.textContent = "Teljes Név mező kitöltése kötelező!";
            return;

        }

        if (szoveg.value < 1) {

            errCon.textContent = "Szöveg mező kitöltése kötelező!";
            return;

        }

        errCon.textContent = "";

        const kapcsoladAdat = {
            nev     : teljesNev.value,
            szoveg  : szoveg.value
        }


        await fetch("/logicals/kapcsolat.php", {
            method  : "POST",
            headers : {"Content-Type": "application/json"},
            body    : JSON.stringify(kapcsoladAdat)
        })
        .then(res => res.json())
        .then(data => {

            if (data['error']) {

                errCon.textContent = data['error'];
                return;

            }

            window.location.href = "/";            

        })


    })

</script>