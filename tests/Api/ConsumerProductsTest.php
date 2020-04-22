<?php

/** @noinspection PhpUnhandledExceptionInspection */

declare(strict_types=1);

namespace Tests\App\Api;

use App\Api\Products\ProductRequestDto;
use App\Api\Products\ProductResponseDto;
use App\Api\Products\ProductsApiClient;
use PhpPact\Consumer\InteractionBuilder;
use PhpPact\Consumer\Matcher\Matcher;
use PhpPact\Consumer\Model\ConsumerRequest;
use PhpPact\Consumer\Model\ProviderResponse;
use PhpPact\Standalone\MockService\MockServerEnvConfig;
use PHPUnit\Framework\TestCase;

final class ConsumerProductsTest extends TestCase
{
    public function testCreateProduct(): void
    {
        // Arrange
        $matcher = new Matcher();
        $request = new ConsumerRequest();
        $request
            ->setMethod('POST')
            ->setPath('/api/products')
            ->addHeader('Content-Type', 'application/json')
            ->setBody([
                'name' => 'Test product',
                'description' => 'Test product description',
                'image' => 'A product image.jpg'
            ])
        ;

        $response = new ProviderResponse();
        $response
            ->setStatus(200)
            ->addHeader('Content-Type', 'application/json')
            ->setBody([
                'id' => $matcher->term('994dca5b-43d9-4564-9102-14b2f2723470', Matcher::UUID_V4_FORMAT)
            ]);

        $config  = new MockServerEnvConfig();
        $builder = new InteractionBuilder($config);
        $builder
            ->uponReceiving('A POST request to /api/products')
            ->with($request)
            ->willRespondWith($response);

        // Act
        $service = new ProductsApiClient((string)$config->getBaseUri()); // Pass in the URL to the Mock Server.
        $result  = $service->createProduct(new ProductRequestDto(
            'Test product',
            'Test product description',
            'A product image.jpg'
        ));

        // Assert
        $builder->verify();
        $builder->writePact();

        $this->assertEquals(new ProductResponseDto('994dca5b-43d9-4564-9102-14b2f2723470'), $result);
    }
}
