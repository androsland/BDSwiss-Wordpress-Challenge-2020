<?php

/**
 * Header file for the BDSwiss Wordpress Challenge 2020.
 */

?>
<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php
	wp_body_open();
	?>

	<header class="header" role="banner">

		<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/bdswiss-logo-dark.png" alt="BDSwiss logo">

	</header>