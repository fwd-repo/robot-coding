<?php

// adding the CSS and JS files

function robot_setup(){
	wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Roboto|Roboto+Condensed|Roboto+Slab');
	wp_enqueue_style('fontawesome', '//use.fontawesome.com/releases/v5.1.0/css/all.css');
	wp_enqueue_style('style', get_stylesheet_uri(), NULL, microtime(), 'all');
	wp_enqueue_script('main', get_theme_file_uri('/js/main.js'), NULL, microtime(), true);
}

add_action('wp_enqueue_scripts', 'robot_setup');

// Adding Theme Support

function robot_init() {
	add_theme_support('post-thumbnails');
	add_theme_support('title-tag');
	add_theme_support('html5',
		array('comment-list', 'comment-form', 'search-form')
	);
}

add_action('after_setup_theme', 'robot_init');

// Projects

function robot_custom_post_type() {
	register_post_type('project',
		array(
			'rewrite' => array('slug' => 'projects'),
			'labels' => array(
				'name' => 'Projects',
				'singular_name' => 'Project',
				'add_new_item' => 'Add New Project',
				'edit_item' => 'Edit Project' 
			),
			'menu-icon' => 'dashicons-clipboard',
			'public' => true,
			'has_archive' => true,
			'supports' => array(
				'title', 'thumbnail', 'editor', 'excerpt', 'comments'
			)
		)
	);
}

add_action('init', 'robot_custom_post_type');

// Sidebar

function robot_widgets() {
	register_sidebar(
		array(
			'name' => 'Main Sidebar',
			'id' => 'main_sidebar',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		)
	);
}

add_action('widgets_init', 'robot_widgets');

// Filters

function search_filter($query) {
	if($query->is_search()){
		$query->set('post_type', array('post', 'project'));
	}
}

add_filter('pre_get_posts', 'search_filter');