<?php

declare(strict_types=1);

namespace App;

use App\Exception\Container\NotFoundException;
use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $entries=[];
    public function get(string $id)
    {
        if (! $this->has($id)) {
            throw new NotFoundException("class" . $id . " Has no binding");
        }

        $entry = $this->entries[$id];

        return $entry($this);
    }

    public function has(string $id):bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable $concrete)
    {
        $this->entries[$id] = $concrete;
    }
}