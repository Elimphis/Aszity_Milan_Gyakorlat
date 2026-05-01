<form class="flex col items-center gap-1" id="crud-form" method="POST" action="crud" enctype="multipart/form-data">

    <div class="flex col">
        <label for="film_cim">Film címe</label>
        <input type="text" id="film_cim" name="film_cim" placeholder="Film címe" required />
    </div>

    <div class="flex col">
        <label for="film_ev">Film éve</label>
        <input type="number" id="film_ev" name="film_ev" min="0" placeholder="Film éve" required />
    </div>

    <div class="flex col">
        <label for="film_hossz">Film hossza</label>
        <input type="number" id="film_hossz" name="film_hossz" min="0" placeholder="Film hossza" required />
    </div>

    <div class="flex row items-center gap-1">
        <button class="button primary" type="submit">Létrehozás</button>
        <a class="button" href="/crud">Mégsem</a>
    </div>

</form>