# Déploiement d'un projet Laravel sur Ubuntu

## Prérequis

1. Un serveur Ubuntu.
2. Accès SSH à votre serveur.

## Étapes

### Installation de PHP

1. Mettez à jour le cache du package avec `sudo apt update`.
2. Installez PHP avec `sudo apt install php`.
3. Vérifiez l'installation avec `php -v`.

### Installation de Composer

1. Téléchargez le programme d'installation de Composer avec `curl -sS https://getcomposer.org/installer -o composer-setup.php`.
2. Installez Composer avec `sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer`.
3. Vérifiez l'installation avec `composer`.

### Installation de Laravel

1. Installez Laravel via Composer avec `composer global require laravel/installer`.
2. Vérifiez l'installation avec `laravel`.

### Configuration de Nginx

1. Installez Nginx avec `sudo apt install nginx`.
2. Ouvrez le fichier de configuration de Nginx avec `sudo nano /etc/nginx/sites-available/default`.
3. Ajoutez la configuration suivante :

```nginx
server {
    listen 80;
    server_name your_domain.com;
    root /var/www/html/your_project/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-XSS-Protection "1; mode=block";
    add_header X-Content-Type-Options "nosniff";

    index index.html index.htm index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

4. Redémarrez Nginx avec `sudo systemctl restart nginx`.

### Configuration de MySQL

1. Installez MySQL avec `sudo apt install mysql-server`.
2. Connectez-vous à MySQL avec `sudo mysql`.
3. Créez une base de données avec `CREATE DATABASE your_database;`.
4. Créez un utilisateur avec `CREATE USER 'your_user'@'localhost' IDENTIFIED BY 'your_password';`.
5. Donnez à l'utilisateur les privilèges avec `GRANT ALL PRIVILEGES ON your_database.* TO 'your_user'@'localhost';`.
6. Appliquez les changements avec `FLUSH PRIVILEGES;`.
7. Quittez MySQL avec `exit`.

### Déploiement de votre projet Laravel

1. Transférez votre projet Laravel sur votre serveur.
2. Configurez le fichier `.env` avec les informations de votre base de données et de votre serveur de mail. (Egalement mettre le lien de l'application dans APP_URL)
3. Installez les dépendances avec `composer install`.
4. Générez une clé avec `php artisan key:generate`.
5. Appliquez les migrations avec `php artisan migrate`.
6. Créez un lien symbolique avec `sudo ln -s /var/www/html/your_project/public /var/www/html`.
7. Redémarrez Nginx avec `sudo systemctl restart nginx`.

### Configuration de Contrabs pour les tâches planifiées

1. Ouvrez le fichier de contrôle avec `crontab -e`.
2. Ajoutez la tâche suivante pour exécuter les tâches planifiées de Laravel :

```
* * * * * cd /var/www/html/your_project && php artisan schedule:run >> /dev/null 2>&1
* * * * * cd /var/www/html/your_project && php artisan queue:work >> /dev/null 2>&1
```
