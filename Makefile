SET_IDS=export USERID=$$(id -u); export GID=$$(id -g)
CMD_ON_APP=docker-compose exec -u www-data vivapets-test-app

.PHONY: build
build:
	$(SET_IDS); docker-compose build

.PHONY: setup
setup:
	cp .env.example .env
	$(MAKE) build
	$(MAKE) up
	$(CMD_ON_APP) composer install
	$(CMD_ON_APP) npm install
	$(CMD_ON_APP) npm run dev

.PHONY: up
up:
	docker-compose up -d

.PHONY: down
down:
	docker-compose down

.PHONY: bash
bash:
	$(CMD_ON_APP) bash
