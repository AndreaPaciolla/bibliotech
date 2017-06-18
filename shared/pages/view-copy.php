<?php $copia = getCopyById($_GET['id_copia']); ?>
<?php $recensioni = getRatesByCopyId($_GET['id_copia']); ?>

<h2 class="sub-header">Copia di: <?php echo $copia['titolo']; ?></h2>

<table class="table table-striped">
    <tbody>
        <tr>
            <td>Nome</td>
            <td><a href="?action=viewBook&id_libro=<?php echo $copia['id_libro']; ?>"><?php echo $copia['titolo']; ?></a></td>
        </tr>
        <tr>
            <td>ISBN</td>
            <td><?php echo $copia['isbn']; ?></td>
        </tr>
        <tr>
            <td>Valutazione</td>
            <td>
                <?php if(is_array($recensioni) || is_object($recensioni)): ?>
                    <?php foreach($recensioni as $recensione => $value): ?>
                        <p>
                            <b>Voto</b>: <?php echo $value['voto']; ?><br>
                            <b>Commento: </b> <?php echo $value['commento'] ?>
                            <small><i>by <?php echo $value['nome_utente'] . ' ' . $value['cognome_utente']; ?></i></small>
                        </p>
                    <?php endforeach; ?>
                <?php else: ?>
                    Nessuna valutazione ricevuta per questa copia.
                <?php endif; ?>
            </td>
        </tr>
    </tbody>
</table>