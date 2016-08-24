<?php

use Zend\Log\Logger;
use Zend\Log\Writer\Stream as LogWriterStream;
use Zend\Log\Formatter\Xml as FormatterXML;
use Base\Service\ErrorHandling as ErrorHandling;

return array(
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            'ErrorHandling' => function($sm) {
                $logger = $sm->get('ZendLog');
                $service = new ErrorHandling($logger);
                return $service;
            },
            'ZendLog' => function ($sm) {
                $filename = 'log_' . date('d-m-Y') . '.xml';
                $formatter = new FormatterXML();

                $writer = new LogWriterStream('./data/logs/' . $filename);
                $writer->setFormatter($formatter);

                $log = new Logger();
                $log->addWriter($writer);

                return $log;
            },
        ),
        'aliases' => array(
            'db' => 'Zend\Db\Adapter\Adapter',
        ),
//        'db' => array(
//            'driver' => 'pdo',
//            'dsn' => 'mysql:dbname=sycorax;host=localhost',
//            'username' => 'user',
//            'password' => 'pass',
//            'driver_options' => array(
//                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
//                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
//            ),
//        ),
    ),
);
