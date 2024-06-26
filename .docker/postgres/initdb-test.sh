#!/bin/bash
sleep 1
psql -U postgres <<- EOSQL
CREATE DATABASE $TEST_DB_NAME TEMPLATE=template_postgis;
CREATE USER $TEST_DB_USER WITH PASSWORD '$TEST_DB_PASSWORD';
GRANT ALL PRIVILEGES ON DATABASE $TEST_DB_NAME TO $TEST_DB_USER;
GRANT ALL PRIVILEGES ON DATABASE $TEST_DB_NAME TO $DB_USER;
EOSQL
psql -U postgres -d $TEST_DB_NAME <<- EOSQL
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO $DB_USER;
EOSQL