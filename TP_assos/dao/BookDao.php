<?php

    require_once __DIR__.'/../models/Book.php';
    require_once 'Connexion.php';

    /**
     * Modélise la couche d'accès au données des livres en base de donnée
     * DAO = Data Access Object
     */
    class BookDao {
        
        /**
         * La connexion à la base de donnée
         */
        private $dbConnexion;

        /**
         * Récupère un livre à partir d'un identifiant
         * 
		 * @var int $pId 
         */
		function getById($pId) {
            
            //créer la connexion à la BDD
            $dbConnexion = Connexion::getConnexion();

            try {
                // créer la requête sql
                $request = "SELECT * FROM book where id=?";

                // prépare et exécute la requête 
                $stmt = $dbConnexion->prepare($request);
                $stmt->execute([$pId]);

                // récupère le livre
                $result = $stmt->setFetchMode(PDO::FETCH_NUM);
                $book = $stmt->fetchAll();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            // ferme la connexion à la BDD
            $dbConnexion = null;

            // retourne le livre
            return $book[0];
        }

        /**
         * Charge un livre à partir d'un identifiant
         * 
		 * @var int $pId 
         */
		function loadBookByID($pId) {
            
            //créer la connexion à la BDD
            $dbConnexion = Connexion::getConnexion();

            try {
                // créer la requête sql
                $request = "SELECT id, title, author, genre, available, date_emprunt, date_retour_prevu FROM book INNER JOIN emprunt ON book.id = emprunt.id_livre where id=?";

                // prépare et exécute la requête 
                $stmt = $dbConnexion->prepare($request);
                $stmt->execute([$pId]);

                // récupère le livre
                $result = $stmt->setFetchMode(PDO::FETCH_NUM);
                $book = $stmt->fetchAll();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            // ferme la connexion à la BDD
            $dbConnexion = null;

            // retourne le livre
            return $book[0];
        }

        /**
         * Récupère un livre à partir d'un titre
         * 
		 * @var string $pTitle 
         */
		function getByTitle($pTitle) {
            
            //créer la connexion à la BDD
            $dbConnexion = Connexion::getConnexion();

            try {
                // créer la requête sql
                $request = "SELECT * FROM book where title=?";

                // prépare et exécute la requête
                $stmt = $dbConnexion->prepare($request);
                $stmt->execute([$pTitle]);

                // récupère le livre
                $result = $stmt->setFetchMode(PDO::FETCH_NUM);
                $book = $stmt->fetchAll();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            
            // ferme la connexion à la BDD
            $dbConnexion = null;

            // retourne le livre
            return $book;
        }

        /**
         * Récupère la liste complète des livres
         */
		function getListBook($search) {
            
            //créer la connexion à la BDD
            $dbConnexion = Connexion::getConnexion();

            try {
                // créer la requête sql
                $request = "SELECT * FROM book WHERE title LIKE '%$search%'";

                // prépare et exécute la requête 
                $stmt = $dbConnexion->prepare($request);
                $stmt->execute();

                // récupère la liste des livres
                $listBook = $stmt->setFetchMode(PDO::FETCH_NUM);
                $listBook = $stmt->fetchAll();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            // ferme la connexion à la BDD
            $dbConnexion = null;

            // retourne la liste de livres
            return $listBook;
        }
        
        /**
         * Récupère la liste des six derniers livres
         */
		function getListLastBook() {
            
            //créer la connexion à la BDD
            $dbConnexion = Connexion::getConnexion();

            try {
                // créer la requête sql
                $request = "SELECT * FROM book ORDER BY id DESC LIMIT 6";

                // prépare et exécute la requête 
                $stmt = $dbConnexion->prepare($request);
                $stmt->execute();

                // récupère la liste des livres
                $listBook = $stmt->setFetchMode(PDO::FETCH_NUM);
                $listBook = $stmt->fetchAll();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            // ferme la connexion à la BDD
            $dbConnexion = null;

            // retourne la liste de livres
            return $listBook;
        }

        /**
         * Insére un nouveau livre en base de donnée
         * 
		 * @var Book $pNewBook 
         */
		function insert($pNewBook) {
            
            //créer la connexion à la BDD
            $dbConnexion = Connexion::getConnexion();

            try {
                // créer la requête sql
                $request = "INSERT INTO book (title, author, genre) VALUES (?,?,?)";

                // prépare et exécute la requête
                $stmt = $dbConnexion->prepare($request);
                $stmt->execute([$pNewBook->getTitle(), $pNewBook->getAuthor(), $pNewBook->getGenre()]);
                 
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            // ferme la connexion à la BDD
            $dbConnexion = null;

        }

        /**
         * Met à jour un livre à partir d'un identifiant
         * 
		 * @var Book $pUpdatedBook 
         */
		function updateById($pUpdatedBook) {
            
            //créer la connexion à la BDD
            $dbConnexion = Connexion::getConnexion();
    
            try {
                // créer la requête sql
                $request = "UPDATE book SET title=?, author=?, genre=?, available=? WHERE id=?";

                // prépare et exécute la requête
                $stmt = $dbConnexion->prepare($request);
                $stmt->execute([$pUpdatedBook->getTitle(), $pUpdatedBook->getAuthor(), $pUpdatedBook->getGenre(), $pUpdatedBook->isAvailable(), $pUpdatedBook->getId()]);
                 
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            
            // ferme la connexion à la BDD
            $dbConnexion = null;

        }

        /**
         * Met à jour un emprunt à partir d'un identifiant utilisateur et d'un livre
         * 
		 * @var int $pIdUser 
		 * @var Book $pUpdatedBook 
         */
		function insertBorrowByIdBook($pIdUser, $pUpdatedBook) {
            
            //créer la connexion à la BDD
            $dbConnexion = Connexion::getConnexion();
    
            try {
                // créer la requête sql
                $request = "INSERT INTO emprunt (id_membre, id_livre, date_emprunt, date_retour_prevu) VALUES (?,?,?,?)";

                // prépare et exécute la requête
                $stmt = $dbConnexion->prepare($request);
                $stmt->execute([$pIdUser, $pUpdatedBook->getId(), $pUpdatedBook->getDateEmprunt(), $pUpdatedBook->getDateRetour()]);
                 
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            
            // ferme la connexion à la BDD
            $dbConnexion = null;

        }

        /**
         * Supprime un emprunt à partir d'un identifiant utilisateur et un identifiant de livre
         * 
		 * @var int $pIdUser
		 * @var int $pIdBook
         */
		function deleteBorrowByIdBook($pIdUser, $pIdBook) {
            
            //créer la connexion à la BDD
            $dbConnexion = Connexion::getConnexion();

            try {
                // créer la requête sql
                $request = "DELETE FROM emprunt WHERE id_membre=? and id_livre=?";

                // prépare et exécute la requête
                $stmt = $dbConnexion->prepare($request);
                $stmt->execute([$pIdUser, $pIdBook]);
                 
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            
            // ferme la connexion à la BDD
            $dbConnexion = null;
            
        }

        /**
         * Supprime un livre à partir d'un identifiant
         * 
		 * @var int $pId
         */
		function deleteById($pId) {
            
            //créer la connexion à la BDD
            $dbConnexion = Connexion::getConnexion();

            try {
                // créer la requête sql
                $request = "DELETE FROM book WHERE id=?";

                // prépare et exécute la requête
                $stmt = $dbConnexion->prepare($request);
                $stmt->execute([$pId]);
                 
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            
            // ferme la connexion à la BDD
            $dbConnexion = null;
            
        }

    }

?>