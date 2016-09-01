<?php
// Import DB
echo "Importing database with wp-cli...\n";
$doc_root = $_SERVER['DOCUMENT_ROOT'];
// If using nested docroot go up a directory
if( 'web' === substr($doc_root, -3) ){
	$doc_root = dirname( $doc_root );
}
$db_file = $doc_root . '/loopconf-customizer-workshop-init-9-1-16.sql';

if( file_exists($db_file) ){
	echo "Importing database from $db_file\n";
	passthru( 'wp db import ' . $db_file );
	echo "Database import complete.\n\n";
} else{
	echo "The database file $db_file doesn't exist! Exiting.\n";
	exit();
}

// Scrub URLs
echo "Running URL replacement with wp-cli...\n";
$old_url = 'https://customizer-workshop.dev';
$new_url = 'https://' . $_ENV['PANTHEON_ENVIRONMENT'] . '-' . $_ENV['PANTHEON_SITE_NAME'] . '.pantheonsite.io';
echo "Changing $old_url to $new_url\n";
passthru( 'wp search-replace \'' . $old_url . '\' \'' . $new_url . '\' wp_posts wp_options' );
echo "URL replacement complete.\n\n";