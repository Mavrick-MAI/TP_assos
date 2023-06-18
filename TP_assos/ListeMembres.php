<?php include_once 'parts/header.php'; ?>
<?php include_once 'parts/menu.php'; ?>

<?php require_once 'controller/MemberController.php'; ?>

<!-- Page de la liste des membres -->

<?php 
    // créer le controller des membres
    $memberController = new MemberController();

    // récupère la liste des membres
    $listMembre = $memberController->getList();
    // récupère la liste des noms des colonnes
    $columnsNames = array_keys($listMembre[0]);
?>

<div class="container">

    <h1 class="my-4 text-center">Liste des membres</h1>

    <div class="table-responsive text-center" style="overflow:hidden;">
        <table class="display table table-bordered align-middle">
            <thead>
                <tr>
                    <?php for ($i = 1; $i < count($columnsNames); $i++) : ?>
                        <th scope="col"><?php echo $columnsNames[$i]?></th>      
                    <?php endfor; ?> 
                    <th scope="col">Actions</th>  
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php for ($i = 0; $i < count($listMembre); $i++) : ?>
                    <tr data-id="<?= $listMembre[$i][$columnsNames[0]]?>">
                        <?php for ($y = 1; $y < count($listMembre[$i]); $y++) : ?>
                            <td><?php echo $listMembre[$i][$columnsNames[$y]]?></td>      
                        <?php endfor; ?> 
                        <td>
                            <div class="row">
                                <div class="col-4">
                                    <a class="btn btn-outline-dark" href="Membre.php?type=Ouvrir&idMembre=<?= $listMembre[$i][$columnsNames[0]]?>"><i class="fa-solid fa-circle-info fa-lg"></i></a>
                                </div>
                                <div class="col-4">
                                    <a class="btn btn-outline-dark" href="Membre.php?type=Modifier&idMembre=<?= $listMembre[$i][$columnsNames[0]]?>"><i class="fa-solid fa-pencil fa-lg"></i></a>
                                </div>
                                <div class="col-4">
                                    <form  action="./controller/FormHandler.php" method="post">
                                    <input type="hidden" name="memberId" id="memberId" value="<?= $listMembre[$i][$columnsNames[0]]?>">
                                        <button type="submit" name="SupprimerMembre" class="btn btn-outline-dark"><i class="fa-solid fa-trash-can fa-lg" onclick="return confirm('Êtes-vous certain de vouloir supprimer <?= $listMembre[$i][$columnsNames[1]]?> <?= $listMembre[$i][$columnsNames[2]]?> ?')"></i></button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>      
                <?php endfor; ?> 
            </tbody>
        </table>
    </div>

</div>


<?php include_once 'parts/footer.php';