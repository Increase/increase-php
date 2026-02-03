<?php

namespace Tests\Services\Simulations;

use Increase\Client;
use Increase\Core\Util;
use Increase\InboundCheckDeposits\InboundCheckDeposit;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class InboundCheckDepositsTest extends TestCase
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
    public function testCreate(): void
    {
        $result = $this->client->simulations->inboundCheckDeposits->create(
            accountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            amount: 1000,
            checkNumber: '1234567890',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundCheckDeposit::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->simulations->inboundCheckDeposits->create(
            accountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            amount: 1000,
            checkNumber: '1234567890',
            payeeNameAnalysis: 'name_matches',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundCheckDeposit::class, $result);
    }
}
