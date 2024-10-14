
.PHONY:
start:
	docker compose up -d

.PHONY:
stop:
	docker compose stop

.PHONY:
shell:
	docker exec -it -u 1000:1000 flashcards-laravel bash

.PHONY:
shell-www:
	docker exec -it -u www-data flashcards-laravel bash

.PHONY:
shell-root:
	docker exec -it -u root flashcards-laravel bash

.PHONY:
db-dump:
	docker exec -it flashcards-mysql bash -c '/dump/dump.sh'

.PHONY:
db-restore:
	docker exec -it flashcards-mysql bash -c '/dump/restore.sh'
