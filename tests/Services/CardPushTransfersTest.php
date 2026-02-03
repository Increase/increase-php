<?php

namespace Tests\Services;

use Increase\CardPushTransfers\CardPushTransfer;
use Increase\Client;
use Increase\Core\Util;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class CardPushTransfersTest extends TestCase
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
        $result = $this->client->cardPushTransfers->create(
            businessApplicationIdentifier: 'funds_disbursement',
            cardTokenID: 'outbound_card_token_zlt0ml6youq3q7vcdlg0',
            merchantCategoryCode: '1234',
            merchantCityName: 'New York',
            merchantName: 'Acme Corp',
            merchantNamePrefix: 'Acme',
            merchantPostalCode: '10045',
            merchantState: 'NY',
            presentmentAmount: ['currency' => 'USD', 'value' => '1234.56'],
            recipientName: 'Ian Crease',
            senderAddressCity: 'New York',
            senderAddressLine1: '33 Liberty Street',
            senderAddressPostalCode: '10045',
            senderAddressState: 'NY',
            senderName: 'Ian Crease',
            sourceAccountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardPushTransfer::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->cardPushTransfers->create(
            businessApplicationIdentifier: 'funds_disbursement',
            cardTokenID: 'outbound_card_token_zlt0ml6youq3q7vcdlg0',
            merchantCategoryCode: '1234',
            merchantCityName: 'New York',
            merchantName: 'Acme Corp',
            merchantNamePrefix: 'Acme',
            merchantPostalCode: '10045',
            merchantState: 'NY',
            presentmentAmount: ['currency' => 'USD', 'value' => '1234.56'],
            recipientName: 'Ian Crease',
            senderAddressCity: 'New York',
            senderAddressLine1: '33 Liberty Street',
            senderAddressPostalCode: '10045',
            senderAddressState: 'NY',
            senderName: 'Ian Crease',
            sourceAccountNumberID: 'account_number_v18nkfqm6afpsrvy82b2',
            requireApproval: true,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardPushTransfer::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->cardPushTransfers->retrieve(
            'outbound_card_push_transfer_e0z9rdpamraczh4tvwye'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardPushTransfer::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->cardPushTransfers->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(CardPushTransfer::class, $item);
        }
    }

    #[Test]
    public function testApprove(): void
    {
        $result = $this->client->cardPushTransfers->approve(
            'outbound_card_push_transfer_e0z9rdpamraczh4tvwye'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardPushTransfer::class, $result);
    }

    #[Test]
    public function testCancel(): void
    {
        $result = $this->client->cardPushTransfers->cancel(
            'outbound_card_push_transfer_e0z9rdpamraczh4tvwye'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardPushTransfer::class, $result);
    }
}
