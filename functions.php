<?php
	// Echo Var Dump
	function pr_r($var) {
		static $int=0;
		echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
		print_r($var);
		echo '</pre>';
		$int++;
	}

	function pr_v($var) {
		static $int=0;
		echo '<pre><b style="background: blue;padding: 1px 5px;">'.$int.'</b> ';
		var_dump($var);
		echo '</pre>';
		$int++;
	}

	// Add theme support
	add_action( 'after_setup_theme', function() {
		add_theme_support( 'post-thumbnails' );
	});

	// register styles and scripts
	add_action( 'wp_enqueue_scripts', 'test_styles' );
	add_action( 'wp_enqueue_scripts', 'test_scripts' );


	function test_styles() {
		wp_enqueue_style( 'test-style', get_stylesheet_uri() );
	}

	function test_scripts (){
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'test-scripts', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), null, true);

		wp_localize_script( 'test-scripts', 'myOptions', array(
			'ajaxUrl' => admin_url('admin-ajax.php')
		) );
	}

	// Options Theme
	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page(array(
			'page_title' 	=> 'Option Theme for Test project.',
			'menu_title' 	=> 'Option Theme',
			'menu_slug' 	=> 'my-general-option',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		));

		acf_add_options_page(array(
            'page_title'  => __('General posts setting.'),
            'menu_title'  => __('Posts settings'),
			'menu_slug' 	=> 'general-posts-setting',
            'parent_slug' => 'edit.php',
        ));

		acf_add_options_page(array(
            'page_title'  => __('General Job Setting.'),
            'menu_title'  => __('Job Settings'),
			'menu_slug' 	=> 'general-job-setting',
            'parent_slug' => 'edit.php?post_type=job',
        ));
	}

	// Menu
	add_action( 'after_setup_theme', 'theme_register_nav_menu' );

	function theme_register_nav_menu() {
		register_nav_menu( 'primary', 'Primary Menu' );
	}

	// Custom post type

	add_action( 'init', 'create_taxonomy' );
	add_action( 'init', 'register_post_types' );

	function register_post_types() {
		register_post_type( 'job', [
			'labels' => [
				'name'               => 'Job',
				'singular_name'      => 'Job',
				'add_new'			 => 'Add new Job',
				'add_new_item'       => 'New',
				'menu_name'          => 'Job',
			],
			'taxonomies'	 	  => array( 'job_offers' ),
			'public'              => true,
			'has_archive'         => true,
			'menu_position' 	  => 5,
			'menu_icon'			  => 'dashicons-admin-users',
			'supports' 			  => ['title', 'excerpt', 'editor', 'thumbnail', 'custom-fields']
		] );
	}

	function create_taxonomy(){
		register_taxonomy( 'job_offers', [ 'job' ], [
			'labels'                => [
				'name'              => 'Job Offers',
				'singular_name'     => 'Job Offer',
				'search_items'      => 'Search Job Offer',
				'all_items'         => 'All Job Offers',
				'view_item '        => 'View Job Offer',
				'parent_item'       => 'Parent Job Offer',
				'parent_item_colon' => 'Parent Job Offer:',
				'edit_item'         => 'Edit Job Offer',
				'update_item'       => 'Update Job Offer',
				'add_new_item'      => 'Add New Job Offer',
				'new_item_name'     => 'New Job Offer Name',
				'menu_name'         => 'Job Offers',
				'back_to_items'     => '← Back to Job Offers',
			],
			'hierarchical'          => true,
			'rewrite'               => array( 'slug' => 'joboffers' ),
			'query_var'				=> true,
			'all_items'				=> 'job_offers',
			'show_in_rest'          => true,
			'show_admin_column'		=> true,
			'singular_label'		=> 'job_offer'
		] );
	}

	// LOAD MORE
	add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
	add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');

	function load_posts_by_ajax_callback() {
		$paged = $_POST['page'];
		$term = $_POST['term_name'];

		$args = [
			'paged' => $paged,
			'category_name' => $term
		];

		$my_posts = new WP_Query($args);

		if ( $my_posts->have_posts() ) {
			while ( $my_posts->have_posts() ) {
				$my_posts->the_post();

				get_template_part('template-parts/post-grid');
			}
		}

		wp_die();
	}
?>