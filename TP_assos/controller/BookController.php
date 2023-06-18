<?php

    require_once __DIR__.'/../dao/BookDao.php';

    /**
     * Modélise la couche de contrôle et de mise en forme des données des livres
     */
    class BookController {

        /**
         * La liste des noms des champs des livres
         */
        private static $columnNames = ['Id', 'Titre', 'Auteur', 'Genre', 'Disponible/Réserver'];

        /**
         * Récupère la liste des livres
         */
        function getList() {

            // créer le dao des livres
            $bookDao = new BookDao();

            // récupère la liste des livres en BDD
            $listBook = $bookDao->getListBook();

            // les livres sont des tableaux avec index
            // itére sur la liste de livre
            for ($i = 0; $i < count($listBook); $i++) {
                // change les tableaux en tableaux associatifs avec les noms des champs
                $listBook[$i] = array_combine(self::$columnNames, $listBook[$i]);
                // change la valeur du champ 'Disponible/Réserver' (0 / 1) par le string correspondant (Réserver / Disponible)
                $listBook[$i]['Disponible/Réserver'] ? $listBook[$i]['Disponible/Réserver'] = "Disponible" : $listBook[$i]['Disponible/Réserver']="Réserver";
            }

            // retourne la liste
            return $listBook;
        }

        /**
         * Récupère la liste des derniers livres
         */
        function getListLast() {

            // créer le dao des livres
            $bookDao = new BookDao();

            // récupère la liste des livres en BDD
            $listBook = $bookDao->getListLastBook();

            // les livres sont des tableaux avec index
            // itére sur la liste de livre
            for ($i = 0; $i < count($listBook); $i++) {
                // change les tableaux en tableaux associatifs avec les noms des champs
                $listBook[$i] = array_combine(self::$columnNames, $listBook[$i]);
                // change la valeur du champ 'Disponible/Réserver' (0 / 1) par le string correspondant (Réserver / Disponible)
                $listBook[$i]['Disponible/Réserver'] ? $listBook[$i]['Disponible/Réserver'] = "Disponible" : $listBook[$i]['Disponible/Réserver']="Réserver";
            }

            // retourne la liste
            return $listBook;
        }

        /**
         * Retourne un livre à partir d'un identifiant
         * 
		 * @var int $pId 
         */
        function getById($pId) {

            // créer le dao des livres
            $bookDao = new BookDao();

            // récupère le livre en BDD
            $book = $bookDao->getById($pId);
            // change le tableau en tableau associatif avec les noms des champs
            $book = array_combine(self::$columnNames, $book);

            // retourne le livre
            return $book;
        }

        /**
         * Charge un livre à partir d'un identifiant
         * 
		 * @var int $pId 
         */
        function loadById($pId) {

            $customColumnNames = ['Id', 'Titre', 'Auteur', 'Genre', 'Disponible/Réserver', 'Date Emprunt', 'Date Retour'];
            // créer le dao des livres
            $bookDao = new BookDao();

            // récupère le livre en BDD
            $book = $bookDao->loadBookByID($pId);
            // change le tableau en tableau associatif avec les noms des champs
            $book = array_combine($customColumnNames, $book);

            // retourne le livre
            return $book;
        }

        /**
         * Modifie la couleur du texte 'Disponible/Réserver'
         * 
		 * @var string $pColumnName 
		 * @var string $pAvailable 
		 * @var boolean $pClass 
         */
        function setAvailableColor($pColumnName, $pAvailable, $pClass) {

            // vérifie le nom de la colonne
            if ($pColumnName == 'Disponible/Réserver') {

                if (!$pClass) {
                    // vérifie la valeur
                    switch ($pAvailable) {
    
                        // modifie la couleur
                        case 'Disponible':
                            return "class='text-success'";
                        case 'Réserver':
                            return "class='text-danger'";
                    }  
                } else {
                    // vérifie la valeur
                    switch ($pAvailable) {
    
                        // modifie la couleur
                        case 'Disponible':
                            return 'text-success';
                        case 'Réserver':
                            return 'text-danger';
                    }
                }
            }
            
        }

        /**
         * Insère un nouveau livre
         * 
		 * @var Book $pNewBook 
         */
        function insert($pNewBook) {

            // créer le dao des livres
            $bookDao = new BookDao();

            // récupère un livre à partir du titre en BDD
            $bookBDD = $bookDao->getByTitle($pNewBook->getTitle());

            // vérifie si le livre existe déjà en BDD
            if (count($bookBDD) == 0) {
                // cas où le livre n'existe pas en BDD
                // lance l'insertion
                $bookDao->insert($pNewBook);
    
                // redirige vers la liste des livres
                header("Location:../ListeLivres.php");
            } else {
                // cas où le livre existe en BDD
                // lance une popup pour l'indiquer à l'utilisateur
                // et le renvoie à la page d'ajout de livre 
                echo '<script type="text/javascript">'; 
                echo 'alert("Le livre '.$pNewBook->getTitle().' est déjà présent en base de données. Ajout impossible.");';
                echo 'window.location.href = "../Livre.php?type=Ajouter";';
                echo '</script>';
            }
        }

        /**
         * Met à jour un livre
         * 
		 * @var Book $pUpdatedBook 
         */
        function update($pUpdatedBook) {

            // créer le dao des livres
            $bookDao = new BookDao();

            // récupère un livre à partir de l'identifiant en BDD
            $bookBDD = $bookDao->getById($pUpdatedBook->getId());

            // vérifie si le livre existe déjà en BDD
            if ($bookBDD != null) {
                // cas où le livre existe en BDD
                // lance la modification
                $bookDao->updateById($pUpdatedBook);

                // redirige vers la liste des livres
                header("Location:../ListeLivres.php");
            } else {
                // cas où le livre n'existe pas en BDD
                // lance une popup pour l'indiquer à l'utilisateur
                // et le renvoie à la page de la liste des livres
                echo '<script type="text/javascript">'; 
                echo 'alert("Le livre '.$pUpdatedBook->getTitle().' n\'existe pas en base de données. Modification impossible.");';
                echo 'window.location.href = "../ListeLivres.php";';
                echo '</script>';
            }
        }

        /**
         * Met à jour un livre
         * 
		 * @var int $pIdUser
		 * @var Book $pUpdatedBook 
         */
        function updateBorrow($pIdUser, $pUpdatedBook) {

            // créer le dao des livres
            $bookDao = new BookDao();

            // récupère un livre à partir de l'identifiant en BDD
            $bookBDD = $bookDao->getById($pUpdatedBook->getId());

            // vérifie si le livre existe déjà en BDD
            if ($bookBDD != null) {
                // cas où le livre existe en BDD
                // lance la modification
                if (!$pUpdatedBook->isAvailable()) {
                    $bookDao->insertBorrowByIdBook($pIdUser, $pUpdatedBook);
                } else {
                    $bookDao->deleteBorrowByIdBook($pIdUser, $pUpdatedBook->getId());
                }
            } else {
                // cas où le livre n'existe pas en BDD
                // lance une popup pour l'indiquer à l'utilisateur
                // et le renvoie à la page de la liste des livres
                echo '<script type="text/javascript">'; 
                echo 'alert("Le livre '.$pUpdatedBook->getTitle().' n\'existe pas en base de données. Modification impossible.");';
                echo 'window.location.href = "../ListeLivres.php";';
                echo '</script>';
            }
        }

        /**
         * Supprime un livre
         * 
		 * @var int $pId 
         */
        function delete($pId) {

            // TODO: vérification si le livre n'est pas actuellement emprunté

            // créer le dao des livres
            $bookDao = new BookDao();

            // lance la suppression
            $bookDao->deleteById($pId);

            // redirige vers la page de la liste des livres
            header("Location:../ListeLivres.php");

        }

    }

?>