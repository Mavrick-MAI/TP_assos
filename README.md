# TP_assos
## Etapes d'installation du projet
### 1. Récupérer les fichiers du repo "TP_assos" sur github.
Téléchargez le dossier "TP_assos" ainsi que le fichier "tp_assos.sql" sur votre ordinateur.

### 2. Déplacer le dossier TP_assos dans le dossier "htdocs" de XAMPP.
Il faut à présent déplacer le dossier "TP_assos" dans le dossier "htdocs" de votre XAMPP (chemin par defaut : C:\xampp\htdocs)

### 3. Importer la base de donnée
Maintenant, lancez XAMPP, lancer les modules "Apache" et "MySQL".  
Dans votre navigateur web favori, tapez dans l'url "localhost" et appuyez sur "Entrée".  
Cliquez ensuite sur "phpMyAdmin".  
Créez une base de données en cliquant sur "Nouvelle base de données" dans le menu à gauche.  
Donnez lui le nom "tp_assos" et cliquez sur "Créer" juste à droite.  
Ensuite, de nouveau dans le menu de gauche, sélectionnez la base de donnée que vous venez de créer.  
Le menu en haut de la page s'actualise, cliquez sur "Importer".  
Dans l'onglet "Fichier à importer", cliquez sur "Choisir un fichier" et sélectionnez le fichier "tp_assos.sql" téléchargé précédemment.  
Descendez en bas de la page et cliquer sur "Importer".  

Si tout c'est bien passé, vous devriez désormais avoir 3 tables dans votre base de données : "book", "emprunt" et "membre".  

### 4. Lancer l'intranet
Toujours dans votre navigateur préféré, tapez dans l'url "localhost/TP_assos/Accueil.php".
