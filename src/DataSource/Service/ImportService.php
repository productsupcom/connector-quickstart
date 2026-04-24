<?php

declare(strict_types=1);

namespace App\DataSource\Service;

use Productsup\CDE\ContainerApi\ContainerApiInterface;

readonly class ImportService
{
    public function __construct(
        private ContainerApiInterface $containerApi,
    ) {}

    public function run(): void
    {
        $this->containerApi->info('Starting product import.');

        // Replace this with your real data source — an API call, file read, database query, etc.
        $products = [
            ['id' => '1', 'name' => 'Product A', 'price' => '9.99'],
            ['id' => '2', 'name' => 'Product B', 'price' => '19.99'],
            ['id' => '3', 'name' => 'Product C', 'price' => '29.99'],
        ];

        $this->containerApi->appendManyToOutputFile($products);

        $this->containerApi->info('Imported ' . \count($products) . ' products.');

        // Notify the end-user in the Productsup notification panel
        $this->containerApi->sendNotification('success', 'Import completed: ' . \count($products) . ' products imported.');
    }
}