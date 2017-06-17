<form method="POST" action="">
    <h2 class="sub-header">Valuta il tuo prestito</h2>
    <div class="form-group">
        <input type="number" min="0" max="5" class="form-control" name="voto" required>
    </div>

    <div class="form-group">
        <textarea name="commento" id="commento" cols="30" rows="10" required></textarea>
    </div>

    <div class="form-group">
        <button type="submit" name="submit" class=""btn btn-small>Invia recensione</button>
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