# Configuration Docker PHP 5.6 et PHP 8.1 avec Nginx

Ce projet met en place deux environnements PHP distincts sous Docker, permettant de faire coexister des applications nécessitant différentes versions de PHP.

## Description des Projets

### Projet 1 (PHP 5.6)
- Environnement PHP 5.6 avec Nginx
- Port d'accès : 8090
- Extensions PHP activées :
  - mysqli
  - pdo
  - intl

### Projet 2 (PHP 8.1)
- Environnement PHP 8.1 moderne avec Nginx
- Port d'accès : 8091
- Extensions PHP activées :
  - mysqli
  - pdo
  - pdo_mysql
  - intl
  - sqlsrv (version 5.10.1)
  - pdo_sqlsrv (version 5.10.1)

#### Détails du Driver SQL Server
- Microsoft ODBC Driver 17 pour SQL Server
- Extensions PHP SQL Server :
  - sqlsrv version 5.10.1
  - pdo_sqlsrv version 5.10.1
- Configuration TLS/SSL incluse
- Support complet des fonctionnalités SQL Server 2008 R2 et versions ultérieures

## Structure du Projet

\```
.
├── docker-compose.yml
├── nginx/
│   ├── nginx-projet1.conf  # Configuration Nginx pour PHP 5.6
│   └── nginx-projet2.conf  # Configuration Nginx pour PHP 8.1
├── php56.Dockerfile
├── php81.Dockerfile
├── Makefile
└── www/
    ├── projet1/           # Application PHP 5.6
    │   └── index.php
    └── projet2/           # Application PHP 8.1
        └── index.php
\```

## Prérequis - Installation de Docker

### Sous Windows
1. Installer WSL2 (Windows Subsystem for Linux)
\```bash
wsl --install
\```

2. Télécharger et installer Docker Desktop depuis [le site officiel](https://www.docker.com/products/docker-desktop)
3. Lancer Docker Desktop et s'assurer qu'il utilise WSL2

### Sous Linux (Ubuntu/Debian)
1. Installer Docker
\```bash
# Mettre à jour le système
sudo apt-get update

# Installer les prérequis
sudo apt-get install -y \
    apt-transport-https \
    ca-certificates \
    curl \
    gnupg \
    lsb-release

# Ajouter la clé GPG officielle de Docker
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg

# Configurer le repository stable
echo "deb [arch=amd64 signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null

# Installer Docker
sudo apt-get update
sudo apt-get install -y docker-ce docker-ce-cli containerd.io

# Ajouter l'utilisateur au groupe docker
sudo usermod -aG docker $USER
\```

2. Installer Docker Compose
\```bash
# Télécharger la dernière version de Docker Compose
sudo curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose

# Rendre le binaire exécutable
sudo chmod +x /usr/local/bin/docker-compose
\```

## Utilisation avec Makefile

Le Makefile inclut les commandes suivantes :

\```bash
# Démarrer tous les services
make up

# Arrêter tous les services
make down

# Reconstruire les images et redémarrer les services
make rebuild

# Afficher les logs
make logs-php56    # Logs du conteneur PHP 5.6
make logs-php81    # Logs du conteneur PHP 8.1
make logs-nginx1   # Logs du serveur Nginx (projet 1)
make logs-nginx2   # Logs du serveur Nginx (projet 2)

# Accéder aux shells des conteneurs
make shell-php56   # Shell PHP 5.6
make shell-php81   # Shell PHP 8.1
make shell-nginx1  # Shell Nginx (projet 1)
make shell-nginx2  # Shell Nginx (projet 2)

# Nettoyer complètement l'environnement
make clean
\```

## Accès aux Applications

- Projet PHP 5.6 : http://localhost:8090
- Projet PHP 8.1 : http://localhost:8091

## Test de la Connexion SQL Server (PHP 8.1)

Modifier le fichier `www/projet2/index.php` avec vos paramètres de connexion :

\```php
$serverName = "your_server_name";
$connectionOptions = array(
    "Database" => "your_database",
    "Uid" => "your_username",
    "PWD" => "your_password",
    "TrustServerCertificate" => true
);
\```

## Maintenance

Pour une réinitialisation complète de l'environnement :
\```bash
make clean
make up
\```

Cette commande supprimera tous les conteneurs, images et volumes associés avant de reconstruire l'environnement.
