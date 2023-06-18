<?php include_once 'parts/header.php'; ?>
<?php include_once 'parts/menu.php'; ?>

<div class="container">

    <div class="text-center">

        <h1 class="my-4">Se connecter</h1>

        <div class="row justify-content-center text-start">
            <form class="col-sm-12 col-lg-6" action="./controller/FormHandler.php" method="post">
                <div class="mb-3">
                    <label for="memberEmail" class="form-label control-label">Email</label>
                    <input type="email" class="form-control" id="memberEmail" required name="memberEmail" />
                </div>
                <div class="mb-3">
                    <label for="memberPassword" class="form-label control-label">Mot de passe</label>
                    <input type="password" class="form-control" name="memberPassword" id="memberPassword" required />
                </div>
                <div class="mb-3">
                    <input type="checkbox" name="seSouvenir" id="seSouvenir" />
                    <label for="seSouvenir" class="form-label control-label">Se souvenir de moi</label>
                </div>
                <input type="submit" class="btn btn-primary" name="seConnecter" value="Connexion" />
            </form>
        </div>
        <p>Pas encore de compte ? <a href="Membre.php?type=Ajouter">S'inscrire</a></p>
        <a href="MotDePasseOublie.php">Mot de passe oublié ?</a>
    </div>
</div>
<?php include_once 'parts/footer.php';