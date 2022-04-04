<?php
set_error_handler(function($errno, $errstr, $errfile, $errline ){
	throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});

$config = array(
	"debug" => true,
	"app_path" => "http://localhost/inst_avail"
);

extract($config, EXTR_OVERWRITE);


function getHash($input) {
	$options = [
	    'cost' => 12,
	];
	return password_hash($input, PASSWORD_BCRYPT, $options);
}