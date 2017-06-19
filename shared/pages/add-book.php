<?php $currentProfile = $_SESSION['user']; ?>
<?php $ruoli = getRuoli(); ?>
<?php $citta = getCities(); ?>
<?php $autori = getAutori(); ?>
<?php $lingue = getLingue(); ?>
<?php $editors = getEditors(); ?>


<h2 class="sub-header">Aggiungi un nuovo libro</h2>
<form id="add-book-form" method="POST" action="" name="add-book-form">

    <div class="form-group">
        <label for="inputTitolo">Titolo</label>
        <input type="text" id="inputTitolo" name="titolo" class="form-control" placeholder="Titolo del libro" required>
    </div>

    <div class="form-group">
        <label for="inputIsbn">ISBN</label>
        <input type="text" name="isbn" id="inputIsbn" class="form-control" placeholder="isbn" required >
    </div>

    <div class="form-group">
        <label for="inputAnnoPubblicazione">Anno pubblicazione</label>
        <input type="date" name="anno_pubblicazione" id="inputAnnoPubblicazione" class="form-control" placeholder="anno pubblicazione" required>
    </div>

    <div class="form-group">
        <label for="inputEdizione">Edizione</label>
        <input type="text" name="edizione" id="inputEdizione" class="form-control" placeholder="Edizione del libro" required>
    </div>

    <div class="form-group">
        <label for="inputLingua">Lingua</label>
        <select class="form-control" name="id_lingua" id="inputLingua">
            <?php foreach($lingue as $lingua => $l): ?>
                <option value="<?php echo $l['id']; ?>" ><?php echo $l['nome_esteso']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="inputTelefono">Casa Editrice</label>
        <select class="form-control" name="id_casaeditrice" id="inputLingua">
            <?php foreach($editors as $editor => $e): ?>
                <option value="<?php echo $e['id']; ?>"><?php echo $e['denominazione']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="inputAutori">Autori</label>
        <?php foreach($autori as $autore => $a): ?>
            <br><input type="checkbox" name="autori[]" value="<?php echo $a['id']; ?>" > <?php echo $a['nome'] . ' ' . $a['cognome']; ?>
        <?php endforeach; ?>
    </div>

    <div class="form-group">
        <label for="inputCopieDisponibili">Copie disponibili</label>
        <input type="number" name="copie_disponibili" min="0" id="inputCopieDisponibili" class="form-control" placeholder="Copie disponibili" required>
    </div>

    <div class="form-group">
        <label for="inputSezione">Sezione</label>
        <input type="text" name="sezione" pattern="[A-Za-z]{3}" id="inputSezione" class="form-control" placeholder="Indicare la sezione" maxlength="3" required>
    </div>

    <div class="form-group">
        <label for="inputScaffale">Scaffale</label>
        <input type="text" name="scaffale" id="inputScaffale" class="form-control" placeholder="Indicare lo scaffale" required>
    </div>

    <button class="form-control btn btn-register" type="submit" name="form-add-book-submit">Aggiungi Libro</button>
</form>


<?php

if(isset($_POST['form-add-book-submit'])) {
    if( addBook($_POST) ) {
        echo "<script>alert('Libro aggiunto');</script>";
        goHome();
    } else {
        echo "<script>alert('Errore! Libro non aggiunto.');</script>";
    }
}

?>