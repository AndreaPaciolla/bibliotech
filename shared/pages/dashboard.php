<?php $bookCopies = getBookCopies(); ?>
<?php
    if(isRole('dipendente', $_SESSION['user']['id'])) {
        $prestitiAttuali = getPrestiti(true, 'all');
    } else {
        $prestitiAttuali = getPrestiti(true, $_SESSION['user']['id']);
    }
?>
<?php
    if(isRole('dipendente', $_SESSION['user']['id'])) {
        $prestitiPassati = getPrestiti(false, 'all');
    } else {
        $prestitiPassati = getPrestiti(false, $_SESSION['user']['id']);
    }
?>

<?php $libri = getBooks(); ?>

<!-- Libri nel catalogo -->
<?php if(isRole('dipendente', $_SESSION['user']['id'])): ?>
    <h2 class="sub-header">Libri nel catalogo della biblioteca</h2>
    <div class="table-responsive">
        <table class="table table-striped orderable">
            <thead>
            <tr>
                <th>#</th>
                <th>ISBN</th>
                <th>Titolo</th>
                <th>Edizione</th>
                <th>Casa editrice</th>
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($libri) || is_object($libri)): ?>
                <?php foreach($libri as $libro): ?>
                    <tr>
                        <td><a href="?action=viewBook&id_libro=<?php echo $libro['id_libro']; ?>"><?php echo $libro['id_libro']; ?></a></td>
                        <td><?php echo $libro['isbn']; ?></td>
                        <td><a href="?action=viewBook&id_libro=<?php echo $libro['id_libro']; ?>"> <?php echo $libro['titolo']; ?></a></td>
                        <td><?php echo $libro['edizione']; ?></td>
                        <td><a href="?action=viewEditor&id_casa_editrice=<?php echo $libro['id_casa_editrice']; ?>"><?php echo $libro['casaeditrice']; ?></a></td>
                        <td><a href="?action=editBook&id_libro=<?php echo $libro['id_libro']; ?>"><button class="btn btn-primary btn-sm">Edita</button></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Nessun libro disponibile nel catalogo della biblioteca</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <a href="?action=addBook"><button class="btn btn-primary btn-sm">Aggiungi nuovo libro</button></a>
        <a href="?action=addAuthor"><button class="btn btn-primary btn-sm">Aggiungi nuovo autore</button></a>
    </div> <!-- ./ fine libri nel catalogo -->
<?php endif; ?>

<h2 class="sub-header">Copie volumi presenti in biblioteca</h2>
<div class="table-responsive">
    <table class="table table-striped orderable">
        <thead>
        <tr>
            <th>#</th>
            <th>ISBN</th>
            <th>Titolo</th>
            <th>Autore</th>
            <th>Casa editrice</th>
            <th>Posizione</th>
            <th>Rating</th>
            <?php if(!isRole('dipendente', $_SESSION['user']['id'])): ?><th>Azioni</th><?php endif; ?>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($bookCopies) || is_object($bookCopies)): ?>
            <?php foreach($bookCopies as $book): ?>
                <tr>
                    <td><a href="?action=viewCopy&id_copia=<?php echo $book['id_copia']; ?>"><?php echo $book['id_copia']; ?></a></td>
                    <td><?php echo $book['isbn']; ?></td>
                    <td><a href="?action=viewBook&id_libro=<?php echo $book['id_libro']; ?>"> <?php echo $book['titolo_libro']; ?></a></td>
                    <td>
                        <?php $autori = getAuthorsByBookId( $book['id_libro'] ); ?>
                        <?php foreach($autori as $autore): ?>
                            <a href="?action=viewAuthor&id_autore=<?php echo $autore['id_autore']; ?>"> <?php echo $autore['nome'] . ' ' . $autore['cognome']; ?></a>,&nbsp;
                        <?php endforeach; ?>
                    </td>
                    <td><a href="?action=viewEditor&id_casa_editrice=<?php echo $book['id_casa_editrice']; ?>"><?php echo $book['casaeditrice']; ?></a></td>
                    <td><?php echo $book['copia_sezione'].'/'.$book['copia_scaffale'].'.'.$book['id_copia']; ?></td>
                    <td><?php echo round(getAverageRateByCopyId($book['id_copia'])['votomedio'], 2) . '/5'; ?></td>
                    <?php if(!isRole('dipendente', $_SESSION['user']['id'])): ?>
                        <td><a href="?action=richiediPrestito&id_copia=<?php echo $book['id_copia']; ?>"><button class="btn btn-primary btn-sm">Richiedi prestito</button></a></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">Nessun libro disponibile per prestito</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<h2 class="sub-header">Prestiti in corso</h2>
