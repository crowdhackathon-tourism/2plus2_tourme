# 2plus2_tourme

"Do you like traveling and meeting new people? If yes, you can combine both using our unique tool."

## Authors (in alphabetic order)

Original Hackathon Members:
- Bakopoulos Menelaos (menelaosbgr@gmail.com)  - Frontend Developer
- Brani Katerina (katerina.brani@gmail.com) - Designer
- Kaidantzi Kerry (kerrykaidantzi@hotmail.com) - Designer
- Katsarakis Nikos (nkatsar@freemail.gr) - Backend Developer

Late Addition (after Hackathon):
- Eri Markopoulou (erika_markop@yahoo.com) - Editor (Documentation, Text)

## Description

English: The TourMate application aims to match people who are interested in visiting common destinations. A user can register/login to the application just using their Facebook account and then create personal "Adventures" specifying the desired destination, travel preferences (e.g. budget, hotel), and the sex they would like to travel with. The application identifies adventure matches and brings together people with common travel preferences. If two users "like" each other, there will be a match and the users will then be able to discuss further details about the trip.

Greek: Η εφαρμογή TourMate φέρνει σε επαφή δύο χρήστες που έχουν εκφράσει ενδιαφέρον για ένα κοινό προορισμό. Ο χρήστης μπορεί να συνδεθεί στην εφαρμογή μέσω Facebook ή να δημιουργήσει λογαριασμό και να δημιουργήσει ταξίδια-περιπέτειες δηλώνοντας επιθυμητό προορισμό, είδος ταξιδιού, ενδιαφέροντα και φύλο προτίμησης. Η εφαρμογή ψάχνει ανθρώπους με κοινά στοιχεία και προτείνει συνδυασμούς. Αν και οι δύο χρήστες δείξουν ενδιαφέρον να ταξιδέψουν μαζί, τότε δημιουργείται ταίριασμα που τους επιτρέπει να συνομιλήσουν, να γνωριστούν και να συζητήσουν για τις λεπτομέρειες του ταξιδιού.

## Design-Online Interactive Mockup

Concurrently with development of backend functionallities and configuration our designers produced a semi-interactive online mockup: https://marvelapp.com/1c26029

## Features (implemented during crowdhackathon-tourism on 17-18 October 2015)
- User registration using 
- Creation of new adventures
- Receive list of own adventures (REST interface only)
- Receive list of suggested adventures (REST interface only)

## Technologies used
- Responsive mobile user interface powered by Wordpress (https://wordpress.com/)
- User management powered by Buddypress (https://buddypress.org/)
- Custom code for frontend in PHP / JavaScript / JQuery (https://jquery.com/)
- REST interface written in JAVA using Spring Framework (http://projects.spring.io/spring-framework/)
- MariaDB (https://mariadb.org/) (or any MySQL compatible database) for the DB layer


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

## Installation Instructions

Requirements
-PHP
-MySQL
-Apache HTTP web server with mod_php and mod_php installed

-- Copy the contents of tourme-wp into the document root of your web server (e.g. /var/www/htdocs). Add the line YOUR_SERVER_IP tourme.gr to your hosts file.
  
 Replace the address 192.168.29.1:8080 in "tourme-wp/js/tourme.js" with the address of the application server running the Java REST API. Also update the MySQL related settings in "tourme-wp/wp-config.php"
 
-- Java REST is a typical Maven project, deployable in any Java application server. Configure MySQL settings in tourme-app/src/main/webapp/WEB-INF/spring/root-context.xml
   
To access the Wordpress front end use:
- Username: tourme
- Password: t0urm3
- Administrative URL : http://tourme.gr/wp-admin
 
To access the frontend on a mobile emulator uncomment the respective lines, specified by comments in tourme-wp/.htaccess


## Using the service

Once you install tourme-wp in your server, go to tourme.gr (after performing the necessary changes in your hosts file) and sign up either directly or through Facebook. You can also select your preferences, which will be stored in the database. Feel free to browse through the menus, considering that most of them are placeholders. Yet, the form to create a new adventure is fully functional. Select your target location using the provided map, noting that the travel distance depends on the zoom level. Also note that most of the content in the front end is stored within the Wordpress schema as opposed to project code files.

The REST API produces results in JSON format.
Through your web browser, you can visit:
- {REST-IP:PORT}/rest/{user_id}/adventures to browse a list of adventures created by a specific user
- {REST-IP:PORT/rest/{user_id}/suggestions to retrieve a list of suggested adventures for a specified user where {REST-IP:PORT} is the address:port of the Java application server and {user_id} is the ID of any registered user (try the numbers 1-7)

NOTE: that there are currently NO security restrictions in the REST interface.

## Necessary Improvements

It is absolutely necessary to:

- Improve the mechanisms that exchange user and session data between PHP, JavaScript, and the Java REST service.
- Implement Single Sign On (SSO) between WordPress and the Java REST service.

## Useful Improvements

For anyone interested in engaging in this project or for further development, it would be useful to:
- Change to using a WordPress child theme instead of directly modifying an existing WordPress theme.
- Use the ProxyPass Apache configuration to place tomcat behind Apache front end. Configure a reverse proxy for the application server running the REST API.
- Use a jQuery Mobile Theme to improve the look and feel of the UI.
