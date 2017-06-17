<?php $book = getBookById($_GET['id_libro']); ?>
<?php $citta = getCities(); ?>

<h2 class="sub-header">Libro: <?php echo $book['titolo']; ?></h2>

<table class="table table-striped">
    <tbody>
        <tr>
            <td>Titolo</td>
            <td><?php echo $book['titolo']; ?></td>
        </tr>
        <tr>
            <td>ISBN</td>
            <td><?php echo $book['isbn']; ?></td>
        </tr>
        <tr>
            <td>Anno pubblicazione</td>
            <td><?php echo $book['anno_pubblicazione']; ?></td>
        </tr>
        <tr>
            <td>Casa editrice</td>
            <td><a href="?action=viewEditor&id_casa_editrice=<?php echo $book['id_casa_editrice'];?>" ><?php echo $book['casaeditrice']; ?></a></td>
        </tr>
        <tr>
            <td>Lingua</td>
            <td><?php echo $book['lingua']; ?></td>
        </tr>
        <tr>
            <td>Autori</td>
            <td><?php echo $book['isbn']; ?></td>
        </tr>
    </tbody>
</table>