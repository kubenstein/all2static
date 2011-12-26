=== all2static ===
Contributors: kubenstein ( https://github.com/kubenstein )
Requires at least: 3.2.1
Tested up to: 3.3
Tags: simple, cache, static, htaccess


Cache all sites to static html depends on their urls.
== Description ==

In this cache system, caching takes place before start of WordPress machine.
All2static stores cached sites under: wp-content/plugins/all2static/cached/*
System is designed for simple, rather static, sites, based on wordPress couse of its awesomeness.


== Installation ==

* Copy plugin to plugins/ directory.
* Add this line to .htaccess file. Remember that rules order matters!
	...
-->	RewriteRule ^index\.php$ wp-content/plugins/all2static/indexWrapper.php [L]	<--
	RewriteRule ^index\.php$ - [L]
	...

  Plugin contains example .htaccess file so check it out.

* make sure cached/ folder is writable


== How to uninstall ==
Since it has been decided not to change .htaccess file automaticly, disabling plugin will NOT disable its functionality. To disable plugin comment this linie in .htaccess file:
...
-->	#RewriteRule ^index\.php$ wp-content/plugins/all2static/indexWrapper.php [L]	<--
	RewriteRule ^index\.php$ - [L]
...


== Frequently Asked Questions ==

For problems visits the [Plugin GitHub](https://github.com/kubenstein/all2static)

== Screenshots ==

1. plugin admin frontend
