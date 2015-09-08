<?php
return array(
    // This should be an array of module namespaces used in the application.
    'modules' => array(
        'Application',
        'DoctrineModule',
        'DoctrineORMModule',
    ),
    // These are various options for the listeners attached to the ModuleManager
    'module_listener_options' => array(
        // This should be an array of paths in which modules reside.
        // If a string key is provided, the listener will consider that a module
        // namespace, the value of that key the specific path to that module's
        // Module class.
        'module_paths' => array(
            './module',
            './vendor',
        ),
        // An array of paths from which to glob configuration files after
        // modules are loaded. These effectively override configuration
        // provided by modules themselves. Paths may use GLOB_BRACE notation.
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        // cache storage location
        'cache_dir' => 'data/cache',
        // Config cache setup
        'config_cache_enabled' => (!getenv('APPLICATION_ENV') === 'development'),
        'config_cache_key' => 'zf2-config',
        // Module cache setup
        'module_map_cache_enabled' => (!getenv('APPLICATION_ENV') === 'development'),
        'module_map_cache_key' => 'zf2-module',
        // check module dependencies setup
        'check_dependencies' => (getenv('APPLICATION_ENV') === 'development'),
    ),
);
////update
