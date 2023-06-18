<?php include_once 'parts/header.php'; ?>
<?php include_once 'parts/menu.php'; ?>

<?php require_once 'controller/BookController.php'; ?>

<!-- Page d'accueil -->

<?php 
    // créer le controller des livres
    $bookController = new BookController();

    // récupère la liste des livres
    $listBook = $bookController->getListLast();
    // récupère la liste des noms des colonnes
    $columnsNames = array_keys($listBook[0]);
?>

<div class="container">

    <h1 class="my-4 text-center">Livres récemment ajoutés</h1>
    
    <div class="text-left mb-2">
        <a class="btn btn-primary" href="ListeLivres.php" role="button">Voir la liste complète</a>
    </div>
    
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php for ($i = 0; $i < count($listBook); $i++) : ?>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $listBook[$i]['Titre']?></h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><?= $listBook[$i]['Auteur']?></h6>
                        <h6 class="card-subtitle mb-2 text-body-secondary"><?= $listBook[$i]['Genre']?></h6>
                    </div>
                    <div class="card-footer bg-transparent <?=$bookController->setAvailableColor('Disponible/Réserver', $listBook[$i]['Disponible/Réserver'], true)?>"><?= $listBook[$i]['Disponible/Réserver']?></div>
                </div>
            </div>
        <?php endfor; ?> 
    </div>

</div>

<?php include_once 'parts/footer.php';