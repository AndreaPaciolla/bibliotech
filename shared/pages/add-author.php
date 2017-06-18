<?php $citta = getCities(); ?>


    <h2 class="sub-header">Aggiungi un nuovo autore</h2>
    <form id="add-book-form" method="POST" action="" name="add-author-form">

        <div class="form-group">
            <label for="inputNome">Nome</label>
            <input type="text" id="inputNome" name="nome" class="form-control" placeholder="Nome del nuovo autore" required>
        </div>

        <div class="form-group">
            <label for="inputCognome">Cognome</label>
            <input type="text" name="cognome" id="inputCognome" class="form-control" placeholder="Cognome del nuovo autore" required >
        </div>

        <div class="form-group">
            <label for="inputDataNascita">Data di nascita</label>
            <input type="date" name="data_nascita" id="inputDataNascita" class="form-control" placeholder="Data di nascita autore" required>
        </div>

        <div class="form-group">
            <label for="inputBiografia">Biografia</label>
            <input type="text" name="biografia" id="inputBiografia" class="form-control" placeholder="Biografia autore" required>
        </div>

        <div class="form-group">
            <label for="inputCittaResidenza">Citta di nascita</label>
            <select class="form-control" name="id_citta_nascita" id="inputCittaNascita">
                <?php foreach($citta as $citt => $c): ?>
                    <option value="<?php echo $c['id']; ?>" ><?php echo $c['nome']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button class="form-control btn btn-register" type="submit" name="form-add-author-submit">Aggiungi Autore</button>
    </form>


<?php

if(isset($_POST['form-add-author-submit'])) {
    if( addAuthor($_POST) ) {
        echo "<script>alert('Autore aggiunto');</script>";
        goHome();
    } else {
        echo "<script>alert('Errore! Autore non aggiunto.');</script>";
    }
}

?>