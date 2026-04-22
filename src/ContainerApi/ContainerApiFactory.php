<?php

declare(strict_types=1);

namespace App\ContainerApi;

use Productsup\CDE\ContainerApi\BaseClient\Client;
use Productsup\CDE\ContainerApi\ContainerApi;
use Productsup\CDE\ContainerApi\ContainerApiInterface;

readonly class ContainerApiFactory
{
    public function __invoke(Client $containerApiClient): ContainerApiInterface
    {
        return new ContainerApi($containerApiClient);
    }
}
