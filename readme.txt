=== all2static ===
Contributors: kubenstein ( https://github.com/kubenstein )
Tags: cache, simple

License: GPLv2 or later

Cache all sites to static html depends on their urls.
== Description ==

In this cache system, caching takes place before start of WordPress machine.
All2static stores cached sites under: wp-content/plugins/all2static/cached/*

Default expriation time is set to 5min.

== Target ==
System is designed for simple, rather static, sites, based on wordPress only couse of nice editor behind


== Installation ==

* Copy plugin to plugins/ directory.
* Add this line to .htaccess file. Remember that rules order matters!
	...
-->	RewriteRule ^index\.php$ wp-content/plugins/all2static/indexReplacer.php [L]	<--
	RewriteRule ^index\.php$ - [L]
	...
