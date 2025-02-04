<?php

namespace Hybridly\Concerns;

use Hybridly\Support\Hybridable;
use Illuminate\Contracts\Support\Arrayable;

trait HasPersistentProperties
{
    protected array $persistent = [];

    /**
     * Marks the given properties as persisted, which means they will
     * always be present, even in partial hybrid responses.
     */
    public function persist(string|array|Arrayable $properties): static
    {
        if (\is_array($properties)) {
            $this->persistent = array_merge($this->persistent, $properties);
        } elseif ($properties instanceof Hybridable) {
            $this->persistent = array_merge($this->persistent, $properties->toHybridArray());
        } elseif ($properties instanceof Arrayable) {
            $this->persistent = array_merge($this->persistent, $properties->toArray());
        } else {
            $this->persistent[] = $properties;
        }

        return $this;
    }

    /**
     * Gets data being persisted.
     */
    public function persisted(): array
    {
        return $this->persistent;
    }
}
