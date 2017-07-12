<?php

$context = Timber::get_context();

$context['portfolio_items'] = Timber::get_posts();

Timber::render('archive-portfolio_item.twig', $context );

