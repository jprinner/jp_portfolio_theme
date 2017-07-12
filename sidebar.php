<?php
/**
 * The Template for displaying all single posts
 *
 *
 * @package  WordPress
 * @subpackage  Timber
 */
 if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('blog-sidebar') ) : endif;
$context = array();
$context['dynamic_sidebar'] = get_sidebar();

Timber::render('sidebar.twig', $context);

