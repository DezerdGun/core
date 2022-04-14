#!/bin/bash
sleep 1
psql -U postgres <<- EOSQL
CREATE DATABASE $DB_NAME TEMPLATE=template_postgis;
CREATE USER $DB_USER WITH PASSWORD '$DB_PASSWORD';
GRANT ALL PRIVILEGES ON DATABASE $DB_NAME TO $DB_USER;
EOSQL