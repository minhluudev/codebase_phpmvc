<?php

namespace Framework\Routing;

use Framework\Routing\Interfaces\DependencyInjectionInterface;
use ReflectionClass;
use ReflectionException;

/**
 * Class DependencyInjection
 *
 * This class is responsible for dependency injection.
 *
 * @package Framework\Routing
 */
class DependencyInjection implements DependencyInjectionInterface
{

    /**
     * Resolve the dependencies.
     *
     * This method resolves the dependencies of the object or class passed to it.
     *
     * @param mixed $objectOrClass The object or class to resolve the dependencies of.
     *
     * @return array
     * @throws ReflectionException
     */
    public static function resolveDependencies(mixed $objectOrClass): array
    {
        $dependencies = [];
        $reflection = new ReflectionClass($objectOrClass);

        if (!$reflection->isInstantiable()) {
            return [];
        }

        $constructor = $reflection->getConstructor();
        $params = $constructor->getParameters();

        foreach ($params as $param) {
            $type = (string)$param->getType();
            if ($type && class_exists($type)) {
                $dependencies[] = new $type();
            }
        }

        return $dependencies;
    }
}