<?php

declare(strict_types=1);

namespace App\DataSource\Domain\Model;

final readonly class Product
{
    public function __construct(
        public string $id,
        public string $name,
        public string $price,
    ) {}

    public function toArray(): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'price' => $this->price,
        ];
    }
}
