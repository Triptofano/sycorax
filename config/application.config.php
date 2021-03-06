<?php
return array(
    'modules' => array(
        'Base',
        'Application',
        'Repository',
        'ZendDeveloperTools',
    ),

    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
        ),

        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),

        // Whether or not to enable a configuration cache.
        // If enabled, the merged configuration will be cached and used in
        // subsequent requests.
        'config_cache_enabled' => false, # \TODO: ativar novamente apos finalização do dev

        // The key used to create the configuration cache file name.
        'config_cache_key' => '1e63780d6cd932e43688284081351f1abe941dbe',

        // Whether or not to enable a module class map cache.
        // If enabled, creates a module class map cache which will be used
        // by in future requests, to reduce the autoloading process.
        'module_map_cache_enabled' => false, # \TODO: ativar novamente apos finalização do dev

        // The key used to create the class map cache file name.
        'module_map_cache_key' => '1e63780d6cd932e43688284081351f1abe941dbe',

        // The path in which to cache merged configuration.
        'cache_dir' => 'data/cache',
    ),

);
