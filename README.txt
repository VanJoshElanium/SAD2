HOW TO LARAVEL, A TUTORIAL BY ANN HIHI :>

1. Download Wamp Server (http://www.wampserver.com/en/)
    - Set up Wamp to your preffered location, text editor, and web browser.
    - After setup and installation, run the application.
    - Check your taskbar for a WAMP icon, it should be GREEN.
    - Click on icon, go to the 'Apahce' folder -> httpd.conf
    - Control F (Find) and search for 
      - 'localhost'
        - Change the port number from 80 to 8080
      - 'listen'
        - Change the port number from 80 to 8080
    - Navigate to the 'PHP folder' -> Versions -> 7.1.9
    - Restart WAMP services, after a while, the icon should be GREEN.
    
/* ONLY FOLLOW THIS STEP IF YOUR ON THE P&P DEVELOPMENT TEAM */
2.) Go to your web browser and type in, localhost:8080/phpmyadmin/
     - Username: root, Password(is blank): 
     - Create a new database called 'laravel'
     
3.) Download Composer (https://getcomposer.org/Composer-Setup.exe)
      - Change the location of the PHP to C:\wamp64\bin\php\php7.1.9
      - In command prompt, type composer, a composer documentation should appear

4.) In command prompt, type-> cd 'C:\wamp64\www\' (wamp64 if version is 64-bit, and just wamp if version is 32-bit)

5.) Next, type 'composer create laravel/laravel name-of-project', where name-of-project is the name of the project you want to make

/* SKIP TO STEP 11 IF THIS IS YOUR FIRST TIME CREATING A LARAVEL PROJECT */

6.) Clone or download the SAD2-master project to C:\wamp64\www (64-bit WAMP) or C:\wamp\www (32-bit WAMP) directory

7.) Open command prompt and change the directory to the root of the project
    (ex. if your project is in C:\wamp64\www the type 'cd C:\wamp64\www\project-name, 
     where project-name is SAD2-master or what your renamed the project to) 

8.) Then, type 'composer install'

9.) Next, type 'php artisan migrate --seed'

10.) Then, type 'php artisan key:generate' //ONLY DO THIS STEP IF THERE IS NO .env FILE IN THE ROOT OF THE PROJECT

11.) Lastly, type 'php artisan serve'

12.) Check the portnumber of the php artisan serve (usually it is 8000) and then open your browser
     and type in 'localhost:<portnumber>', where <portnumber> is the port number provided by laravel
     
13.) Watch the videos in this youtube playlist to learn more about Laravel (https://www.youtube.com/watch?v=a8ZpAf_tNh0&list=PL3ZhWMazGi9IYymniZgqwnYuPFDvaEHJb&index=1)

12.) Happy Laravel Programming! :)
