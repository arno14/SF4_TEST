<?php

/** @var Symfony\Component\DependencyInjection\ContainerBuilder $container */

$toolbarIsEnabled = (bool)getenv('SF_PROFILER_TOOLBAR');
$container->loadFromExtension('web_profiler', [
    'toolbar'=> $toolbarIsEnabled 
]);