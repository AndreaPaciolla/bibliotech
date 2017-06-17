
<?php $bookCopies = getBookCopies(); ?>
<?php $prestitiAttuali = getPrestiti(true, $_SESSION['user']['id']); ?>
<?php $prestitiPassati = getPrestiti(false, $_SESSION['user']['id']); ?>



<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="?action=editProfile">Profile</a></li>
                <li><a href="?action=doLogout">Logout</a></li>
            </ul>
            <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 main">
            <!--<h1 class="page-header">Dashboard</h1>-->

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
                    <?php if(is_array($prestitiAttuali) || is_object($prestitiAttuali)): ?>
                        <?php foreach($prestitiAttuali as $prestito): ?>
                            <tr>
                                <td><?php echo $prestito['isbn']; ?></td>
                                <td><?php echo $prestito['titolo_libro']; ?></td>
                                <td><?php echo $prestito['nome_autore'] . ' ' . $prestito['cognome_autore']; ?></td>
                                <td><?php echo $prestito['casaeditrice']; ?></td>
                                <td><a href="?action=terminaPrestito"><button>Termina prestito</button></a></td>
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
                    <?php if(is_array($prestitiPassati) || is_object($prestitiPassati)): ?>
                        <?php foreach($prestitiPassati as $prestito): ?>
                            <tr>
                                <td><?php echo $prestito['isbn']; ?></td>
                                <td><?php echo $prestito['titolo_libro']; ?></td>
                                <td><?php echo $prestito['nome_autore'] . ' ' . $prestito['cognome_autore']; ?></td>
                                <td><?php echo $prestito['casaeditrice']; ?></td>
                                <td><a href="?action=valutaPrestito"><button>Valuta prestito</button></a></td>
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

        </div>
    </div>
</div>