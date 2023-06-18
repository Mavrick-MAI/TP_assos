<?php include_once __DIR__.'/parts/header.php'; ?>
<?php include_once __DIR__.'/parts/menu.php'; ?>

<?php require_once 'controller/MemberController.php'; ?>

<!-- Page de consultation, ajout, modification d'un member -->

<?php

    // récupère l'URL de la page actuelle
    $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    // récupère les différentes parties de l'URL
    $url_components = parse_url($actual_link);
    // récupère les paramètres
    parse_str($url_components['query'], $params);
    // récupère le paramètre de type d'action
    $actionType = $params['type'];

    // vérifie si un identifiant de membre est en paramètre
    if (isset($params['idMembre'])) {
        // récupère l'identifiant
        $idMembre = $params['idMembre'];
        // créer le controller des membres
        $membreController = new MemberController();
        // récupère le livre à partir de l'identifiant
        $membre = $membreController->getById($idMembre);
    }
?>

<div class="container">
    <!-- vérifie le type d'action -->
    <?php if ($actionType != "Ouvrir") : ?>
        <!-- cas d'un ajout ou d'une modification -->
        <!-- créer un formulaire -->
        <div class="text-center">

            <?php if ($actionType == 'Ajouter') : ?>
                <h1 class="my-4">Formulaire d'inscription</h1>
            <?php else : ?>
                <h1 class="my-4"><?=$actionType?> un membre</h1>
            <?php endif; ?>

            <div class="row justify-content-center text-start">
                <form class="col-sm-12 col-lg-6" action="./controller/FormHandler.php" method="post">

                    <?php if ($actionType == 'Modifier') : ?>
                        <input type="hidden" name="memberId" id="memberId" value="<?= $membre['Id'] ?>" />
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="memberLastName" class="form-label control-label" id="test">Nom</label>
                        <input type="text" class="form-control" id="memberLastName" name="memberLastName" required value="<?= isset($params['idMembre']) ? $membre['Nom'] : "" ?>" />
                    </div>
                    <div class="mb-3">
                        <label for="memberFirstName" class="form-label control-label">Prenom</label>
                        <input type="text" class="form-control" id="memberFirstName" name="memberFirstName" required value="<?= isset($params['idMembre']) ? $membre['Prénom'] : "" ?>" />
                    </div>
                    <div class="mb-3">
                        <label for="memberPhone" class="form-label control-label">Téléphone</label>
                        <input type="text" class="form-control" id="memberPhone" name="memberPhone" minlength="6" maxlength="6" required value="<?= isset($params['idMembre']) ? $membre['Téléphone'] : "" ?>" />
                    </div>
                        <?php if ($actionType == "Ajouter") : ?>
                            <!-- cas d'une inscription -->
                            <!-- ajoute des champs supplémentaires -->
                            <div class="mb-3">
                                <label for="memberEmail" class="form-label control-label">Email</label>
                                <input type="email" class="form-control" id="memberEmail" required name="memberEmail" />
                            </div>
                            <div class="mb-3">
                                <label for="memberPassword" class="form-label control-label">Mot de passe</label>
                                <input type="password" class="form-control" name="memberPassword" id="memberPassword" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&+=]).{12,}$" required />
                                <div class="form-text">Le mot de passe doit contenir au moins 12 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.</div>
                            </div>
                            <div class="mb-3">
                                <label for="memberConfirmPassword" class="form-label control-label">Confirmer mot de passe</label>
                                <input type="password" class="form-control" name="memberConfirmPassword" id="memberConfirmPassword" required />
                            </div>
                            <div class="mb-4">
                                <label for="memberSecretQuestion" class="form-label control-label">Question secrète</label>
                                <select class="form-control" id="memberSecretQuestion" name="memberSecretQuestion" required>
                                    <option value="animal">Quel était le nom de mon premier animal de compagnie ?</option>
                                    <option value="family">Combien ai-je de frères et soeurs ?</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="memberSecretAnswer" class="form-label control-label">Réponse secrète</label>
                                <input type="text" class="form-control" name="memberSecretAnswer" id="memberSecretAnswer" required />
                            </div>
                        <?php endif; ?>
                    
                    <?php if ($actionType == 'Modifier') : ?>
                        <a class="btn btn-warning" href="ListeMembres.php" role="button">Retour à la liste</a>
                    <?php else : ?>
                        <a class="btn btn-warning" href="Accueil.php" role="button">Retour à l'accueil</a>
                    <?php endif; ?>
                    <input type="submit" class="btn btn-success" name="<?=$actionType?>Membre" value="Valider" />
                </form>
            </div>
        </div>
    <?php else : ?>
        <!-- cas d'une consultation d'information d'un membre -->

        <div class="row">
            <a class="col-2 offset-2 mt-4 btn btn-warning" href="ListeMembres.php" role="button">Retour à la liste</a>
        </div>

        <div class="text-center">

            <div class="row mb-4 justify-content-center">
                <h1 class="col-8 py-1 my-2 border border-black rounded"><?=$membre['Nom']?> <?=$membre['Prénom']?></h1>
            </div>

            <div class="row mb-4 justify-content-center">
                <div class="col-4">
                    <h3 class="border border-black rounded">Téléphone</h3>
                    <p><?=$membre['Téléphone']?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php include_once 'parts/footer.php';