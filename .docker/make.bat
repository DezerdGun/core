@echo off

IF "%1"=="" (
    echo Usage:
    echo    make.bat env-up
    echo    make.bat env-down
    echo    make.bat env-restart
    echo    make.bat php-attach
    echo    make.bat migrate-up
    echo    make.bat migrate-down
    echo    make.bat php-logs
    echo    make.bat clean-assets
    echo    make.bat markup-be-build
    echo    make.bat markup-fe-build
    echo    make.bat markup-build
    echo    make.bat clean-assets-host
    echo    make.bat ngrok-run-fe
    echo    make.bat php-restart
    echo    make.bat database-init-test-instance
    echo    make.bat test
)

IF "%1"=="env-up" (
	docker-compose up -d --build --force-recreate
	docker-compose ps
)
IF "%1"=="env-down" docker-compose stop
IF "%1"=="env-restart" (
	make.bat env-down
	make.bat env-up
)
IF "%1"=="php-attach" docker-compose exec php bash
IF "%1"=="migrate-up" docker-compose exec php ./yii migrate --interactive=0
IF "%1"=="migrate-down" docker-compose exec php ./yii migrate/down --interactive=0
IF "%1"=="php-logs" docker-compose logs -f php
IF "%1"=="clean-assets" (
	docker-compose exec php find backend/web/assets -maxdepth 1 ! -path backend/web/assets -type d -exec rm -rf {} \;
	docker-compose exec php find frontend/web/assets -maxdepth 1 ! -path frontend/web/assets -type d -exec rm -rf {} \;
)
IF "%1"=="markup-be-build" (
	docker-compose exec node bash -c "cd backend && npm install && gulp --version && gulp build"
	make.bat clean-assets
)
IF "%1"=="markup-fe-build" (
	docker-compose exec node bash -c "cd frontend && npm install && gulp --version && gulp build"
	docker-compose exec node bash -c "chmod o+w frontend/dist"
	git checkout HEAD ../markup/frontend/dist/favicon.ico
	make.bat clean-assets
)
IF "%1"=="markup-build" (
	make.bat markup-be-build
	make.bat markup-fe-build
)
IF "%1"=="clean-assets-host" (
	find ../backend/web/assets -maxdepth 1 ! -path ../backend/web/assets -type d -exec rm -rf {} \;
	find ../frontend/web/assets -maxdepth 1 ! -path ../frontend/web/assets -type d -exec rm -rf {} \;
)
IF "%1"=="ngrok-run-be" (
	docker run -e "NGROK_AUTH=1uZQi8L3eK4J9rABCIVG345pv7P_7WBKdjWrRx8kHUqtgjnCV" -e "NGROK_PORT=192.168.32.1:8001" --rm -P wernight/ngrok
)
IF "%1"=="ngrok-run-fe" (
	docker run -e "NGROK_AUTH=1uZQi8L3eK4J9rABCIVG345pv7P_7WBKdjWrRx8kHUqtgjnCV" -e "NGROK_PORT=192.168.32.1:8003" --rm -P wernight/ngrok
)
IF "%1"=="php-restart" (
	docker-compose restart php
)
IF "%1"=="database-init-test-instance" (
	docker-compose exec database /docker-entrypoint-initdb.d/z2.sh
)
IF "%1"=="test" (
	docker-compose exec php ./run_tests.sh
)
