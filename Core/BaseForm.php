<?php

namespace Core;

abstract class BaseForm
{
    protected array $errors = [];

    public function __construct(public array $attributes)
    {
        $this->validateAttributes($attributes);
    }

    abstract protected function validateAttributes(array $attributes): void;

    public static function validate($attributes)
    {
        $instance = new static($attributes);
        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function throw()
    {
        ValidationException::throw($this->errors, $this->attributes);
    }

    public function failed(): bool
    {
        return !empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function error(string $field, string $message): static
    {
        $this->errors[$field] = $message;
        return $this;
    }
}
