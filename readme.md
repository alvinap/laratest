## CONFIGURATION DATABASE POSTGRESQL
$ sudo -u postgres psql
## CREATE USER
$ sudo -u postgres createuser laratest
## CREATE DATABASE
$ sudo -u postgres createdb laratest
$ sudo -u postgres psql
## CREATE PASSWORD
psql=# alter user laratest with encrypted password 'laratest'; 
psql=# grant all privileges on database laratest to laratest ;

## MIGRATION
php artisan make:migration create_blog_table --create=blog 
php artisan migrate
## QUEUE
php artisan queue:table 
php artisan make:job first 
php artisan make:job second 
php artisan make:controller SendMailController --resource 
## FACTORY
php artisan db:seed --class=BlogTableSeeder 