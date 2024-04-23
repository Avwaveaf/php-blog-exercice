<?php

declare(strict_types=1);

namespace App;

use App\Exception\Container\ContainerException;
use App\Exception\Container\NotFoundException;
use Psr\Container\ContainerInterface;
use ReflectionParameter;
use ReflectionUnionType;

/**
 * Class Container
 * @package App
 */
class Container implements ContainerInterface
{
    /** @var array */
    private array $entries = [];

    /**
     * Retrieve a class instance from the container.
     * @param string $id Identifier of the entry to look for.
     * @return mixed The resolved entry.
     * @throws NotFoundException If the entry is not found.
     */
    public function get(string $id)
    {

        // checking if there is explicit binding
        if ($this->has($id)) {
            $entry = $this->entries[$id];
            
            return $entry($this);
        }

        // if no binding then do some autowiring
        return $this->resolve($id);
    }

    /**
     * Check if the container has a binding for the given identifier.
     * @param string $id Identifier of the entry to look for.
     * @return bool True if the container can resolve the entry, false otherwise.
     */
    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    /**
     * Bind a concrete implementation to an identifier in the container.
     * @param string $id Identifier of the entry.
     * @param callable $concrete The concrete implementation or factory function.
     */
    public function set(string $id, callable $concrete)
    {
        $this->entries[$id] = $concrete;
    }

    /**
     * Implement autowiring PSR-11 using Reflection API
     * @param string $id
     * @throws \App\Exception\Container\ContainerException
     */
    public function resolve(string $id)
    {
        // Inspect the class that we trying to get from container
        $reflectionClass = new \ReflectionClass($id);
            // thhen we check if given class is instantiable
        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException("Error on resolve method: the class {$id} is not instantiable!,
             check whether it is an interface or abstract class. it need to be instantiable!.");
        }
        // inspect the constructor of the class
        $constructors = $reflectionClass->getConstructor();
        if (!$constructors) {
            return new $id;
        }

        // inspect the constructor parameter
        $parameters = $constructors->getParameters();

        if (!$parameters) {
            return new $id;
        }

        // if constructor parameter is a class then try to resolve that class using container
        $depencies = array_map(function (ReflectionParameter $param) use ($id) {
            $name = $param->getName();
            $type = $param->getType();

            // if ther is no type hinted in parameter contstructor
            if (!$type) {
                throw new ContainerException("Error on resolve method!.
                 the class {$id} have class parameter {$name} that don't support type hint.");
            }

            if ($type instanceof ReflectionUnionType) {
                throw new ContainerException("Error on resolve method,
                 the class {$id} have class parameter {$name} that has union type!.");
            }

            if ($type instanceof \ReflectionNamedType && !$type->isBuiltin()) {
                return $this->get($type->getName());
            }

            throw new ContainerException("Error on resolve method,
              the class {$id} have class parameter {$name} that is built-in class!.");
        }, $parameters);

        return $reflectionClass->newInstanceArgs($depencies);
    }
}
