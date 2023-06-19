<?php include_once 'parts/header.php'; ?>
<?php include_once 'parts/menu.php'; ?>

<?php require_once 'controller/BookController.php'; ?>

<!-- Page de la liste des livres -->

<?php
    // créer le controller des livres
    $bookController = new BookController();

    if (!isset($_SESSION['search'])) {
        // récupère la liste des livres
        $listBook = $bookController->getList('');
    } else {
        $listBook = $_SESSION['search'];
    }
    // récupère la liste des noms des colonnes
    $columnsNames = array_keys($listBook[0]);
?>

<div class="container">

    <h1 class="my-4 text-center">Liste des livres</h1>
    
    <form class="mb-2 me-2" action="./controller/FormHandler.php" method="post" style="float:left;">
        <input type="text" name="search">
        <input class="btn btn-primary" type="submit" name="recherche" value="Rechercher">
    </form>
    <?php if (isset($_SESSION['user'])) : ?>
        <div class="text-left mb-2">
            <a class="btn btn-primary" href="Livre.php?type=Ajouter" role="button">Ajouter un livre</a>
        </div>
    <?php endif; ?> 
    <div class="table-responsive text-center" style="overflow:hidden;">
        <table class="display table table-bordered align-middle">
            <thead>
                <tr>
                    <?php for ($i = 1; $i < count($columnsNames); $i++) : ?>
                        <th scope="col"><?php echo $columnsNames[$i]?></th>      
                    <?php endfor; ?> 
                    <?php if (isset($_SESSION['user'])) : ?>
                        <th scope="col">Actions</th>
                    <?php endif; ?>  
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php for ($i = 0; $i < count($listBook); $i++) : ?>
                    <tr data-id="<?= $listBook[$i][$columnsNames[0]]?>">
                        <?php for ($y = 1; $y < count($listBook[$i]); $y++) : ?>
                            <td <?=$bookController->setAvailableColor($columnsNames[$y], $listBook[$i][$columnsNames[$y]], false)?> ><?php echo $listBook[$i][$columnsNames[$y]]?></td>      
                        <?php endfor; ?> 
                        <?php if (isset($_SESSION['user'])) : ?>
                        <td>
                            <div class="row">
                                <div class="col-4">
                                    <a class="btn btn-outline-dark" href="Livre.php?type=Ouvrir&idBook=<?= $listBook[$i][$columnsNames[0]]?>&available=<?= $listBook[$i][$columnsNames[4]]?>"><i class="fa-solid fa-circle-info fa-lg"></i></a>
                                </div>
                                <div class="col-4">
                                    <a class="btn btn-outline-dark" href="Livre.php?type=Modifier&idBook=<?= $listBook[$i][$columnsNames[0]]?>&available=<?= $listBook[$i][$columnsNames[4]]?>"><i class="fa-solid fa-pencil fa-lg"></i></a>
                                </div>
                                <div class="col-4">
                                    <form  action="./controller/FormHandler.php" method="post">
                                    <input type="hidden" name="bookId" id="bookId" value="<?= $listBook[$i][$columnsNames[0]]?>">
                                        <button type="submit" name="SupprimerLivre" class="btn btn-outline-dark"><i class="fa-solid fa-trash-can fa-lg" onclick="return confirm('Êtes-vous certain de vouloir supprimer <?= $listBook[$i][$columnsNames[1]]?> ?')"></i></button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <?php endif; ?>
                    </tr>      
                <?php endfor; ?> 
            </tbody>
        </table>
    </div>

</div>


<?php include_once 'parts/footer.php';