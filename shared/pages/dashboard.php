<?php $role = getRoleByUserId($_SESSION['user']['id']); ?>

<h2 class="sub-header">Copie volumi presenti in biblioteca</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>ISBN</th>
            <th>Titolo</th>
            <th>Autore</th>
            <th>Casa editrice</th>
            <th>Posizione</th>
            <th>Azioni</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($bookCopies) || is_object($bookCopies)): ?>
            <?php foreach($bookCopies as $book): ?>
                <tr>
                    <td><a href="?action=viewCopy&id_copia=<?php echo $book['id_copia']; ?>"><?php echo $book['id_copia']; ?></a></td>
                    <td><?php echo $book['isbn']; ?></td>
                    <td><a href="?action=viewBook&id_libro=<?php echo $book['id_libro']; ?>"> <?php echo $book['titolo_libro']; ?></a></td>
                    <td><a href="?action=viewAuthor&id_autore=<?php echo $book['id_autore']; ?>"> <?php echo $book['nome_autore'] . ' ' . $book['cognome_autore']; ?></a></td>
                    <td><a href="?action=viewEditor&id_casa_editrice=<?php echo $book['id_casa_editrice']; ?>"><?php echo $book['casaeditrice']; ?></a></td>
                    <td><?php echo $book['copia_sezione'].'/'.$book['copia_scaffale'].'.'.$book['id_copia']; ?></td>
                    <td><a href="?action=richiediPrestito&id_copia=<?php echo $book['id_copia']; ?>"><button class="btn btn-primary btn-sm">Richiedi prestito</button></a></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Nessun libro disponibile per prestito</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<h2 class="sub-header">Prestiti attuali</h2>
<div class="table-responsive">
    <table class="table table-striped">
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
                    date_add($finishDate, date_interval_create_from_date_string($role['tempomax'].' days'));

                    $cssClass = '';
                    $status='';

                    switch( true ) {
                        case ($today==$finishDate): $cssClass = 'warning'; $status='In scadenza oggi'; break;
                        case ($today<$finishDate): $cssClass ='success'; $status='Regolare'; break;
                        case ($today>$finishDate): $cssClass ='danger'; $status='Scaduto'; break;
                    }
                ?>
                <tr class="<?php echo $cssClass; ?>">
                    <td><?php echo $prestito['id_prestito']; ?></td>
                    <td><?php echo $prestito['copia_sezione'].'/'.$prestito['copia_scaffale'].'.'.$prestito['id_copia']; ?></td>
                    <td><?php echo $prestito['isbn']; ?></td>
                    <td><?php echo $prestito['titolo_libro']; ?></td>
                    <td><?php echo $prestito['nome_autore'] . ' ' . $prestito['cognome_autore']; ?></td>
                    <td><?php echo $prestito['casaeditrice']; ?></td>
                    <td><?php echo $prestito['data_inizio']; ?></td>
                    <td><?php echo date_format($finishDate, 'Y-m-d'); ?></td>
                    <td><button onclick="javascript:void(0)" class="btn btn-xs btn-<?php echo $cssClass; ?>"><?php echo $status;?></button></td>
                    <td><a href="?action=terminaPrestito&id_prestito=<?php echo $prestito['id_prestito']; ?>"><button class="btn btn-primary btn-sm">Termina prestito</button></a></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Nessun prestito attivo</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<h2 class="sub-header">Prestiti passati</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ISBN</th>
            <th>Titolo</th>
            <th>Autore</th>
            <th>Data inizio</th>
            <th>Data fine</th>
            <th>Azioni</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($prestitiPassati) || is_object($prestitiPassati)): ?>
            <?php foreach($prestitiPassati as $prestito): ?>
                <tr>
                    <td><?php echo $prestito['isbn']; ?></td>
                    <td><?php echo $prestito['titolo_libro']; ?></td>
                    <td><?php echo $prestito['nome_autore'] . ' ' . $prestito['cognome_autore']; ?></td>
                    <td><?php echo $prestito['data_inizio']; ?></td>
                    <td><?php echo $prestito['data_fine']; ?></td>
                    <td>
                        <?php if($prestito['voto_prestito'] == NULL): ?><a href="?action=valutaPrestito&id_prestito=<?php echo $prestito['id_prestito']; ?>"><button class="btn btn-primary btn-sm">Valuta</button></a><?php endif; ?>
                        <?php if($prestito['voto_prestito'] !== NULL): ?> <?php echo $prestito['voto_prestito'] . '/5 - <b>Commento: </b>'. $prestito['commento_prestito']; ?> <?php endif; ?>
                    </td>
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
        case 'doLogout': doLogout(); break;
        case 'richiediPrestito': doPrestito(); break;
        case 'terminaPrestito': endPrestito(); break;
    }
}

?>