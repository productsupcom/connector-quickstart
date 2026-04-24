<?php

declare(strict_types=1);

namespace App\Export\Service;

use Productsup\CDE\ContainerApi\ContainerApiInterface;

readonly class ExportService
{
    // Replace with your third-party API endpoint
    private const string CHANNEL_API_ENDPOINT = 'https://api.example.com/products';

    public function __construct(
        private ContainerApiInterface $containerApi,
    ) {}

    public function run(): void
    {
        $totalProducts = $this->containerApi->countItemsFromInputFile();
        $this->containerApi->info("Starting export of {$totalProducts} products to channel.");

        $successCount = 0;
        $errorCount = 0;

        foreach ($this->containerApi->yieldFromInputFile() as $product) {
            try {
                $this->sendToChannel($product);
                $successCount++;

                $this->containerApi->appendToFeedbackFile([
                    'id' => $product['id'],
                    'status' => 'success',
                ]);
            } catch (\Throwable $e) {
                $errorCount++;

                $this->containerApi->warning("Failed to export product {$product['id']}: {$e->getMessage()}");

                $this->containerApi->appendToFeedbackFile([
                    'id' => $product['id'],
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ]);
            }
        }

        $this->containerApi->info("Export finished. Success: {$successCount}, errors: {$errorCount}.");

        if ($errorCount > 0) {
            $this->containerApi->sendNotification('warning', "Export completed with {$errorCount} errors out of {$totalProducts} products.");

            return;
        }

        $this->containerApi->sendNotification('success', "Export completed: all {$totalProducts} products exported successfully.");
    }

    /**
     * Send a single product to the third-party channel.
     *
     * Replace this with your real API call — POST to a partner API, upload to a marketplace,
     * push to an advertising platform, etc.
     */
    private function sendToChannel(array $product): void
    {
        // Example: POST the product to the channel's API endpoint
        //
        // $response = $this->httpClient->request('POST', self::CHANNEL_API_ENDPOINT, [
        //     'json' => [
        //         'external_id' => $product['id'],
        //         'title'       => $product['name'],
        //         'price'       => $product['price'],
        //     ],
        // ]);
        //
        // if ($response->getStatusCode() !== 200) {
        //     throw new \RuntimeException("Channel API returned status {$response->getStatusCode()}");
        // }
    }
}