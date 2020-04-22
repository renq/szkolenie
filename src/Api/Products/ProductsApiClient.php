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

        $response = $client->request('POST', '/api/products', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'name' => $productRequestDto->getName(),
                'description' => $productRequestDto->getDescription(),
                'image' => $productRequestDto->getImage(),
            ]
        ]);

        $json = (string)$response->getBody();
        $responseJson = json_decode($json, true, 512, JSON_THROW_ON_ERROR);

        return new ProductResponseDto($responseJson['id']);
    }
}
