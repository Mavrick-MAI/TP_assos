<?php include_once __DIR__.'/parts/header.php'; ?>
<?php include_once __DIR__.'/parts/menu.php'; ?>

<?php require_once 'controller/BookController.php'; ?>

<!-- Page de consultation, ajout, modification d'un livre -->

<?php

    if (!isset($_SESSION['user'])) {
        header("Location:Accueil.php");
    }
    // récupère l'URL de la page actuelle
    $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    // récupère les différentes parties de l'URL
    $url_components = parse_url($actual_link);
    // récupère les paramètres
    parse_str($url_components['query'], $params);
    // récupère le paramètre de type d'action
    $actionType = $params['type'];

    // vérifie si un identifiant de livre est en paramètre
    if (isset($params['idBook'])) {
        // récupère l'identifiant
        $idBook = $params['idBook'];
        // créer le controller des livres
        $bookController = new BookController();
        // récupère le livre à partir de l'identifiant
        $book = $bookController->getById($idBook);
    }
?>

<div class="container">
    <!-- vérifie le type d'action -->
    <?php if ($actionType != "Ouvrir") : ?>
        <!-- cas d'un ajout ou d'une modification -->
        <!-- créer un formulaire -->
        <div class="text-center">
            <h1 class="my-4"><?=$actionType?> un livre</h1>

            <div class="row justify-content-center text-start">
                <form class="col-sm-12 col-lg-6" action="./controller/FormHandler.php" method="post">
                    <div class="mb-3">
                        <label for="bookTitle" class="form-label control-label">Titre</label>
                        <input type="text" class="form-control" id="bookTitle" name="bookTitle" required value="<?= isset($params['idBook']) ? $book['Titre'] : "" ?>" />
                    </div>
                    <div class="mb-3">
                        <label for="bookAuthor" class="form-label">Auteur</label>
                        <input type="text" class="form-control" id="bookAuthor" name="bookAuthor" value="<?= isset($params['idBook']) ? $book['Auteur'] : "" ?>" />
                    </div>
                    <div class="mb-3">
                        <label for="bookGenre">Genre</label>
                        <input type="text" class="form-control" id="bookGenre" name="bookGenre" value="<?= isset($params['idBook']) ? $book['Genre'] : "" ?>" />
                    </div>
                        <?php if ($actionType == "Modifier") : ?>
                            <!-- cas d'une modification -->
                            <!-- ajoute des champs supplémentaires -->
                            <div class="mb-3">
                                <label for="bookAvailable">Disponible/Réservé</label>
                                <select class="form-control" id="bookAvailable" name="bookAvailable">
                                    <option value="disponible" <?= ((isset($params['idBook'])) && ($book['Disponible/Réserver'])) ? "selected" : "" ?>>Disponible</option>
                                    <option value="reserve" <?= ((isset($params['idBook'])) && (!$book['Disponible/Réserver'])) ? "selected" : "" ?>>Réservé</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="bookBorrower">Emprunteur</label>
                                <input type="text" class="form-control" name="bookBorrower" id="bookBorrower">
                            </div>
                            <div class="mb-3">
                                <label for="bookBorrowStart">Date de l'emprunt</label>
                                <input type="date" class="form-control" name="bookBorrowStart" id="bookBorrowStart">
                            </div>
                            <div class="mb-4">
                                <label for="bookBorrowEnd">Date de retour prévu</label>
                                <input type="date" class="form-control" name="bookBorrowEnd" id="bookBorrowEnd">
                            </div>
                            <input type="hidden" name="bookId" id="bookId" value="<?= $book['Id'] ?>">
                        <?php endif; ?>
                    <a class="btn btn-warning" href="ListeLivres.php" role="button">Retour à la liste</a>
                    <input type="submit" class="btn btn-success" name="<?=$actionType?>Livre" value="Valider" />
                </form>
            </div>
        </div>
    <?php else : ?>
        <!-- cas d'une consultation d'information d'un livre -->

        <div class="row">
            <a class="col-2 offset-2 mt-4 btn btn-warning" href="ListeLivres.php" role="button">Retour à la liste</a>
        </div>

        <div class="text-center">

            <div class="row mb-4 justify-content-center">
                <h1 class="col-8 py-1 my-2 border border-black rounded"><?=$book['Titre']?></h1>
            </div>

            <div class="row mb-4 justify-content-center">
                <div class="col-4">
                    <h3 class="border border-black rounded">Auteur</h3>
                    <p><?=$book['Auteur']?></p>
                </div>
                <div class="col-4">
                    <h3 class="border border-black rounded">Genre</h3>
                    <p><?=$book['Genre']?></p>
                </div>
            </div>
            <div class="row mb-4 justify-content-center">
                <div class="col-4">
                    <h3 class="border border-black rounded">Disponible/Réservé</h3>
                    <p><?=$book['Disponible/Réserver'] ? "Disponible" : "Réservé" ?></p>
                </div>
            </div>
            <?php if(false) : ?>
            <div class="row mb-4 justify-content-center">
                <div class="col-4">
                    <h3 class="border border-black rounded">Emprunteur</h3>
                    <p><? isset($book['Emprunteur']) ? $book['Emprunteur'] : "" ?></p>
                </div>
                <div class="col-4">
                    <h3 class="border border-black rounded">Date de l'emprunt</h3>
                    <p><? isset($book['DateEmprunt']) ? $book['DateEmprunt'] : "" ?></p>
                </div>
            </div>
            <?php endif; ?>
            <div class="row mb-4 justify-content-center">
                <div class="col-4">
                    <h3 class="border border-black rounded">Date de retour prévu</h3>
                    <p><? isset($book['DateRetour']) ? $book['DateRetour'] : "" ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php include_once 'parts/footer.php';