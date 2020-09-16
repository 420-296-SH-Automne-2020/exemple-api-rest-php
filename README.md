# Exemple d'API REST en PHP

Le fichier `students.php` contient du code montrant comment implanter une API REST en PHP.

Pour pouvoir accéder à l'URL "/students" au lieu de "/students.php", il faut déployer un fichier ".htaccess" avec le contenu suivant:

```.htaccess
RewriteRule ^(.*)$ /students.php
```
