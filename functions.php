<?php

define( 'DEFAULT_PROTOCOL', 'http://' );
define( 'HOME_URL', str_replace( "index.php", "", DEFAULT_PROTOCOL . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] ) );
define( 'HOME_URI', dirname( __FILE__ ) );
define( 'PROJECT_BASE', str_replace( $_SERVER['DOCUMENT_ROOT'], "", HOME_URI ) );
define( 'PROJECT_TITLE', 'Simple PHP');

function get_request()
{
	$request = str_replace( PROJECT_BASE, "",$_SERVER['REQUEST_URI'] );
	$params = explode( "/", ltrim( $request, "/" ) );
	return $params;
}

function get_header()
{
	include( HOME_URI.'/header.php');
}

function get_sidebar()
{
	include( HOME_URI.'/sidebar.php');
}

function get_footer()
{
	include( HOME_URI.'/footer.php');
}

function get_content()
{
	$params = get_request();

	$directory = HOME_URI . '/pages';
	
	// better solution?
	$safe_pages = array_diff(scandir($directory, 1), array('..', '.') );
	//$safe_pages = array('contact');

	if( in_array( $params[0].".php", $safe_pages ) ){
		include( HOME_URI . '/pages/'. $params[0].'.php');
	} elseif(empty($params[0])) {
		include( HOME_URI . '/pages/home.php');
	} else {
		echo "404 Not Found";
	}
}

function get_site_url()
{
	return HOME_URL;
}

function site_url()
{
	echo get_site_url();
}

function get_site_title()
{
	return PROJECT_TITLE;
}

function site_title()
{
	echo get_site_title();
}

function auto_copyright( $year = "auto" )
{
	if(intval($year) == "auto"){$year = date('Y');}
	if(intval($year) == date('Y')){ echo intval($year);}
	if(intval($year) < date('Y')){echo intval($year). " - " . date('Y');}
	if(intval($year) > date('Y')){ echo date('Y');}
}
