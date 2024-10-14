
.PHONY:
start:
	docker compose up -d

.PHONY:
stop:
	docker compose stop

.PHONY:
db-dump:
	docker exec -it flashcards-mysql bash -c '/dump/dump.sh'

.PHONY:
db-restore:
	docker exec -it flashcards-mysql bash -c '/dump/restore.sh'
