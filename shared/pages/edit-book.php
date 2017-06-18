<?php $currentProfile = $_SESSION['user']; ?>
<?php $ruoli = getRuoli(); ?>
<?php $citta = getCities(); ?>
<?php $autori = getAutori(); ?>
<?php $lingue = getLingue(); ?>
<?php $editors = getEditors(); ?>

<?php
    function getIds($var) {
        return $var['id_autore'];
    }
?>

<!-- EDITA LIBRO -->
<?php if(isset($_GET['id_libro'])): ?>

    <?php $book = getBookById($_GET['id_libro']); ?>
    <?php $autorilibro = getAuthorsByBookId($_GET['id_libro']); ?>

    <h2 class="sub-header">Edita il libro "<?php echo $book['titolo']; ?>"</h2>
    <form id="edit-form" method="POST" action="" name="form-edit-book">

        <div class="form-group">
            <label for="inputTitolo">Titolo</label>
            <input type="text" id="inputTitolo" value="<?php echo $book['titolo']; ?>" name="titolo" class="form-control" placeholder="Titolo del libro" required>
        </div>

        <div class="form-group">
            <label for="inputIsbn">ISBN</label>
            <input type="text" name="isbn" value="<?php echo $book['isbn']; ?>" id="inputIsbn" class="form-control" placeholder="isbn" required disabled>
        </div>

        <div class="form-group">
            <label for="inputAnnoPubblicazione">Anno pubblicazione</label>
            <input type="date" name="anno_pubblicazione" value="<?php echo $book['anno_pubblicazione']; ?>" id="inputAnnoPubblicazione" class="form-control" placeholder="anno pubblicazione" required>
        </div>

        <div class="form-group">
            <label for="inputLingua">Lingua</label>
            <select class="form-control" name="id_lingua" id="inputLingua">
                <?php foreach($lingue as $lingua => $l): ?>
                    <option value="<?php echo $l['id']; ?>" <?php echo ($l['id'] == $book['id_lingua']) ? 'selected' : ''; ?> ><?php echo $l['nome']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="inputTelefono">Casa Editrice</label>
            <select class="form-control" name="id_casa_editrice" id="inputLingua">
                <?php foreach($editors as $editor => $e): ?>
                    <option value="<?php echo $e['id']; ?>" <?php echo ($e['id'] == $book['id_casa_editrice']) ? 'selected' : ''; ?> ><?php echo $e['denominazione']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="inputAutori">Autori</label>
            <?php foreach($autori as $autore => $a): ?>
                <br><input type="checkbox" name="autori" disabled value="<?php echo $a['id']; ?>" <?php echo (in_array($a['id'], array_map("getIds", $autorilibro))) ? 'checked' :'' ?> > <?php echo $a['nome'] . ' ' . $a['cognome']; ?>
            <?php endforeach; ?>
        </div>

        <button class="form-control btn btn-register" type="submit" name="form-edit-book-submit">Edita Libro</button>
    </form>
<?php endif; ?>


<?php

if(isset($_POST['form-edit-book-submit'])) {
    if( editBook($_POST, $_GET['id_libro']) ) {
        echo "<script>alert('Libro editato');</script>";
        goHome();
    } else {
        echo "<script>alert('Errore! Libro non editato.');</script>";
    }
}

?>