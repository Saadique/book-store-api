#Getting Started

**How to start application in local environment**

* Clone the project and run the command 'composer install' to install dependencies.


 * Then run the command 'php artisan serve' to initiate the service. Make sure 
the port 8000 is free.
Most probably the application may run in http://127.0.0.1:8000

* Then you can use this domain url to access application APIs

* Please review API docs 

#Database Setup

* Create MySQL database with name 'books'.
* create .env file with the content in .env.example
* Then run 'php artisan migrate' command to create the tables in the database
 

#Populate Data


* To populate data to database books table from https://fakerapi.it/api/v1/books?_quantity=100, we should run 
a customized artisan command in the terminal of the project.

**php artisan generate_data:books**
