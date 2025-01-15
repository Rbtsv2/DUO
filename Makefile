.PHONY: all up down rebuild clean logs-php56 logs-php81 logs-nginx1 logs-nginx2 shell-php56 shell-php81 shell-nginx1 shell-nginx2

# Commande principale qui nettoie tout et reconstruit
all: clean up

# Démarrer les conteneurs
up:
	docker-compose up -d

# Arrêter les conteneurs
down:
	docker-compose down

# Reconstruire les conteneurs
rebuild:
	docker-compose down
	docker-compose build --no-cache
	docker-compose up -d

# Nettoyer l'environnement (conteneurs, images, volumes)
clean:
	docker-compose down
	docker rmi $$(docker images | grep -E 'php56|php81|nginx' | awk '{print $$3}') 2>/dev/null || true
	docker system prune -f
	docker volume prune -f

# Commandes pour les logs
logs-php56:
	docker-compose logs php56

logs-php81:
	docker-compose logs php81

logs-nginx1:
	docker-compose logs nginx1

logs-nginx2:
	docker-compose logs nginx2

# Commandes pour accéder aux shells des conteneurs
shell-php56:
	docker-compose exec php56 bash

shell-php81:
	docker-compose exec php81 bash

shell-nginx1:
	docker-compose exec nginx1 bash

shell-nginx2:
	docker-compose exec nginx2 bash
