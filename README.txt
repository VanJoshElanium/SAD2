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
     
4.) Download everything from GitHub and change its location to C:\wamp64\www\

5.) Open the command prompt
      - type in C:
      - type in cd C:\wamp64\www\
      - type in 'php artisan serve'
      - type in 'php artisan migrate'
      
6.) If step 5 produces errors, pm me thru fb/twitter or text me via 0945 123 2088 -Ann
      
