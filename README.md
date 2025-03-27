Voici un exemple complet de fichier **README.md** détaillant toutes les étapes et commandes à exécuter pour déployer ton application Laravel sur un autre PC :

---

# Déploiement de l'application Laravel Hot-Takes

Ce document décrit les étapes à suivre pour déployer l'application **Hot-Takes** sur un nouvel ordinateur. L'application est une API RESTful développée avec Laravel, qui utilise Laravel Sanctum pour l'authentification et se connecte à une base de données MySQL.

## Prérequis

Avant de commencer, assure-toi que ton nouvel environnement possède :

- PHP (version 8.0 ou supérieure recommandée)
- Composer
- MySQL (ou MariaDB)
- Un serveur web (Apache, Nginx, ou via `php artisan serve` pour le développement)
- Node.js et npm (si tu utilises des assets frontaux ou si tu veux compiler des assets)

## Étapes de déploiement

### 1. Cloner le dépôt

Clone le dépôt Git de ton application dans le répertoire de ton choix :

```bash
git clone https://github.com/ton-utilisateur/Hot-Takes.git
cd Hot-Takes
```

### 2. Installer les dépendances PHP

Installe les dépendances via Composer :

```bash
composer install
```

### 3. Configurer l’environnement

- Copie le fichier `.env.example` en `.env` :

  ```bash
  cp .env.example .env
  ```

- Ouvre le fichier `.env` et modifie les variables suivantes en fonction de ton environnement :

  - **APP_URL** : Par exemple `http://localhost`
  - **DB_CONNECTION** : mysql
  - **DB_HOST** : (par ex. `127.0.0.1` ou l’adresse de ton serveur MySQL)
  - **DB_PORT** : généralement `3306`
  - **DB_DATABASE** : par exemple `sauces_db`
  - **DB_USERNAME** et **DB_PASSWORD** : selon tes identifiants MySQL

- Si tu utilises Laravel Sanctum, assure-toi que la configuration par défaut de Sanctum convient à ton environnement (voir `config/sanctum.php`).

### 4. Générer la clé d’application

Exécute la commande suivante pour générer la clé de l’application :

```bash
php artisan key:generate
```

### 5. Exécuter les migrations et seeders

Si tu veux repartir d’une base fraîche, exécute :

```bash
php artisan migrate:fresh --seed
```

Cette commande va :

- Supprimer toutes les tables existantes,
- Exécuter toutes les migrations (création des tables `users`, `sauces`, etc.),
- Exécuter les seeders pour peupler la base (UtilisateurSeeder, SauceSeeder et UtilisateursReactionsSeeder).

### 6. (Optionnel) Compiler les assets

Si ton application inclut des assets frontaux (CSS/JS), installe les dépendances Node.js et compile-les :

```bash
npm install
npm run dev
```

Pour un mode watch (compilation automatique lors des modifications), tu peux utiliser :

```bash
npm run watch
```

### 7. Configurer le serveur web

Vous avez deux possibilités :

- **Utiliser le serveur de développement intégré** de Laravel :

  ```bash
  php artisan serve
  ```

  L’application sera accessible par défaut à l’adresse [http://localhost:8000](http://localhost:8000).

- **Configurer un serveur web local** (WAMP, XAMPP, etc.) en pointant le document root vers le dossier `public` de ton projet.

### 8. Tester l'API

L’application est maintenant déployée et fonctionne en tant qu'API REST. Pour tester :

- **Endpoints d'authentification** :
  - **Inscription** : `POST /api/auth/register`
  - **Login** : `POST /api/auth/login`
- **Endpoints des sauces** (protégés par Sanctum – nécessitent d'inclure le header `Authorization: Bearer <token>`) :
  - **Liste** : `GET /api/sauces`
  - **Détail** : `GET /api/sauces/{id}`
  - **Création** : `POST /api/sauces`
  - **Mise à jour** : `PUT /api/sauces/{id}`
  - **Suppression** : `DELETE /api/sauces/{id}`
  - **Like/Dislike** : `POST /api/sauces/{id}/like`

Utilise un outil comme **Postman** ou **Insomnia** pour vérifier le bon fonctionnement de chaque endpoint.

### 9. (Optionnel) Configuration de production

Pour un déploiement en production, n'oublie pas de :

- Configurer un environnement sécurisé (HTTPS, configuration de l’hôte virtuel, etc.).
- Régler le niveau de log dans le fichier `.env` (`APP_ENV=production`, `APP_DEBUG=false`).
- Exécuter les commandes de cache pour optimiser la performance :

  ```bash
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```

---

## Résumé des commandes à exécuter

1. Cloner le dépôt et se positionner dans le dossier du projet :
   ```bash
   git clone https://github.com/ton-utilisateur/Hot-Takes.git
   cd Hot-Takes
   ```
2. Installer les dépendances PHP :
   ```bash
   composer install
   ```
3. Copier le fichier `.env.example` et le configurer :
   ```bash
   cp .env.example .env
   ```
4. Générer la clé d’application :
   ```bash
   php artisan key:generate
   ```
5. Migrer la base et exécuter les seeders :
   ```bash
   php artisan migrate:fresh --seed
   ```
6. (Optionnel) Installer les dépendances Node.js et compiler les assets :
   ```bash
   npm install
   npm run dev
   ```
7. Lancer le serveur de développement :
   ```bash
   php artisan serve
   ```

---

Avec ces étapes, tu devrais pouvoir déployer ton application Laravel Hot-Takes sur un autre PC et la faire fonctionner en mode API. Bonne continuation !