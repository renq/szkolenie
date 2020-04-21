<?php

declare(strict_types=1);

namespace App\Api\Products;

use GuzzleHttp\Client;

final class ProductsApiClient
{
    /** @var string */
    private $apiUrl;

    public function __construct(string $apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }

    public function createProduct(ProductRequestDto $productRequestDto): ProductResponseDto
    {
        $client = new Client(['base_uri' => $this->apiUrl]);

        $response = $client->request('POST', $this->apiUrl, [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => json_encode([
                'name' => $productRequestDto->getName(),
                'description' => $productRequestDto->getDescription(),
                'image' => $productRequestDto->getImage(),
            ])
        ]);

        $responseJson = json_decode((string)$response->getBody(), true);

        return new ProductResponseDto($responseJson['id']);
    }
}
