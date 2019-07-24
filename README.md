Innosabi
=========

Following these commands, you will be able to have a ready environment with PHP 7.2, Apache, MariaDB, Adminer, Composer 
and simply try to use innosabi-api.

##### Till start installation make sure that you have installed:
* GIT
* Docker
* Docker Compose

If not, follow the links below:

How to install:
[GIT](https://gist.github.com/derhuerst/1b15ff4652a867391f03),
[Docker](https://docs.docker.com/install/),
[Docker Compose](https://docs.docker.com/compose/install/)

Description
-----
Innosabi-api is the RESTful API microservice based on Lumen framework with JWT Authentication.
The main purpose of the app is authenticate user and get requested data.

Installation
-----
Till start the installation make sure that you have available ports on your local machine:
 8080, 3307, 6080.


Clone project and enter into it:
```
1. $ git clone git@github.com:evgeniispirin/innosabi.git
2. $ cd ./innosabi
```
Create our environment via docker:
```
3. $ docker-compose up --build
```
Wait for a while till docker download images and build new containers. When it's finished you will see something like: 

"...
composer_1  | Generating optimized autoload files
innosabi_composer_1 exited with code 0
...
"

Than open new tab shell and change directory to our project /innosabi. 
Now enter into the container:
```
4. $ docker-compose exec web bash
```

Making our migrations and seeding with random data:
```
5. $ php artisan migrate
6. $ php artisan db:seed
```

You can run simple unit tests from inside our container via composer:
```
7. $ composer test
```

Testing via Postman
-----
Find 'Innosabi API.postman_collection' in project dir /innosabi and import it into the Postman.

Have fun!