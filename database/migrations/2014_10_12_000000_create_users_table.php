> Project contains 
  : An edited login page
  - Unsure how to adjust the width of the container of the logo, username and password textbox
  : Light Dashboard Theme (\public\light-dashboard)
   - Not yet connected to the home page

> How to View/Edit Project
1.) Extract the file to your preferred destination.
2.) Open the command prompt.
3.) Change directory to the path of the project (cd \path-of-project).
4.) Type in 'php artisan serve' (Take note of the port number it outputs)
5.) Create a database in PhpMyAdmin called 'laravel'.
6.) In the command promt, type in 'php artisan migrate'.
7.) Go back to PhpMyAdmin and create a user in the 'users' table.
8.) Go to your browser and type in 'localhost:8080/register' (change 8080 to the port number that Laravel gave you).
9.) Login with your created user's credentials.