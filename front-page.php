<?php
$context = Timber::get_context();

$context['blog_feed'] = Timber::get_posts(array(
  'numberposts' => 3,
  'order'=> 'ASC',
  'orderby' => 'title'
));

$context['portfolio_slider'] = get_field('portfolio_slider');

Timber::render( 'front-page.twig', $context );
