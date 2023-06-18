<?php

    require_once __DIR__.'/../models/Member.php';
    require_once 'Connexion.php';

    /**
     * Modélise la couche d'accès au données des membres en base de donnée
     * DAO = Data Access Object
     */
    class MemberDao {
        
        /**
         * La connexion à la base de donnée
         */
        private $dbConnexion;

        /**
         * Récupère un membre à partir d'un identifiant
         * 
		 * @var int $pId 
         */
		function getById($pId) {
            
            //créer la connexion à la BDD
            $dbConnexion = Connexion::getConnexion();

            try {
                // créer la requête sql
                $request = "SELECT id, nom, prenom, telephone FROM membre where id=?";

                // prépare et exécute la requête 
                $stmt = $dbConnexion->prepare($request);
                $stmt->execute([$pId]);

                // récupère le membre
                $result = $stmt->setFetchMode(PDO::FETCH_NUM);
                $member = $stmt->fetchAll();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            // ferme la connexion à la BDD
            $dbConnexion = null;

            // retourne le membre
            return $member[0];
        }

        /**
         * Récupère un membre à partir d'un email
         * 
		 * @var string $pEmail
         */
		function getByEmail($pEmail) {
            
            //créer la connexion à la BDD
            $dbConnexion = Connexion::getConnexion();

            try {
                // créer la requête sql
                $request = "SELECT * FROM membre where email=?";

                // prépare et exécute la requête
                $stmt = $dbConnexion->prepare($request);
                $stmt->execute([$pEmail]);

                // récupère le membre
                $result = $stmt->setFetchMode(PDO::FETCH_NUM);
                $member = $stmt->fetchAll();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            
            // ferme la connexion à la BDD
            $dbConnexion = null;

            // retourne le membre
            return $member;
        }

        /**
         * Récupère la liste complète des membres
         */
		function getListMember() {
            
            //créer la connexion à la BDD
            $dbConnexion = Connexion::getConnexion();

            try {
                // créer la requête sql
                $request = "SELECT id, nom, prenom, telephone FROM membre";

                // prépare et exécute la requête 
                $stmt = $dbConnexion->prepare($request);
                $stmt->execute();

                // récupère la liste des membres
                $listMembre = $stmt->setFetchMode(PDO::FETCH_NUM);
                $listMembre = $stmt->fetchAll();
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            // ferme la connexion à la BDD
            $dbConnexion = null;

            // retourne la liste de membres
            return $listMembre;
        }

        /**
         * Insére un nouveau membre en base de donnée
         * 
		 * @var Member $pNewMember 
         */
		function insert($pNewMember) {
            
            //créer la connexion à la BDD
            $dbConnexion = Connexion::getConnexion();

            try {
                // créer la requête sql
                $request = "INSERT INTO membre (nom, prenom, telephone, email, password, question_secrete, reponse_secrete) VALUES (?,?,?,?,?,?,?)";

                // prépare et exécute la requête
                $stmt = $dbConnexion->prepare($request);
                $stmt->execute([$pNewMember->getLastName(), $pNewMember->getFirstName(), $pNewMember->getPhone(), $pNewMember->getEmail(), $pNewMember->getPassword(), $pNewMember->getSecretQuestion(), $pNewMember->getSecretAnswer()]);
                 
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            // ferme la connexion à la BDD
            $dbConnexion = null;

        }

        /**
         * Met à jour un membre à partir d'un identifiant
         * 
		 * @var Member $pUpdatedMember 
         */
		function updateById($pUpdatedMember) {
            
            //créer la connexion à la BDD
            $dbConnexion = Connexion::getConnexion();

            try {
                // créer la requête sql
                $request = "UPDATE membre SET nom=?, prenom=?, telephone=? WHERE id=?";

                // prépare et exécute la requête
                $stmt = $dbConnexion->prepare($request);
                $stmt->execute([$pUpdatedMember->getLastName(), $pUpdatedMember->getFirstName(), $pUpdatedMember->getPhone(), $pUpdatedMember->getId()]);
                 
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            
            // ferme la connexion à la BDD
            $dbConnexion = null;

        }

        /**
         * Supprime un membre à partir d'un identifiant
         * 
		 * @var int $pId
         */
		function deleteById($pId) {
            
            //créer la connexion à la BDD
            $dbConnexion = Connexion::getConnexion();

            try {
                // créer la requête sql
                $request = "DELETE FROM membre WHERE id=?";

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