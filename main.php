<?php
namespace Kodjo;

spl_autoload_register( function($class){
    // Cut root namespace
    $class = str_replace( __NAMESPACE__."\\", "", $class );
    // Correct directory separator
    $class = str_replace( array( "\\", "/" ), DIRECTORY_SEPARATOR, __DIR__.DIRECTORY_SEPARATOR.$class.".php" );
    // Get file real path
	require_once realpath( $class );
} );

$gm = new Logic\GameMaster();
$input = "";
do {
	$input = readline();
	$gm->processInput( $input );
} while( $input != Content\Command::EXIT );
?>