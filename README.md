

>*This is [Jiyoung's Web Application Project] (https://intelligent-parking.herokuapp.com/) which took roughly 2 weeks (doing part-time job and learning tennis).*
>*This application uses skills below.*
>*I hope you like this.*

1.PHP and Yii 2 Advanced Project Template on Heroku
===============================

This application is written in [PHP](http://php.net/manual/en/tutorial.php) on [Yii 2 Advanced Project Template](http://www.yiiframework.com/) using open-source relational database [PostgreSQL](https://www.postgresql.org/). It is running on [Heroku](https://www.heroku.com/) which provides free hosting service. 

Visit [https://intelligent-parking.herokuapp.com/] (https://intelligent-parking.herokuapp.com/) and see what it looks like.
###### It takes time in the beginning because it should be awaken. (free service) 

2. Google Map APIs
===================

** Smart parking ** mainly uses [GoogleMap APIs] (https://developers.google.com/maps/web-services/).
It communicates to Google Map services and abtains locations, routes, geocodes, addresses, etc.


3. Open source libraries
===================================

This appliccation uses open source libraries such as [Bootstrap](http://getbootstrap.com/), [Awesomefonts](http://fontawesome.io/),[Jquery](https://jquery.com/),etc.


4. RBAC (Rule-Based Access Controll)
===================================

This application has 2 user levels: **user** and **admin**
The menu, Searching parking lots is open to the public, which means everybody can use it.
If you sign up, or use the id, 'user', the level of access to the system is **user**. 
This level can manage its own account including my permit as well as automatically store history for the parking lot.
This makes it possible to the application suggests the most preferable parking lot suggestions on each user.

Also, important several features are shown to only **admin** level users. For example, manage destinations and parking lots are only open to **admin** level users.

5. Amazon Web Service 
======================

**Search Items** uses AWS APIs.
