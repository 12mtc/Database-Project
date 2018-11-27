# Database-Project

To run this web service, you must have some sort of web development environemnt, such as; WAMP Server, XAMPP, or something similar. Through this environment, you must have a functioning MySQL server. Additionally, to use the POST functionality, it's recommended that you use Postman (found at 'https://www.getpostman.com/').

To start, run the SQL code in the recipedb.sql, to generate the structure of the database. To populate the tables, run the SQL code found in populate_recipedb.sql. Populating the tables is not necessary, but it provides a more clear picture as to the functionality of the web service.
Then in the db_connection.php file, change the information for the server (default is localhost for the dbhost, root as the username, and no password)

Once this is setup, locate the file directory for your chosen web development environemnt. For XAMP, this is located at: 'C:\wamp64\www\'. Move the folder Database-Project-master, into this directory.

Through your prefered browser, go to 'http://localhost/recipeproj/' for the file directory, or 'http://localhost/recipeproj/login.php' to start. If you did not populate the tables with data, you will have to regiser an account in the database, by using 'http://localhost/recipeproj/register.php'. The register page will redirect you to the login page if it was successful. Login using the username of 'Adam' and the password of 'adam123', or with the login with the details previously registered. From the welcome page, most of the content can be explored.

To use the POST GET functionality, send 'http://localhost/recipeproj/readRecipes.php' through Postman.
