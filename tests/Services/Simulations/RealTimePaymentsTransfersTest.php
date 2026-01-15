<?php

namespace Tests\Services\Simulations;

use Increase\Client;
use Increase\RealTimePaymentsTransfers\RealTimePaymentsTransfer;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class RealTimePaymentsTransfersTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testComplete(): void
    {
        $result = $this->client->simulations->realTimePaymentsTransfers->complete(
            'real_time_payments_transfer_iyuhl5kdn7ssmup83mvq'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RealTimePaymentsTransfer::class, $result);
    }
}
