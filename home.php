<?php
$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$context['sidebar'] = Timber::get_sidebar('sidebar.php');

Timber::render( 'home.twig', $context );