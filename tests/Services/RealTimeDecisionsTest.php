<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\RealTimeDecisions\RealTimeDecision;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class RealTimeDecisionsTest extends TestCase
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
    public function testRetrieve(): void
    {
        $result = $this->client->realTimeDecisions->retrieve(
            'real_time_decision_j76n2e810ezcg3zh5qtn'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RealTimeDecision::class, $result);
    }

    #[Test]
    public function testAction(): void
    {
        $result = $this->client->realTimeDecisions->action(
            'real_time_decision_j76n2e810ezcg3zh5qtn'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RealTimeDecision::class, $result);
    }
}
