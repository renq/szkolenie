<?php

declare(strict_types=1);

namespace Tests\App\Server;

use GuzzleHttp\Psr7\Uri;
use PhpPact\Standalone\Installer\Exception\FileDownloadFailureException;
use PhpPact\Standalone\Installer\Exception\NoDownloaderFoundException;
use PhpPact\Standalone\ProviderVerifier\Model\VerifierConfig;
use PhpPact\Standalone\ProviderVerifier\Verifier;
use PhpPact\Standalone\Runner\ProcessRunner;
use PHPUnit\Framework\TestCase;

class PactVerifyTest extends TestCase
{
    /** @var ProcessRunner */
    private $processRunner;

    protected function setUp(): void
    {
        $publicPath    =  __DIR__ . '/../../src/Server/index.php';

        $this->processRunner = new ProcessRunner('php', ['-S', 'localhost:7202', $publicPath]);

        $this->processRunner->run();
    }

    /**
     * Stop the web server process once complete.
     */
    protected function tearDown(): void
    {
        $this->processRunner->stop();
    }

    /**
     * This test will run after the web server is started.
     *
     * @throws FileDownloadFailureException
     * @throws NoDownloaderFoundException
     */
    public function testPactVerifyConsumer(): void
    {
        $config = new VerifierConfig();
        $config
            ->setProviderName('someProvider') // Providers name to fetch.
            ->setProviderVersion('1.0.1') // Providers version.
            ->setProviderBaseUrl(new Uri('http://localhost:7202')) // URL of the Provider.
            ->setBrokerUri(new Uri(getenv('PACT_BROKER_URI')))
            ->setPublishResults(true)
        ;

        // Verify that the Consumer 'someConsumer' that is tagged with 'master' is valid.
        $verifier = new Verifier($config);
        $verifier->verifyAll();
//        $verifier->verifyFiles([__DIR__ . '/../../pact/someconsumer-someprovider.json']);

        $this->assertTrue(true, 'Pact Verification has failed.');
    }
}
