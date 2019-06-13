<?php
namespace Dino\play;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

require __DIR__.'/../vendor/autoload.php';
$container = new ContainerBuilder();

$handle = new StreamHandler(__DIR__.'/dino.log');
$container->set('logger.stream_handle',$handle);

$loggerDefinition = new Definition('Monolog\Logger');
$loggerDefinition->setArguments(array(
    'main',
    array(new Reference('logger.stream_handle'))
));
$loggerDefinition->addMethodCall('debug',array(
    'The logger just got started'
));
$container->setDefinition('logger',$loggerDefinition);


$handleDefinition = new Definition('Monolog\Handler\StreamHandler');
$handleDefinition->setArguments(array(
    __DIR__.'/dino.log'
));

$container->setDefinition('logger.stream_handle',$handleDefinition);


//$logger = new Logger('main',array($container->get('logger.stream_handle')));
//$container->set('logger',$handleDefinition);


runApp($container);
function runApp(ContainerBuilder $builder){
    $builder->get('logger')->info('AAAA');
}
