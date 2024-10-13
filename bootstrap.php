<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

require_once __DIR__ . '/vendor/autoload.php';

// Initialize the Symfony container
$containerBuilder = new ContainerBuilder();

// Load services configuration from YAML
$loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__ . '/config'));
$loader->load('services.yaml');

// Compile the container
$containerBuilder->compile();

// Get services with 'wordpress.action' or 'wordpress.filter' tag
foreach ($containerBuilder->findTaggedServiceIds('wordpress.action') as $id => $tags) {
    foreach ($tags as $attributes) {
        add_action($attributes['hook'], [$containerBuilder->get($id), $attributes['method']]);
    }
}

foreach ($containerBuilder->findTaggedServiceIds('wordpress.filter') as $id => $tags) {
    foreach ($tags as $attributes) {
        add_filter($attributes['hook'], [$containerBuilder->get($id), $attributes['method']]);
    }
}