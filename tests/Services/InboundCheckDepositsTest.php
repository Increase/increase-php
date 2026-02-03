<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\InboundCheckDeposits\InboundCheckDeposit;
use Increase\Page;
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
    public function testRetrieve(): void
    {
        $result = $this->client->inboundCheckDeposits->retrieve(
            'inbound_check_deposit_zoshvqybq0cjjm31mra'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundCheckDeposit::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->inboundCheckDeposits->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(InboundCheckDeposit::class, $item);
        }
    }

    #[Test]
    public function testDecline(): void
    {
        $result = $this->client->inboundCheckDeposits->decline(
            'inbound_check_deposit_zoshvqybq0cjjm31mra'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundCheckDeposit::class, $result);
    }

    #[Test]
    public function testReturn(): void
    {
        $result = $this->client->inboundCheckDeposits->return(
            'inbound_check_deposit_zoshvqybq0cjjm31mra',
            reason: 'altered_or_fictitious',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundCheckDeposit::class, $result);
    }

    #[Test]
    public function testReturnWithOptionalParams(): void
    {
        $result = $this->client->inboundCheckDeposits->return(
            'inbound_check_deposit_zoshvqybq0cjjm31mra',
            reason: 'altered_or_fictitious',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundCheckDeposit::class, $result);
    }
}
