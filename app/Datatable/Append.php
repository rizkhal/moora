<?php

namespace App\Datatable;

class Append
{
    public $formatCallback;

    public function __construct(
        private string $key
    ) {
        // 
    }

    public static function make(string $key): Append
    {
        return new static($key);
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function format(callable $callback = null)
    {
        $this->formatCallback = $callback;

        return $this;
    }

    public function hasFormatCallback(): bool
    {
        return $this->formatCallback !== null;
    }

    public function getFormatCallback(): callable|null
    {
        return $this->formatCallback;
    }
}