<div class="table-responsive">
    <table class="table table-striped orderable">
        <thead>
        <tr>
            <th>#</th>
            <th>Copia</th>
            <th>ISBN</th>
            <th>Titolo</th>
            <th>Autore</th>
            <th>Casa editrice</th>
            <th>Data inizio</th>
            <th>Riconsegna</th>
            <?php if(isRole('dipendente', $_SESSION['user']['id'])): ?><th>Utente</th><?php endif; ?>
            <th>Status</th>
            <th>Azioni</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($prestitiAttuali) || is_object($prestitiAttuali)): ?>
            <?php foreach($prestitiAttuali as $prestito): ?>
                <?php
                    $today = date_create(date("Y-m-d"));
                    $finishDate = date_create( $prestito['data_inizio'] );
                    $role = getRoleByUserId($prestito['id_utente']);
                    date_add($finishDate, date_interval_create_from_date_string($role['tempomax'].' days'));

                    $cssClass = '';
                    $status='';

                    if($prestito['stato_operativo'] == NULL) {
                        $cssClass = 'info';
                        $status = 'In attesa...';
                    } else {
                        switch( true ) {
                            case ($today==$finishDate): $cssClass = 'warning'; $status='In scadenza oggi'; break;
                            case ($today<$finishDate): $cssClass ='success'; $status='Regolare'; break;
                            case ($today>$finishDate): $cssClass ='danger'; $status='Scaduto'; break;
                        }
                    }
                ?>
                <tr class="<?php echo $cssClass; ?>">
                    <td><?php echo $prestito['id_prestito']; ?></td>
                    <td><?php echo $prestito['copia_sezione'].'/'.$prestito['copia_scaffale'].'.'.$prestito['id_copia']; ?></td>
                    <td><?php echo $prestito['isbn']; ?></td>
                    <td><?php echo $prestito['titolo_libro']; ?></td>
                    <td>
                        <?php $autori = getAuthorsByBookId( $prestito['id_libro'] ); ?>
                        <?php foreach($autori as $autore): ?>
                            <a href="?action=viewAuthor&id_autore=<?php echo $autore['id_autore']; ?>"> <?php echo $autore['nome'] . ' ' . $autore['cognome']; ?></a>,&nbsp;
                        <?php endforeach; ?>
                    </td>
                    <td><?php echo $prestito['casaeditrice']; ?></td>
                    <td><?php echo $prestito['data_inizio']; ?></td>
                    <td><?php echo date_format($finishDate, 'Y-m-d'); ?></td>
                    <?php if(isRole('dipendente', $_SESSION['user']['id'])): ?>
                        <td><a href="?action=viewUser&id_utente=<?php echo $prestito['id_utente']; ?>"><?php echo $prestito['nome_utente'] . ' ' . $prestito['cognome_utente']; ?></a></td>
                    <?php endif; ?>
                    <td><button onclick="javascript:void(0)" class="btn btn-xs btn-<?php echo $cssClass; ?>"><?php echo $status;?></button></td>
                    <?php if(!isRole('dipendente', $_SESSION['user']['id']) && $prestito['stato_operativo'] == true): ?>
                        <td><a href="?action=terminaPrestito&id_prestito=<?php echo $prestito['id_prestito']; ?>"><button class="btn btn-primary btn-sm">Termina prestito</button></a></td>
                    <?php endif; ?>

                    <?php if(isRole('dipendente', $_SESSION['user']['id']) && $prestito['stato_operativo'] == NULL): ?>
                        <td>
                            <a href="?action=approvaPrestito&id_prestito=<?php echo $prestito['id_prestito']; ?>"><button class="btn btn-success btn-xs">Ok</button></a>
                            <a href="?action=negaPrestito&id_prestito=<?php echo $prestito['id_prestito']; ?>"><button class="btn btn-danger btn-xs">No</button></a>
                        </td>
                    <?php endif; ?>

                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10">Nessun prestito attivo</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<h2 class="sub-header">Storico prestiti</h2>
