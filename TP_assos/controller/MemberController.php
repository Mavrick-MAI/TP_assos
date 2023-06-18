<?php

    require_once __DIR__.'/../dao/MemberDao.php';

    /**
     * Modélise la couche de contrôle et de mise en forme des données des membres
     */
    class MemberController {

        /**
         * La liste des noms des champs des membres
         */
        private static $columnNames = ['Id', 'Nom', 'Prénom', 'Téléphone'];

        /**
         * Récupère la liste des membres
         */
        function getList() {

            // créer le dao des membres
            $memberDao = new MemberDao();

            // récupère la liste des membres en BDD
            $listMembre = $memberDao->getListMember();
            // les membres sont des tableaux avec index
            // itére sur la liste de membre
            for ($i = 0; $i < count($listMembre); $i++) {
                // change les tableaux en tableaux associatifs avec les noms des champs
                $listMembre[$i] = array_combine(self::$columnNames, $listMembre[$i]);
            }

            // retourne la liste
            return $listMembre;
        }

        /**
         * Retourne un membre à partir d'un identifiant
         * 
		 * @var int $pId 
         */
        function getById($pId) {

            // créer le dao des membres
            $memberDao = new MemberDao();

            // récupère le membre en BDD
            $membre = $memberDao->getById($pId);
            // change le tableau en tableau associatif avec les noms des champs
            $membre = array_combine(self::$columnNames, $membre);

            // retourne le membre
            return $membre;
        }
        
        function getByIdRecup($pId) {

            // créer le dao des membres
            $memberDao = new MemberDao();

            // récupère le membre en BDD
            $membre = $memberDao->getByIdRecup($pId);

            // retourne le membre
            return $membre;
        }

        /**
         * Retourne un membre à partir d'un email
         * 
		 * @var string $pEmail 
         */
        function getByEmail($pEmail) {

            // créer le dao des membres
            $memberDao = new MemberDao();

            // récupère le membre en BDD
            $membre = $memberDao->getByEmail($pEmail);

            // retourne le membre
            return $membre[0];
        }

        /**
         * Insère un nouveau membre
         * 
		 * @var Membre $pNewMembre
         */
        function insert($pNewMembre) {

            // créer le dao des membres
            $memberDao = new MemberDao();

            // récupère un membre à partir de l'email en BDD
            $membreBDD = $memberDao->getByEmail($pNewMembre->getEmail());

            // vérifie si le membre existe déjà en BDD
            if (count($membreBDD) == 0) {
                // cas où le membre n'existe pas en BDD
                // lance l'insertion
                $memberDao->insert($pNewMembre);
    
                // redirige vers l'accueil
                header("Location:../Accueil.php");
            } else {
                // cas où le membre existe en BDD
                // lance une popup pour l'indiquer à l'utilisateur
                // et le renvoie à la page d'inscription 
                echo '<script type="text/javascript">'; 
                echo 'alert("L\'email '.$pNewMembre->getEmail().' est déjà utilisé. ");';
                echo 'window.location.href = "../Membre.php?type=Ajouter";';
                echo '</script>';
            }
        }

        /**
         * Met à jour un membre
         * 
		 * @var Member $pUpdatedMembre
         */
        function update($pUpdatedMembre) {

            // créer le dao des membre
            $memberDao = new MemberDao();

            // récupère un membre à partir de l'identifiant en BDD
            $membreBDD = $memberDao->getById($pUpdatedMembre->getId());

            // vérifie si le membre existe déjà en BDD
            if ($membreBDD != null) {
                // cas où le membre existe en BDD
                // lance la modification
                $memberDao->updateById($pUpdatedMembre);

                // redirige vers la liste des membres
                header("Location:../ListeMembres.php");
            } else {
                // cas où le membre n'existe pas en BDD
                // lance une popup pour l'indiquer à l'utilisateur
                // et le renvoie à la page de la liste des membres
                echo '<script type="text/javascript">'; 
                echo 'alert("Le membre '.$pUpdatedMembre->getLastName().' '.$pUpdatedMembre->getFirstName().' n\'existe pas en base de données. Modification impossible.");';
                echo 'window.location.href = "../ListeMembres.php";';
                echo '</script>';
            }
        }

        /**
         * Supprime un membre
         * 
		 * @var int $pId 
         */
        function delete($pId) {

            // TODO: vérification si le membre n'est pas actuellement lié à un emprunt de livre

            // créer le dao des membres
            $memberDao = new MemberDao();

            // lance la suppression
            $memberDao->deleteById($pId);

            // redirige vers la page de la liste des membres
            header("Location:../ListeMembres.php");

        }

        /**
         * Change le mot de passe d'un membre
         * 
		 * @var int $pId 
		 * @var string $pPassword 
         */
        function changePassword($pId, $pPassword) {

            // créer le dao des membres
            $memberDao = new MemberDao();

            // lance le changement de mot de passe
            $memberDao->changePasswordById($pId, $pPassword);

            // redirige vers la page de connexion
            header("Location:../SeConnecter.php");

        }

    }

?>