<?php

namespace Tests\Services\Simulations;

use Increase\Client;
use Increase\Core\Util;
use Increase\FednowTransfers\FednowTransfer;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class FednowTransfersTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testComplete(): void
    {
        $result = $this->client->simulations->fednowTransfers->complete(
            'fednow_transfer_4i0mptrdu1mueg1196bg'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FednowTransfer::class, $result);
    }
}
