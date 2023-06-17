<?php

    require_once '../models/Book.php';
    require_once '../controller/BookController.php';

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

?>