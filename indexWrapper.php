<?php
/**
* WordPress front application wrapper
*/

$filePath = './cached/'.md5($_SERVER['REQUEST_URI'])."_cache";
	if( file_exists( $filePath ) ) {
		if( date('U') - filemtime( $filePath ) < 60 * 5 ) { //5 min
		echo file_get_contents( $filePath );
		exit();
		}
	}


ob_start();



// load orginal wp index file
chdir( realpath( dirname(__FILE__).'/../../../') );
require('index.php');



// caching
chdir( realpath( dirname(__FILE__) ) );
file_put_contents( $filePath, ob_get_contents() );


// flush output
ob_end_flush();
?>
