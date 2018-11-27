# Database-Project

To run this web service, you must have some sort of web development environemnt, such as; WAMP Server, XAMPP, or something similar. Through this environment, you must have a functioning MySQL server. Additionally, to use the POST functionality, it's recommended that you use Postman (found at 'https://www.getpostman.com/').

To start, first generate the database by running the following SQL query in your MySQL server (done through MyPHPAdmin, http://localhost/phpmyadmin/):
```
CREATE DATABASE IF NOT EXISTS recipedb CHARACTER SET utf8mb4;
```
Then, run the SQL code found in the recipedb.sql, inside the recipedb database, to generate the structure of the database. It is highly recommened to populate the tables, which can be done by running the SQL code found in populate_recipedb.sql. Populating the tables is not necessary, but it provides a more clear picture as to the functionality of the web service.
Then in the db_connection.php file, change the information for the server (default is localhost for the dbhost, root as the username, and no password)

Once this is setup, locate the file directory for your chosen web development environemnt. For XAMP, the default location for this is located at: 'C:\wamp64\www\'. Move the folder Database-Project-master, into this directory.

Through your prefered browser, go to 'http://localhost/Database-Project-master/' for the file directory, or 'http://localhost/Database-Project-master/login.php' to start. If you did not populate the tables with data, you will have to regiser an account in the database, by using 'http://localhost/Database-Project-master/register.php'. The register page will redirect you to the login page if it was successful. Login using any of the inserted credentials (example; username 'Adam', password 'adam123'), or with the previously registered login details. From the welcome page, most of the content can be explored.

To test the POST GET functionality, send 'http://localhost/Database-Project-master/readRecipes.php' through Postman.