<div class="table-responsive">
    <table class="table table-striped orderable">
        <thead>
        <tr>
            <th>ISBN</th>
            <th>Copia Richiesta</th>
            <th>Autore</th>
            <th>Data inizio</th>
            <th>Data fine</th>
            <th>Status</th>
            <?php if(isRole('dipendente', $_SESSION['user']['id'])): ?><th>Utente</th><?php endif; ?>
            <?php if(!isRole('dipendente', $_SESSION['user']['id'])): ?><th>Azioni</th><?php endif; ?>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($prestitiPassati) || is_object($prestitiPassati)): ?>
            <?php foreach($prestitiPassati as $prestito): ?>
                <tr>
                    <td><?php echo $prestito['isbn']; ?></td>
                    <td><a href="?action=viewCopy&id_copia=<?php echo $prestito['id_copia']; ?>"><?php echo $prestito['titolo_libro']; ?></a></td>
                    <td>
                        <?php $autori = getAuthorsByBookId( $prestito['id_libro'] ); ?>
                        <?php foreach($autori as $autore): ?>
                            <a href="?action=viewAuthor&id_autore=<?php echo $autore['id_autore']; ?>"> <?php echo $autore['nome'] . ' ' . $autore['cognome']; ?></a>,&nbsp;
                        <?php endforeach; ?>
                    </td>
                    <td><?php echo $prestito['data_inizio']; ?></td>
                    <td><?php echo $prestito['data_fine']; ?></td>
                    <td><?php echo ($prestito['stato_operativo']) ? '<a href="javascript:void(0);" class="btn btn-xs btn-success">Prestito Accettato</a>' : '<a href="javascript:void(0);" class="btn btn-xs btn-danger">Prestito Rifiutato</a>'; ?></td>
                    <?php if(isRole('dipendente', $_SESSION['user']['id'])): ?><td><a href="?action=viewUser&id_utente=<?php echo $prestito['id_utente']; ?>"><?php echo $prestito['nome_utente'] . ' ' . $prestito['cognome_utente']; ?></a></td><?php endif; ?>
                    <?php if(!isRole('dipendente', $_SESSION['user']['id'])): ?>
                        <td>
                            <?php if($prestito['voto_prestito'] == NULL && $prestito['stato_operativo'] == true): ?><a href="?action=valutaPrestito&id_prestito=<?php echo $prestito['id_prestito']; ?>"><button class="btn btn-primary btn-sm">Valuta</button></a><?php endif; ?>
                            <?php if($prestito['voto_prestito'] !== NULL): ?> <?php echo $prestito['voto_prestito'] . '/5 - <b>Commento: </b>'. $prestito['commento_prestito']; ?> <?php endif; ?>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Nessun prestito passato</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<?php

if(isset($_GET['action'])) {
    switch($_GET['action']) {
        case 'doLogout': doLogout(); goHome(); break;
        case 'richiediPrestito': doPrestito(); break;
        case 'terminaPrestito': approvaPrestito($_GET['id_prestito']); goHome(); break;
        case 'approvaPrestito': negaPrestito($_GET['id_prestito']); goHome(); break;
        case 'negaPrestito': endPrestito(); break;
    }
}

?>


