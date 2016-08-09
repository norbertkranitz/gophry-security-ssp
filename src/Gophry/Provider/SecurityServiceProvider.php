<?php

namespace Gophry\Provider;

use \Pimple\Container;
use \Pimple\ServiceProviderInterface;

use \Gophry\Core\AccessDeniedException;
use \Gophry\Core\InternalServerErrorException;

class SecurityServiceProvider implements ServiceProviderInterface {
    
    public function register(Container $app) {
        $app['route_class'] = '\\Gophry\\Route';
        $app['gophry.access.denied.exception.class'] = AccessDeniedException::class;
        $app['gophry.internal.server.error.exception.class'] = InternalServerErrorException::class;
    }
    
}