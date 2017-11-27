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
  
4.) Follow the instructions on the pictures I sent on Messenger
      
