DRKN changelog
==============

Created for the purpose of sharing knowledge between devs. Much like a Wiki. Not all changes should be recorded here but only the major changes that will affect how others work.

Tips
----

* If you like me don't wish to use localhost/drkn you can hardcode the dev url add this to your wp-config:
		
		define('WP_HOME','http://'.$_SERVER['SERVER_NAME']);
		define('WP_SITEURL','http://'.$_SERVER['SERVER_NAME']);


Changes
-------

* Added a theme boilerplate [starkers](https://github.com/viewportindustries/starkers) @babovic feel free to do whatever you like with it. Edit delete put in your own theme etc. Just need something that is avaliable as a starting point for everyone.