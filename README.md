# RoomStatusViewer


## Installation
1. Clone git repo into designated folder
2. Run `composer install` in directory.
3. Clone included `.env.example` file to `.env` and modify:
    - Database connection to desired database format (laravel supports multiple versions, mysql is default.)
    - Change database creds to a blank database with a user who has all permissions on this database. 
    - Change App URL to the external location one would access the root of the project.
4. Run `php artisan key:generate` in directory. 
5. Run `php artisan:migrate` in directory.
6. Run `php artisan db:seed` in directory. 
7. You should be able to access the service, try going to /login or /admin
8. The seeding process creates an admin user for you.
    - Username is: `brendan@email.com` 
    - Password is: `brendan` 

## Words of note
1. You may need to change some permissions so Laravel has proper access to folders
    - If you are getting errors about log files, please run `chmod -R 777 storage` in the root of the project for the storage folder.
2. Laravel uses pretty routing. To ensure this works properly, please set your webserver to use the /public directory of the repo as the root of the project.
    - A .htaccess file is included in this directory which should work out of the box with apache servers. Nginx support is available as well. 
    - Stack overflow <3 has lots of help on getting routing working for different server setups.

## General Information
1. Repo includes the Backpack plugin for the admin panel as well as a Permissions plugin for specifiying regular/admin access to control panel. Also includes a Charting plugin for pretty graphs in the admin panel.
2. Can view all routes for package in /routes/web. Admin panel routes are available in /routes/backpack/custom.php
3. A RESTful API has been created for third party access if desired in the future. These routes can be found in /routes/api.php
    - It is exposed at `/api/`. Uses bearer tokens for validating requests. `/api/login and /api/register` to gain a token. Users are synced across the API/Web access.
    - If this functionality is not desired just turn off these routes by commenting them out in this file.