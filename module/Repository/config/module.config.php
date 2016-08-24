<?php

return array(
    'router' => array(
        'routes' => array(
            'repository' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/repository',
                    'defaults' => array(
                        'controller' => 'Repository\Controller\Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'category' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/category[/:action[/:id]]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z0-9_-]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Repository\Controller\Category',
                                'action' => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'paginator' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/page[/:page]',
                                    'constraints' => array(
                                        'page' => '\d+'
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Repository\Controller\Category',
                                        'action' => 'index',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'algorithms' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/algorithms[/:action[/:id]]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '[a-zA-Z0-9_-]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Repository\Controller\Algorithms',
                                'action' => 'index',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'code' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/code[/:action]',
                                    'constraints' => array(
                                        'id' => '[a-zA-Z0-9_-]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Repository\Controller\Code',
                                        'action' => 'index',
                                    ),
                                ),
                            ),
                            'paginator' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/page[/:page]',
                                    'constraints' => array(
                                        'page' => '\d+'
                                    ),
                                    'defaults' => array(
                                        'controller' => 'Repository\Controller\Algorithms',
                                        'action' => 'index',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'Repository\Controller\Index' => Repository\Factory\IndexControllerFactory::class,
            'Repository\Controller\Category' => Repository\Factory\CategoryControllerFactory::class,
            'Repository\Controller\Algorithms' => Repository\Factory\AlgorithmsControllerFactory::class,
            'Repository\Controller\Code' => Repository\Factory\CodeControllerFactory::class,
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'layout/wizard' => __DIR__ . '/../view/layout/layout_wizard.phtml',
            'layout/tables' => __DIR__ . '/../view/layout/layout_table.phtml',
            'repository/index/index' => __DIR__ . '/../view/repository/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            'Repository' => __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
