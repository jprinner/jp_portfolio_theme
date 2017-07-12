<?php

if ( ! class_exists( 'Timber' ) ) {
    add_action( 'admin_notices', function() {
        echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php') ) . '</a></p></div>';
    });
}

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

    function __construct()
    {
        add_theme_support( 'menus' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'html5', array(
            'comment-list',
            'comment-form',
            'search-form',
            'gallery',
            'caption'
        ));

        add_filter( 'timber_context', array( $this, 'add_to_context' ) );

    		add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
    		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));

        add_action( 'widgets_init', array($this,('arphabet_widgets_init')));

        add_action( 'init', array($this,'add_custom_post_type_portfolio' ));

    		register_nav_menus( array(
    			'primary_menu' => 'Primary Menu',
    			'footer_menu' => 'Footer Menu'
    		));

        acf_add_options_page(array(
          'page_title'  => 'Logo',
          'menu_title'  => 'Logo',
          'menu_slug'   => 'logo',
          'capability'  => 'edit_posts',
          'redirect'    => false,
          'menu_icon'  => 'dashicons-format-image'
        ));

        parent::__construct();
    }

    function add_to_context( $context )
  	{
      $context['primary_menu']  = new TimberMenu('primary_menu');
      $context['footer_menu']  = new TimberMenu('footer_menu');
      $context['is_contact_page'] = is_page('contact');
      $context['logo'] = get_fields('options');
      return $context;
    }

  	function enqueue_styles()
  	{
    	wp_enqueue_style('base-stylesheet', get_stylesheet_directory_uri().'/assets/css/style.min.css', array('bootstrap-stylesheet','google-font', 'font-awesome'), '122319c9c4777c');
    	wp_enqueue_style('bootstrap-stylesheet', get_stylesheet_directory_uri().'/assets/css/bootstrap.min.css');
      wp_enqueue_style( 'slick-css',get_stylesheet_directory_uri().'/assets/css/slick.css');
      wp_enqueue_style( 'google-font','//fonts.googleapis.com/css?family=Work+Sans|Forum');
      wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  	}

  	function enqueue_scripts()
  	{
    	wp_enqueue_script('base-script', get_stylesheet_directory_uri().'/assets/js/script.min.js', array('bootstrap-script','jquery'), '8f4cd28363a876');
    	wp_enqueue_script('bootstrap-script', get_stylesheet_directory_uri().'/assets/js/bootstrap.min.js', array( 'jquery'));
      wp_enqueue_script( 'slick-js', "//cdn.jsdelivr.net/jquery.slick/1.3.11/slick.min.js", array('jquery'), '', true );
  	}

    function add_custom_post_type_portfolio()
    {
    $labels = array(
        'name'               => 'Portfolio Items',
        'singular_name'      => 'Portfolio Item',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Portfolio Item',
        'edit_item'          => 'Edit Portfolio Item',
        'new_item'           => 'New Portfolio Item',
        'all_items'          => 'All Portfolio Items',
        'view_item'          => 'View Portfolio Item',
        'search_items'       => 'Search Portfolio Items',
        'not_found'          => 'No Portfolio Items found',
        'not_found_in_trash' => 'No Portfolio Items found in the Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Portfolio Items'
    );

    $args = array(
        'labels'        => $labels,
        'description'   => 'Our Portfolio Items',
        'public'        => true,
        'menu_position' => 5,
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'has_archive'   => true,
        'rewrite' => array('slug' => 'portfolio'),
        'menu_icon'   => 'dashicons-book',
    );

    register_post_type( 'portfolio_item', $args );
    }

	//Function to add widget area
	function arphabet_widgets_init() {

		register_sidebar( array(
			'name'          => 'Blog Sidebar',
			'id'            => 'blog-sidebar',
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="blog-sidebar-title">',
			'after_title'   => '</h2>',
		) );

    register_sidebar( array(
      'name'          => 'Logo',
      'id'            => 'logo',
      'before_widget' => '<div class="widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h2 class="blog-sidebar-title">',
      'after_title'   => '</h2>',
    ) );

    }

}

new StarterSite();