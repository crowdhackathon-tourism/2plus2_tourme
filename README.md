# 2plus2_tourme
Find your tour mate

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
```

Instructions to install:

-- tourme-wp can be copied on the htdocs of an Apache HTTP Server with PHP/MySQL support
   it is much easier to install on a XAMPP 
   also you have to add in your hosts file the folowing line
   YOUR_SERVER_IP tourme.gr
   
   Also please change the address 192.168.29.1:8080 in "tourme-wp/js/tourme.js" with the 
   address of the Java REST application server
   and update MySQL settings in tourme-wp/wp-config.php

-- java-rest is a typical Maven project, it can be deployed on any Java application server
   MySQL settings should be configured in tourme-app/src/main/webapp/WEB-INF/spring/root-context.xml
   
