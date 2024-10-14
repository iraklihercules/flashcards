#!/usr/bin/env bash

mysqldump --no-tablespaces -u user1 -ppass1 flashcards_db > /dump/flashcards_db.sql
