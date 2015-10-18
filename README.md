# 2plus2_tourme
Find your tour mate

## Authors

Bakopoulos Menelaos (menelaosbgr@gmail.com)
Brani Katerina (katerina.brani@gmail.com)
Kaidantzi Kerry (kerrykaidantzi@hotmail.com)
Katsarakis Nikos (nkatsar@freemail.gr)


## Design-Online Interactive Mockup

Concurrently with development of backend functionallities and configuration our designers produced a semi-interactive online mockup: https://marvelapp.com/1c26029

## Project Structure

```
project
│   .gitignore: git ignore file
│   README.md : This file
│
└───dbscripts: SQL dump of database and scripts for creating additional 
|              required tables and stored procedures
|
├───java-rest: REST interface backend for creating/browsing user 
|              adventures and finding matches
|
├───presentation: The presentation of crowdhackathon on 2015-10-18
|
└───tourme-wp: Responsive mobile user interface powered by Wordpress
               User management powered by Buddypress
```

## Instructions to install

-- tourme-wp can be copied on the htdocs of an Apache HTTP Server with PHP/MySQL support
   it is much easier to install on a XAMPP 
   also you have to add in your hosts file the folowing line
   YOUR_SERVER_IP tourme.gr
   
   Also please change the address 192.168.29.1:8080 in "tourme-wp/js/tourme.js" with the 
   address of the Java REST application server
   and update MySQL settings in tourme-wp/wp-config.php

-- java-rest is a typical Maven project, it can be deployed on any Java application server
   MySQL settings should be configured in tourme-app/src/main/webapp/WEB-INF/spring/root-context.xml
   
Wordpress admin username: tourme,  password: t0urm3, url: tourme.gr/tourme/wp-admin

In order to run the WordPress Frontent on mobile emulator, uncomment the respective lines in tourme-wp/.htaccess
