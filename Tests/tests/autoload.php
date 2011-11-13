<?php

$vendorDir = __DIR__.'/../../vendor';
require_once $vendorDir.'/symfony/src/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'   => array($vendorDir.'/symfony/src'),
    'Sonata\AdminBundle'   => array($vendorDir),
    'Knp'       => array($vendorDir.'/knpmenu/src'),
    'Gaufrette' => array($vendorDir.'/gaufrette/src'),
    'Symfony\\Cmf'                          => array($vendorDir.'/symfony-cmf/src', $vendorDir.'/bundles'),
    'Symfony\\Bundle\\DoctrinePHPCRBundle'  => array($vendorDir.'/symfony-cmf/src'),
    'Doctrine\\ODM\\PHPCR'                  => array($vendorDir.'/symfony-cmf/vendor/doctrine-phpcr-odm/lib'),
    'Doctrine\\Common'                      => array($vendorDir.'/symfony-cmf/vendor/doctrine-phpcr-odm/lib/vendor/doctrine-common/lib'),
    'Jackalope'                             => array($vendorDir.'/symfony-cmf/vendor/doctrine-phpcr-odm/lib/vendor/jackalope/src'),
    'PHPCR'                                 => array($vendorDir.'/symfony-cmf/vendor/doctrine-phpcr-odm/lib/vendor/jackalope/lib/phpcr/src'),

));
$loader->register();

spl_autoload_register(function($class) {
    if (0 === strpos($class, 'Sonata\\DoctrinePHPCRAdminBundle\\')) {
        $path = __DIR__.'/../../'.implode('/', array_slice(explode('\\', $class), 2)).'.php';
        
        if (!stream_resolve_include_path($path)) {
            return false;
        }
        require_once $path;
        return true;
    }
});
