<?php

namespace Gophry;

use \Symfony\Component\HttpFoundation\Request;

use \Silex\Route as BaseRoute;
use \Silex\Application;

use \Gophry\Security\PermissionInterface;

class Route extends BaseRoute {

    public function permit($permission, $resourceIdName = null) {
        return $this->before(function(Request $request, Application $app) use ($permission, $resourceIdName) {
            $permissionObject = is_string($permission) && array_key_exists($app[$permission]) ? $app[$permission] : $permission;
            if (!($permissionObject instanceof PermissionInterface)) {
                $exceptionClass = $app['gophry.internal.server.error.exception.class'];
                throw new $exceptionClass('Invalid permission object');
            }

            $resourceId = $request->attributes->get($resourceIdName);
            if (!$permission->check($request->user, $resourceId)) {
				$exceptionClass = $app['gophry.access.denied.exception.class'];
                throw new $exceptionClass('Access denied');
            }
        });
    }

}
