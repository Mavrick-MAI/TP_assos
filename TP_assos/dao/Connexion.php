<?php

    /**
     * Modélise une connexion à la base de donnée
     */
    class Connexion {

        /**
         * Le nom du serveur
         * 
		 * @var string $serverName
		 */ 
        private static $serverName = "localhost";
        /**
         * Le nom d'utilisateur
         * 
        * @var string $userName
        */ 
        private static $userName = "root";
        /**
         * Le mot de passe
        * @var string $password
        */ 
        private static $password = "";
        /**
         * Le nom de la base de donnée
         * 
        * @var string $dbName
        */ 
        private static $dbName = "tp_assos";

        /**
         * Récupère une connexion à la base de donnée
         */
        public static function getConnexion() {
            try {
                $connexion = new PDO("mysql:host=".self::$serverName.";dbname=".self::$dbName, self::$userName, self::$password);
                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            } catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }

            return $connexion;
		}

    }

?>