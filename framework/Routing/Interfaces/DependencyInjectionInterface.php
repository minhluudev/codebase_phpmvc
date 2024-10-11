<?php

namespace Framework\Routing\Interfaces;

interface DependencyInjectionInterface
{
    public static function resolveDependencies(mixed $objectOrClass): array;
}