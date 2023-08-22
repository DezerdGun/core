Add the following lines to your hosts file (/etc/hosts in Linux/Mac OS c:\Windows\System32\Drivers\etc\hosts in Windows):
```
127.0.0.1   backend.tmp.loc
127.0.0.1   frontend.tmp.loc
127.0.0.1   api.tmp.loc
```
Start/Stop/Down/Attach/Logs
```
If you work on Windows use ./make.bat command instead of make in the commands below.
```
First change to .docker directory
````
cd .docker
````
Build environment
```
make env-up
```
Start
```
make env-start
```
Stop
```
make env-stop
```
Down
```
make env-down
```
Attach
```
Attach local standard input, output to a container in which php:7.4-fpm is working. Required to install Composer packages, generating and executing database migrations etc.
```
```
make php-attach
```
Logs
```
make php-logs
```
### pgAdmin
http://localhost:8000

Email/Password: admin@jafton.com/password

DB Password: secret

### Debug
````
Install "Xdebug helper" Google Chrome extension.
````
### PhpStorm

File->Settings->PHP->Debug

Xdebug section:

````
Debug port = 9003

Force break at first line when no path mapping specified = off

Force break at first line when a script is outside the project = off
````



Pre-configuration section:
````
click "Start Listening" button
````

### OAuth2
Migrate OAuth2 tables
````
./yii migrate --migrationPath=@vendor/filsh/yii2-oauth2-server/src/migrations
````
### Rbac
Rbac migration commands
````
./yii rbac/init

./yii migrate --migrationPath=@yii/rbac/migrations
````

### gii/giiant

http://backend.tmp.loc/gii

http://frontend.tmp.loc/gii

### backend.tmp.loc and frontend.tmp.loc
http://localhost:8000

Email/Password: admin@jafton.com/chesnok

### backend.tmp.loc and frontend.tmp.loc create user
./yii user/create

### ACH transfer

/stripe/transfer - Endpoint returns client key.

request body:
amount - amount of money. Ex 1000 -> 10$ 

