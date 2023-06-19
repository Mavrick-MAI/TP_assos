# TP_assos
## Etapes d'installation du projet
### 1. Récupérer les fichiers du repo "TP_assos" sur github.
Télécharger le dossier "TP_assos" ainsi que le fichier "tp_assos.sql" sur votre ordinateur.

### 2. Déplacer le dossier TP_assos dans le dossier "htdocs" de XAMPP.
Il faut à présent déplacer le dossier "TP_assos" dans le dossier "htdocs" de votre XAMPP (chemin par defaut : C:\xampp\htdocs)

### 3. Importer la base de donnée
Maintenant, lancer XAMPP, lance les modules "Apache" et "MySQL".  
Dans votre navigateur web favori, taper dans l'url "localhost" et appuyer sur "Entrée".
Cliquer ensuite sur "phpMyAdmin".
Créer une base de données en cliquant sur "Nouvelle base de données" dans le menu à gauche.
Donner lui le nom "tp_assos" et cliquer sur "Créer" juste à droite.
Ensuite, de nouveau dans le menu de gauche, sélectionner la base de donnée que vous venez de créer.
Le menu en haut de la page s'actualise, cliquer sur "Importer".
Dans l'onglet "Fichier à importer", cliquer sur "Choisir un fichier" et sélectionner le fichier "tp_assos.sql" télécharger précédemment.
Descender en bas de la page et cliquer sur "Importer".

Si tout c'est bien passé, vous devriez désormais avoir 3 tables dans votre base de données : "book", "emprunt" et "membre".

### 4. Lancer l'intranet
Toujours dans votre navigateur préféré, taper dans l'url "localhost/TP_assos/Accueil.php".
