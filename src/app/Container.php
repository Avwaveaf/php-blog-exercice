<?php

declare(strict_types=1);

namespace App;

use App\Exception\Container\NotFoundException;
use Psr\Container\ContainerInterface;

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
        if (! $this->has($id)) {
            throw new NotFoundException("Class {$id} has no binding");
        }

        $entry = $this->entries[$id];

        return $entry($this);
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
}
