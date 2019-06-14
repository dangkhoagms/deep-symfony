<?php
namespace Dino\play;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

require __DIR__.'/../vendor/autoload.php';
$container = new ContainerBuilder();
$container->setParameter('root_dir',__DIR__);

$start = microtime(true);

$loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/config'));
$loader->load('services.yml');

$container->compile();
runApp($container);

$elapsed = round((microtime(true) - $start) * 1000);
$container->get('logger')->debug('Elapsed Time: '.$elapsed.'ms');

function runApp(ContainerBuilder $builder){
    $builder->get('logger')->info('AAAA');
}
