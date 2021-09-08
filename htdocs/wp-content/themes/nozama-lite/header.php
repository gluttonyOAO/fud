<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	// TODO: Replace with a simple call to wp_body_open() once WordPress 5.3 is released.
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
?>

<div id="page">

	<?php nozama_lite_header(); ?>

	<div id="mobilemenu"><ul></ul></div>
