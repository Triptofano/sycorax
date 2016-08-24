<?php

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'services' => array(
            'Menu/Navigation' => array(
                array(
                    'name' => 'Repositório',
                    'links' => array(
                        array(
                            'header' => array(
                                'name' => 'Categoria',
                            ),
                            'index' => array(
                                'name' => 'Listar',
                                'name_link' => 'category',
                            ),
                            'new' => array(
                                'name' => 'Adicionar',
                                'name_link' => 'category/new',
                            ),
                        ),
                        array(
                            'header' => array(
                                'name' => 'Algoritmos',
                            ),
                            'index' => array(
                                'name' => 'Listar',
                                'name_link' => 'algorithms',
                            ),
                            'new' => array(
                                'name' => 'Adicionar',
                                'name_link' => 'algorithms/new',
                            ),
                        ),
                        array(
                            'header' => array(
                                'name' => 'Código',
                            ),
                            'index' => array(
                                'name' => 'Listar',
                                'name_link' => 'algorithms/code',
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
//        'factories' => array(
//            'general-adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
//            'market-post-form' => Factory\PostFormFactory::class,
//            'market-post-filter' => Factory\PostFilterFactory::class,
//            'listings-table' => Factory\ListingsTableFactory::class,
//        ),
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
            'Application\Controller\Index' => Application\Factory\IndexControllerFactory::class,
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
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            'Application' => __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'leftLinks' => Application\Helper\LeftLinks::class,
            'menuCategory' => Application\Helper\MenuCategory::class,
            'menuNavigation' => Application\Helper\MenuNavigation::class,
        ),
    ),
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
