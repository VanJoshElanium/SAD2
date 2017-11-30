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
    
2.) Go to your web browser and type in, localhost:8080/phpmyadmin/
     - Username: root, Password(is blank): 
     - Create a new database called 'laravel'
     
3.) Download Composer (https://getcomposer.org/Composer-Setup.exe)
      - Change the location of the PHP to C:\wamp64\bin\php\php7.1.9

/* REPEAT STEPS 4-6 and 9-10 when you've already installed all the requirements to develop a laravel project and are are going to clone the updated SAD2-master project */

4.) Clone or download the SAD2-master project to C:\wamp64\www (64-bit WAMP) or C:\wamp\www (32-bit WAMP) directory

5.) Open command prompt and change the directory to the root of the project
    (ex. if your project is in C:\wamp64\www the type 'cd C:\wamp64\www\project-name, 
     where project-name is SAD2-master or what your renamed the project to) 

6.) Then, type 'composer install'

7.) Next, type 'php artisan migrate --seed'

8.) Then, type 'php artisan key:generate'

9.) Lastly, type 'php artisan serve'

10.) Check the portnumber of the php artisan serve (usually it is 8000) and then open your browser
     and type in 'localhost:<portnumber>, where <portnumber> is the port number provided by laravel'
     
11.) Watch the videos in this youtube playlist to learn more about Laravel (https://www.youtube.com/watch?v=a8ZpAf_tNh0&list=PL3ZhWMazGi9IYymniZgqwnYuPFDvaEHJb&index=1)

12.) Happy Laravel Programming! :)
