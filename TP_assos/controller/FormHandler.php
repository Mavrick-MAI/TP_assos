<?php

    require_once '../models/Book.php';
    require_once '../models/Member.php';
    require_once '../controller/BookController.php';
    require_once '../controller/MemberController.php';

    /**
     * "Controller" intermédiaire qui gère les soumissions de formulaires,
     * effectue des contrôles quand nécéssaire ou possible,
     * et appelle les controllers adéquates afin de poursuivre le traitement.     * 
     */

     /**
      * Controller des livres
      */
    $bookController = new BookController();
    /**
     * Controller des membres
     */
    $memberController = new MemberController();

    /*****************************************************/
    /**************** Gestion des livres *****************/
    /*****************************************************/

    /**
     * Soumission d'un formulaire d'ajout de livre
     */
    if (isset($_POST['AjouterLivre'])) {

        // récupère les informations du formulaire
        $newTitle = $_POST['bookTitle'];
        $author = $_POST['bookAuthor'];
        $genre = $_POST['bookGenre'];

        // vérifie si le titre est renseigné
        if (!empty($newTitle)) {
            // cas où le titre est renseigné
            // créer un livre et lance l'insertion
            $newBook = new Book($newTitle, $author, $genre);
            $bookController->insert($newBook);
        } else {
            // cas où le titre n'est pas renseigné
            // lance une popup pour l'indiquer à l'utilisateur
            // et le renvoie à la page d'ajout de livre
            echo '<script type="text/javascript">'; 
            echo 'alert("Le titre du livre doit être renseigné.");';
            echo 'window.location.href = "../Livre.php?type=Ajouter";';
            echo '</script>';
        }
    } 

    /**
     * Soumission d'un formulaire de modification de livre
     */
    if (isset($_POST['ModifierLivre'])) {

        // récupère les informations du formulaire
        $id = $_POST['bookId'];
        $newTitle = $_POST['bookTitle'];
        $author = $_POST['bookAuthor'];
        $genre = $_POST['bookGenre'];
        $available = $_POST['bookAvailable'];
        $borrower = $_POST['bookBorrower'];
        $borrowStart = $_POST['bookBorrowStart'];
        $borrowEnd = $_POST['bookBorrowEnd'];

        // vérifie si le titre est renseigné
        if (!empty($newTitle)) {
            // cas où le titre est renseigné
            // créer un livre et lance la modification
            $updatedBook = Book::fullBook($id, $newTitle, $author, $genre, $available, $borrower, $borrowStart, $borrowEnd);
            $bookController->update($updatedBook);
        } else {
            // cas où le titre n'est pas renseigné
            // lance une popup pour l'indiquer à l'utilisateur
            // et le renvoie à la page de modification du livre
            echo '<script type="text/javascript">'; 
            echo 'alert("Le titre du livre doit être renseigné.");';
            echo 'window.location.href = "../Livre.php?type=Modifier&idBook='.$id.'";';
            echo '</script>';
        }
    } 

    /**
     * Soumission d'un formulaire de suppression de livre
     */
    if (isset($_POST['SupprimerLivre'])) {

        // récupère l'identifiant du livre
        $id = $_POST['bookId'];

        // lance la suppression
        $bookController->delete($id);
    } 

    

    /*****************************************************/
    /**************** Gestion des membres ****************/
    /*****************************************************/

    /**
     * Soumission d'un formulaire d'inscription de membre
     */
    if (isset($_POST['AjouterMembre'])) {

        // récupère les informations du formulaire
        $lastname = $_POST['memberLastName'];
        $firstName = $_POST['memberFirstName'];
        $phone = $_POST['memberPhone'];
        $email = $_POST['memberEmail'];
        $password = $_POST['memberPassword'];
        $confirmPassword = $_POST['memberConfirmPassword'];
        $secretQuestion = $_POST['memberSecretQuestion'];
        $secretAnswer = $_POST['memberSecretAnswer'];

        $newMember = new Member($lastname, $firstName, $phone, $email, $password, $secretQuestion, $secretAnswer);

        $errorMessage = checkMemberFields($newMember, 'Ajouter', $confirmPassword);

        // vérifie si les champs sont correctement renseignés
        if (!$errorMessage) {
            // cas où tout est bon
            // lance l'insertion
            $memberController->insert($newMember);
        } else {
            // cas où un problème est survenu
            // lance une popup pour l'indiquer à l'utilisateur
            // et le renvoie à la page d'inscription
            echo '<script type="text/javascript">'; 
            echo 'alert("'.$errorMessage.'");';
            echo 'window.location.href = "../Membre.php?type=Ajouter";';
            echo '</script>';
        }
    } 

    /**
     * Soumission d'un formulaire de modification de membre
     */
    if (isset($_POST['ModifierMembre'])) {

        // récupère les informations du formulaire
        $id = $_POST['memberId'];
        $lastname = $_POST['memberLastName'];
        $firstName = $_POST['memberFirstName'];
        $phone = $_POST['memberPhone'];

        $updateMember = Member::memberUpdated($id, $lastname, $firstName, $phone);

        $errorMessage = checkMemberFields($updateMember, 'Modifier', null);

        // vérifie si les champs sont correctement renseignés
        if (!$errorMessage) {
            // cas où tout est bon
            // lance la modification
            $memberController->update($updateMember);
        } else {
            // cas où un problème est survenu
            // lance une popup pour l'indiquer à l'utilisateur
            // et le renvoie à la page de modification du membre
            echo '<script type="text/javascript">'; 
            echo 'alert("'.$errorMessage.'");';
            echo 'window.location.href = "../Membre.php?type=Modifier&idMembre='.$id.'";';
            echo '</script>';
        }
    } 

    /**
     * Soumission d'un formulaire de suppression de membre
     */
    if (isset($_POST['SupprimerMembre'])) {

        // récupère l'identifiant du membre
        $id = $_POST['memberId'];

        // lance la suppression
        $memberController->delete($id);
    } 

    /**
     * Vérifie les informations des formulaires des membres
     * 
	 * @var Member $pMember
	 * @var string $typeAction
	 * @var string $confirmPassword
     */
    function checkMemberFields($pMember, $typeAction, $confirmPassword) {
        $errorMessage = "";

        if (!$pMember->getLastName()) {
            $errorMessage .= "- La nom de famille doit être renseigné.\\n";
        }
        if (!$pMember->getFirstName()) {
            $errorMessage .= "- La prénom doit être renseigné.\\n";
        }
        if (!$pMember->getPhone()) {
            $errorMessage .= "- Le numéro de téléphone doit être renseigné.\\n";
        } else {
            if (strlen($pMember->getPhone()) != 6 && !is_numeric($pMember->getPhone())) {
                $errorMessage .= "- Le numéro de téléphone doit contenir 6 chiffres. Aucunes lettres ou caractères spéciaux ne sont autorisés.\\n";
            }
        }

        if ($typeAction === "Ajouter") {
            if (!$pMember->getEmail()) {
                $errorMessage .= "- L'email doit être renseigné.\\n";
            }
            if (!$pMember->getPassword()) {
                $errorMessage .= "- Le mot de passe doit être renseigné.\\n";
            } else {
                if (strcmp($pMember->getPassword(), $confirmPassword) !== 0) {
                    $errorMessage .= "- Les mots de passe renseignés ne correspondent pas.\\n";
                }
            }
            if (!$pMember->getSecretQuestion()) {
                $errorMessage .= "- Veuillez sélectionner une question secréte.\\n";
            }
            if (!$pMember->getSecretAnswer()) {
                $errorMessage .= "- Une réponse à la question secréte doit être renseignée.\\n";
            }
        }
        
        return $errorMessage;
    } 
?>