# 2plus2_tourme

"Do you like traveling and meeting new people? If yes, you can combine both using our unique tool."

## Authors (in alphabetic order)

- Bakopoulos Menelaos (menelaosbgr@gmail.com)  - Frontend Developer
- Brani Katerina (katerina.brani@gmail.com) - Designer
- Kaidantzi Kerry (kerrykaidantzi@hotmail.com) - Designer
- Katsarakis Nikos (nkatsar@freemail.gr) - Backend Developer

## Description

English: The TourMate application aims to romantically match people who are interested to travel/see common destinations (both local and far away). A user can register/login to the application using only their facebook account and create personal "Adventures" that declare where they want to go, their travel perferences (e.g. budget, hotel, etc.), and with which sex they would like to travel with. The application looks for people with matching adventures and proposes these people, and their adventures, to one another provided their preferences match. If two users "like" each other there is a match and the users would then be able to talk and discuss further trip details. 

Greek: Η εφαρμογή TourMate ταιριάζει ανθρώπους που έχουν κοινό προορισμό και έχουν δείξει ενδιαφέρον ο ένας για τον άλλον. Ο χρήστης μπορεί να συνδεθεί στην εφαρμογή μέσω Facebook ή να δημιουργήσει λογαριασμό και να δημιουργήσει ταξίδια-περιπέτειες δηλώνοντας που θέλει να πάει ,το στυλ του ταξιδιού του, τα ενδιαφέροντά του και το με τι φύλο θέλει να ταξιδέψει. Η εφαρμογή ψάχνει ανθρώπους με αντίστοιχα στοιχεία και προτείνει τον έναν στον άλλον. Αν και οι δύο δείξουν ενδιαφέρον να ταξιδέψουν ο ένας με τον άλλον τότε υπάρχει ταίριασμα και οι χρήστες μπορούν να συνομιλήσουν, να γνωριστούν και να δουν και τις λεπτομέρειες του ταξιδιού τους.

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


## Usage

Once tourme-wp is installed in your server, you can go to tourme.gr (after performing the required change in your hosts file) and sign up either directly or by using facebook. You will also be able to select your preferences, which will be stored in the database. Feel free to browse through the menus, keeping in mind that that most of them are placeholders. However the form to create a new adventure is fully functional, you can select your target location using the provided map, noting that the range you are willing to visit from your selected point depends on the zoom level. 
Please note, most of the content in the front-end are stored within the wordpress DB as opposed to project code files (this is the case with most WP).

To see a list of the adventures created by a specific user (in JSON format), you can go to {REST-IP:PORT}/rest/{user\_id}/adventures using your web browser, where {REST-IP:PORT} is the address/port of the Java application server and {user\_id} is the id of any registered user (try the numbers 1-7). To see a list of suggested adventures for a specific user, go to {REST-IP:PORT}/rest/{user\_id}/suggestions. **NOTE:** that there are currently **NO** security restrictions in the REST interface.

## Usefull Improvements

For anyone interested to use this project, and for ongoing development, it would be useful to:
- Change to using a wordpress child theme instead of making changes directly to an existing wordpress theme.
- Use proxypass apache configuration to place tomcat behind apache frontend.
- Improve the UI using a JQuery Mobile Theme for the look and feel of forms and map.
 
## Necessary Improvements

It is absolutely necessary to:

- Improve the mechanisms that pass session/user data between php, javascript, and the Java Rest Service.
- Implement (or configure) a mechanism such as single sign on between wordpress and the Java Rest Service.
