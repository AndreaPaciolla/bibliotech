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
        <?php foreach($bookCopies as $book): ?>
            <tr>
                <td><?php echo $book['id_copia']; ?></td>
                <td><?php echo $book['isbn']; ?></td>
                <td><?php echo $book['titolo_libro']; ?></td>
                <td><?php echo $book['nome_autore'] . ' ' . $book['cognome_autore']; ?></td>
                <td><?php echo $book['casaeditrice']; ?></td>
                <td><?php echo $book['copia_sezione'].'/'.$book['copia_scaffale'].'.'.$book['id_copia']; ?></td>
                <td><a href="?action=richiediPrestito&id_copia=<?php echo $book['id_copia']; ?>"><button>Richiedi prestito</button></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<h2 class="sub-header">Prestiti attuali</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>ISBN</th>
            <th>Titolo</th>
            <th>Autore</th>
            <th>Casa editrice</th>
            <th>Data inizio</th>
            <th>Azioni</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($prestitiAttuali) || is_object($prestitiAttuali)): ?>
            <?php foreach($prestitiAttuali as $prestito): ?>
                <tr>
                    <td><?php echo $prestito['id_prestito']; ?></td>
                    <td><?php echo $prestito['isbn']; ?></td>
                    <td><?php echo $prestito['titolo_libro']; ?></td>
                    <td><?php echo $prestito['nome_autore'] . ' ' . $prestito['cognome_autore']; ?></td>
                    <td><?php echo $prestito['casaeditrice']; ?></td>
                    <td><?php echo $prestito['data_inizio']; ?></td>
                    <td><a href="?action=terminaPrestito&id_prestito=<?php echo $prestito['id_prestito']; ?>"><button>Termina prestito</button></a></td>
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
                        <?php if($prestito['voto_prestito'] == NULL): ?><a href="?action=valutaPrestito&id_prestito=<?php echo $prestito['id_prestito']; ?>"><button>Valuta</button></a><?php endif; ?>
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