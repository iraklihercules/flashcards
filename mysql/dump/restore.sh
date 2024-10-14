#!/usr/bin/env bash

mysql -u user1 -ppass1 -h localhost flashcards_db < /dump/flashcards_db.sql
