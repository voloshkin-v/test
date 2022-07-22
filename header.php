<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Test</title>
	<?php wp_head(); ?>
</head>
<body>
	<header class="main-header">
		<div class="container main-header__container">
			<?php
				if ( ! empty ($logo = get_field( 'logo', 'option' ) ) ) {
					?>
						<a href="<?php echo get_home_url(); ?>" class="main-header__logo">
							<img src="<?php echo $logo; ?>" alt="logo">
						</a>
					<?
				}
			?>

			<?php
				wp_nav_menu( [
					'menu'            => 'Header Menu',
					'container'       => 'nav',
					'container_class' => 'main-header__menu',
					'menu_class'      => 'menu',
					'echo'            => true,
					'fallback_cb'     => '__return_empty_string',
					'items_wrap'      => '<ul class="menu">%3$s</ul>',
				] );
			?>
		</div>
	</header>