<?php

namespace Tests\Services;

use Increase\AccountTransfers\AccountTransfer;
use Increase\Client;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class AccountTransfersTest extends TestCase
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
    public function testCreate(): void
    {
        $result = $this->client->accountTransfers->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            amount: 100,
            description: 'Creating liquidity',
            destinationAccountID: 'account_uf16sut2ct5bevmq3eh',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AccountTransfer::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->accountTransfers->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            amount: 100,
            description: 'Creating liquidity',
            destinationAccountID: 'account_uf16sut2ct5bevmq3eh',
            requireApproval: true,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AccountTransfer::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->accountTransfers->retrieve(
            'account_transfer_7k9qe1ysdgqztnt63l7n'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AccountTransfer::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->accountTransfers->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(AccountTransfer::class, $item);
        }
    }

    #[Test]
    public function testApprove(): void
    {
        $result = $this->client->accountTransfers->approve(
            'account_transfer_7k9qe1ysdgqztnt63l7n'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AccountTransfer::class, $result);
    }

    #[Test]
    public function testCancel(): void
    {
        $result = $this->client->accountTransfers->cancel(
            'account_transfer_7k9qe1ysdgqztnt63l7n'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AccountTransfer::class, $result);
    }
}
