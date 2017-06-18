<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./">Bibliotech</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="?action=editProfile">Profile</a></li>
                <li><a href="?action=doLogout">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 main">

            <?php
                if(isset($_GET['action'])) {
                    switch ($_GET['action']) {
                        case 'viewAuthor': include_once __DIR__ . DIRECTORY_SEPARATOR . "..". DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "view-author.php"; break;
                        case 'addBook': include_once __DIR__ . DIRECTORY_SEPARATOR . "..". DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "add-book.php"; break;
                        case 'addAuthor': include_once __DIR__ . DIRECTORY_SEPARATOR . "..". DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "add-author.php"; break;
                        case 'editBook': include_once __DIR__ . DIRECTORY_SEPARATOR . "..". DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "edit-book.php"; break;
                        case 'viewUser': include_once __DIR__ . DIRECTORY_SEPARATOR . "..". DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "view-user.php"; break;
                        case 'viewEditor': include_once __DIR__ . DIRECTORY_SEPARATOR . "..". DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "view-editor.php"; break;
                        case 'viewBook': include_once __DIR__ . DIRECTORY_SEPARATOR . "..". DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "view-book.php"; break;
                        case 'viewCopy': include_once __DIR__ . DIRECTORY_SEPARATOR . "..". DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "view-copy.php"; break;
                        case 'valutaPrestito': include_once __DIR__ . DIRECTORY_SEPARATOR . "..". DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "evaluate-prestito.php"; break;
                        case 'editProfile': include_once __DIR__ . DIRECTORY_SEPARATOR . "..". DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "edit-profile.php"; break;
                        default: include_once __DIR__ . DIRECTORY_SEPARATOR . "..". DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "dashboard.php";
                    }
                } else {
                    include_once __DIR__ . DIRECTORY_SEPARATOR . "..". DIRECTORY_SEPARATOR . "pages" . DIRECTORY_SEPARATOR . "dashboard.php";
                }
            ?>

        </div>
    </div>
</div>