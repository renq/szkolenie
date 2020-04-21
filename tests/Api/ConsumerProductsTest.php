<?php

declare(strict_types=1);

namespace Api;

use App\Api\Products\ProductRequestDto;
use App\Api\Products\ProductResponseDto;
use App\Api\Products\ProductsApiClient;
use Consumer\Service\HttpClientService;
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
        $matcher = new Matcher();

        $request = new ConsumerRequest();
        $request
            ->setMethod('POST')
            ->setPath('/api/products')
            ->addHeader('Content-Type', 'application/json')
            ->setBody(json_encode([
                'name' => 'Test product',
                'description' => 'Test product description',
                'image' => 'A product image.jpg'
            ], JSON_THROW_ON_ERROR, 512))
        ;

        $response = new ProviderResponse();
        $response
            ->setStatus(200)
            ->addHeader('Content-Type', 'application/json')
            ->setBody([
                'id' => '994dca5b-43d9-4564-9102-14b2f2723470'
            ]);

        // Create a configuration that reflects the server that was started. You can create a custom MockServerConfigInterface if needed.
        $config  = new MockServerEnvConfig();
        $builder = new InteractionBuilder($config);
        $builder
            ->uponReceiving('A get request to /api/products')
            ->with($request)
            ->willRespondWith($response); // This has to be last. This is what makes an API request to the Mock Server to set the interaction.

        $service = new ProductsApiClient((string)$config->getBaseUri()); // Pass in the URL to the Mock Server.
        $result  = $service->createProduct(new ProductRequestDto(
            'Test product',
            'Test product description',
            'A product image.jpg'
        ));

        $builder->verify(); // This will verify that the interactions took place.

        $this->assertEquals(new ProductResponseDto('994dca5b-43d9-4564-9102-14b2f2723470'), $result); // Make your assertions.
    }
}