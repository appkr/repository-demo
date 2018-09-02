<?php

namespace App;

class EmployeeDto implements \JsonSerializable
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
        ];
    }
}
