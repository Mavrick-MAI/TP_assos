<?php include_once 'parts/header.php'; ?>
<?php include_once 'parts/menu.php'; ?>

<?php require_once 'controller/MemberController.php'; ?>

<?php

    // récupère l'URL de la page actuelle
    $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    // récupère les différentes parties de l'URL
    $url_components = parse_url($actual_link);
    // récupère les paramètres
    if (isset($url_components['query'])) {
        parse_str($url_components['query'], $params);
    }

    // vérifie si un identifiant de membre est en paramètre
    if (isset($params['id'])) {
        // récupère l'identifiant
        $idMembre = $params['id'];
        // créer le controller des membres
        $membreController = new MemberController();
        // récupère le livre à partir de l'identifiant
        $membre = $membreController->getByIdRecup($idMembre);
        var_dump($membre);
    }

    if (isset($params['reset'])) {
        $reset = $params['reset'];
    }

?>


<div class="container">

    <div class="text-center">

        <?php if (!isset($params['reset'])) : ?>
            <h1 class="my-4">Mot de passe oublié</h1>
        <?php else : ?>
            <h1 class="my-4">Réinitialisation du mot de passe</h1>
        <?php endif; ?>

        <div class="row justify-content-center text-start">
            <form class="col-sm-12 col-lg-6" action="./controller/FormHandler.php" method="post">
                <?php if (!isset($params['id'])) : ?>
                    <div class="mb-3">
                        <label for="memberEmail" class="form-label control-label">Veuiller renseigner l'adresse email de votre compte</label>
                        <input type="email" class="form-control" id="memberEmail" required name="memberEmail" />
                    </div>
                    <a class="btn btn-warning" href="SeConnecter.php">Annuler</a>
                    <input type="submit" class="btn btn-primary" name="recupStepEmail" value="Continuer" />
                <?php elseif (!isset($params['reset'])) : ?>
                    <div class="mb-3">
                        <h3>Veuillez répondre à votre question secrète :</h3>
                        <label for="memberSecretAnswer" class="form-label control-label"><?=$membre[0]?></label>
                        <input type="text" class="form-control" name="memberSecretAnswer" id="memberSecretAnswer" required />
                        <input type="hidden" name="id" value="<?=$idMembre?>">
                    </div>
                    <a class="btn btn-warning" href="SeConnecter.php">Annuler</a>
                    <input type="submit" class="btn btn-primary" name="recupStepSecret" value="Continuer" />
                <?php else : ?>
                    <div class="mb-3">
                        <label for="memberNewPassword" class="form-label control-label">Nouveau mot de passe</label>
                        <input type="password" class="form-control" name="memberNewPassword" id="memberNewPassword" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&+=]).{12,}$" required />
                        <div class="form-text">Le mot de passe doit contenir au moins 12 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.</div>
                    </div>
                    <div class="mb-3">
                        <label for="memberConfirmNewPassword" class="form-label control-label">Confirmer nouveau mot de passe</label>
                        <input type="password" class="form-control" name="memberConfirmNewPassword" id="memberConfirmNewPassword" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&+=]).{12,}$" required />
                    </div>
                    <input type="hidden" name="id" value="<?=$idMembre?>">
                    <a class="btn btn-warning" href="SeConnecter.php">Annuler</a>
                    <input type="submit" class="btn btn-primary" name="recupStepPassword" value="Continuer" />
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
<?php include_once 'parts/footer.php';