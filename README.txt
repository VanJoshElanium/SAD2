1. Download Wamp Server (http://www.wampserver.com/en/#wampserver-64-bits-php-5-6-25-php-7)
    - Set up Wamp to your preffered location, text editor, and web browser.
    - After setup and installation, run the application.
    - Check your taskbar for a WAMP icon, it has to be GREEN.
    - Click on icon, go to PHP -> Versions -> 7.1.9
    - Wait and let WAMP restart...
    - Click on icon, go to Apahce -> httpd.conf
    - Control F and search for 
      - 'localhost'
        - Change it to 8080
      - 'listen'
        - Change it to 8080
    - Restart WAMP services, it should be green.
    
2.) Go to your web browser and type in, localhost:8080/phpmyadmin/
     - Username: root, Password(is blank): 
     - Create a new database called 'laravel'
     
3.) Download Composer (https://getcomposer.org/Composer-Setup.exe)
      - Change the location of the PHP to C:\wamp64\bin\php\php7.1.9

4.) Clone or download the SAD2 project to your preferred destination

5.) Open command prompt and change the directory to the root of the project
    (ex. if your project is in C:\wamp64\www -> cd C:\wamp64\www\project-name)
    
6.) type 'composer install'

7.) Copy the contents of .env.example (found in the root of the project) and save
    it to a new file with the name '.env' and make sure its file type is 'all file types'
     
8.) In the command prompt, type 'php artisan migrate --seed'

9.) Lastly, type 'php artisan serve'

10.) Check the portnumber of the php artisan serve (usually it 8000) then open your browser
     and type in 'localhost:8000'
     
11.) Watch the videos in this youtube playlist to learn more about Laravel (https://www.youtube.com/watch?v=a8ZpAf_tNh0&list=PL3ZhWMazGi9IYymniZgqwnYuPFDvaEHJb&index=1)

12.) Happy Laravel Coding! :)
