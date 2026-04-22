<?php

declare(strict_types=1);

namespace App\ContainerApi;

use GuzzleHttp\Client as HttpClient;
use Productsup\CDE\ContainerApi\BaseClient\Client;

class ContainerApiClientFactory
{
    private const int REQUEST_TIMEOUT = 3600;
    private const int CONNECT_TIMEOUT = 30;

    public function __invoke(): Client
    {
        $httpClient = new HttpClient([
            'base_uri'        => 'http://cde-container-api',
            'timeout'         => self::REQUEST_TIMEOUT,
            'connect_timeout' => self::CONNECT_TIMEOUT,
        ]);

        return Client::create($httpClient);
    }
}
