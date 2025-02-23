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
* run `php artisan migrate` to run migrations
* Also from the docker container terminal run `service apache2 start` to start apache webserver in the docker container.
* open the `hosts` file on your machine and add `mn2s-blogapi.test` which is the servername set in the vhost in the `config/000-default.conf`
* add the root url of the wordpress blog and assign it to `.env` value `WORDPRESS_ROOT_URL`

 **How to Run Application**
 * Setup your Wordpress blog and add some blog posts
 * If you are using a local Wordpress instance, you may need to create vhost for your wordpress setup in
   MAMP or WAMP `httpd-vhosts.conf` as you may run into errors using Guzzle client to get blog posts from the wordpress site when running the command to get posts
 * run `php artisan app:get-blog-posts-from-wordpress` to get blog posts from the wordpress site and save to Laravel API db.
