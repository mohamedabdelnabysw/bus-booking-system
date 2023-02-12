# Fleet Management System

This repository is for Robusta Studio's task building a fleet management (bus booking) system.  

## Built with

Stack | Technology used
----- | ---------------
Programming Language | PHP
Web Framework | [Laravel 9](https://laravel.com/docs/9.x)
Relational Database | MySQL

## Prerequisities

This project leverages the power of [Laravel Sail](https://laravel.com/docs/8.x/sail) which, at its heart, is a `docker-compose.yml` file.  
So, in order to get the project up and running you just need **Docker** installed on your PC.  
Please follow the installation documentation based on your operating system whether [macOS](https://laravel.com/docs/8.x/installation#getting-started-on-macos), [Windows](https://laravel.com/docs/8.x/installation#getting-started-on-windows), or [Linux](https://laravel.com/docs/8.x/installation#getting-started-on-linux).  

## Installation & Setup

After you have installed Docker on your machine follow these steps to get the project up and running:  
1. Clone the repository to your machine 

2. Install project dependencies
    ```
    docker-compose up -d
    docker exec -it ticket-app bash
    composer install
    ```

3. Once the last step is done you can migrate & seed the database with the Database dump
    ```
    php artisan migrate --seed
    ```

4. You can access the app from http://localhost:8007/api/
    
5. And that's it, the project is up and running :rocket:

## API Endpoints

All API endpoints are prefixed with `/api`

## How to use

login with any user (email and password) http://localhost:8007/api/login it will return user object and [token]

You will use this Token with all other endpoints as [Bearer] [token]

http://localhost:8007/api/search is used to get all available seats from station to another 
by sending { from_id , to_id } . 
it will return 
    ```
    [
        {
            trip:{
                id, 
                bus:{
                    id, 
                    availableSeats:{ id, name}
                }
            }
        }, ...
    ]
    ```

http://localhost:8007/api/search is used to book an available seat from station to another in specific trip
by sending { "seat_id", "trip_id", "bus_id", "user_id", "from_stop_number", "to_stop_number"} .