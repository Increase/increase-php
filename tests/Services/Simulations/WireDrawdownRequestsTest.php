<?php

namespace Tests\Services\Simulations;

use Increase\Client;
use Increase\WireDrawdownRequests\WireDrawdownRequest;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class WireDrawdownRequestsTest extends TestCase
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
    public function testRefuse(): void
    {
        $result = $this->client->simulations->wireDrawdownRequests->refuse(
            'wire_drawdown_request_q6lmocus3glo0lr2bfv3'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WireDrawdownRequest::class, $result);
    }

    #[Test]
    public function testSubmit(): void
    {
        $result = $this->client->simulations->wireDrawdownRequests->submit(
            'wire_drawdown_request_q6lmocus3glo0lr2bfv3'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(WireDrawdownRequest::class, $result);
    }
}
