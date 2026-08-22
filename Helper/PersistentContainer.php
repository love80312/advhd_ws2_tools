<?php
namespace Helper;

class PersistentContainer
{
    private array $container = [];

    public function set(string $key, $value): void
    {
        $this->container[$key] = $value;
    }

    public function get(string $key): mixed
    {
        return $this->container[$key] ?? null;
    }

    public function reset(): void
    {
        $this->container = [];
    }
}