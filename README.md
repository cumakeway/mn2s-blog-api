**Requirements**

* You need to have Docker desktop installed on your machine
* You need MAMP or WAMP server installed on your machine.

**Setup**
* Create the Laravel API database in your local MAMP or WAMP server using phpmyadmin.
* Clone repo.
* cd into repo folder and run `docker-compose up -d` to setup Laravel API docker container.
* Note that `docker-compose.yml` does not include database container as I used mysql db from my locally installed MAMP server
So you can use the following db creds in your laravel api .env file

  `DB_HOST=host.docker.internal`

  `DB_PORT= (your_mamp_wamp_server_mysql_port)`

  `DB_DATABASE= (your_laravel_api_database)`

  `DB_USERNAME = (your_laravel_api_database_username)`
  
  `DB_PASSWORD = (your_laravel_api_database_password)`
* Open Laravel API docker container terminal, type `bash`.
* From the terminal of the docker container run `composer install` to install composer dependencies.
* Also from the docker container terminal run `service apache2 start` to start apache webserver in the docker container.
* add the root url of the wordpress blog and assign it to `.env` value `WORDPRESS_ROOT_URL`

 
