<form method="POST" action="">
    <h2 class="sub-header">Valuta il tuo prestito</h2>
    <div class="form-group">
        <label for="inputVoto">* Dai un punteggio al servizio e alla copia libro (<small><i>Da 0 a 5</i></small>)</label>
        <input type="number" id="inputVoto" min="0" max="5" class="form-control" name="voto" required>
    </div>

    <div class="form-group">
        <label for="inputCommento">* Scrivi una breve recensione</label>
        <textarea name="commento" id="inputCommento" cols="30" rows="10" style="width:100%" required></textarea>
    </div>

    <div class="form-group">
        <button type="submit" name="submit" class="btn btn-primary">Invia recensione</button>
    </div>
</form>

<?php
// SIGN UP FORM
if(isset($_POST['submit'])) {
    if( evaluatePrestito($_GET['id_prestito'], $_POST['voto'], $_POST['commento']) ) {
        echo "<script>alert('Testo valutato');</script>";
        header("Location: ./");
    } else {
        echo "<script>alert('Riprovare, valutazione non riuscita.');</script>";
    }
}