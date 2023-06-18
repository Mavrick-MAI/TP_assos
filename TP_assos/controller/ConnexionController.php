<?php

    require_once __DIR__.'/../dao/MemberDao.php';

    /**
     * Modélise la couche de contrôle et de mise en forme des données des connexions
     */
    class ConnexionController {

        /**
         * Connecte un utilisateur
         */
        function connectMember($pEmail, $pPassword) {

            // créer le dao des membres
            $memberDao = new MemberDao();

            // récupère un membre à partir de l'email en BDD
            $membreBDD = $memberDao->getByEmail($pEmail);
            if (count($membreBDD) != 0) {
                if (strcmp($membreBDD[0][5], $pPassword) == 0) {
                    echo 'test';
                    session_start();
                    $_SESSION['user'] = $membreBDD[0];
                    header("Location:../Accueil.php");
                }
            } else {
                // cas où lees informations ne correspondent pas
                // lance une popup pour l'indiquer à l'utilisateur
                // et le renvoie à la page de connexion 
                echo '<script type="text/javascript">'; 
                echo 'alert("L\'email et/ou le mot de passe sont incorrects. Veuillez réessayer.");';
                echo 'window.location.href = "../SeConnecter.php";';
                echo '</script>';
            }
        }
    }

?>