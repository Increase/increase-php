<?php

namespace Tests\Services\Simulations;

use Increase\Client;
use Increase\Core\Util;
use Increase\Simulations\CardAuthorizations\CardAuthorizationNewResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class CardAuthorizationsTest extends TestCase
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
        $result = $this->client->simulations->cardAuthorizations->create(
            amount: 1000
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardAuthorizationNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->simulations->cardAuthorizations->create(
            amount: 1000,
            authenticatedCardPaymentID: 'authenticated_card_payment_id',
            cardID: 'card_oubs0hwk5rn6knuecxg2',
            declineReason: 'account_closed',
            digitalWalletTokenID: 'digital_wallet_token_id',
            eventSubscriptionID: 'event_subscription_001dzz0r20rcdxgb013zqb8m04g',
            merchantAcceptorID: '5665270011000168',
            merchantCategoryCode: '5734',
            merchantCity: 'New York',
            merchantCountry: 'US',
            merchantDescriptor: 'AMAZON.COM',
            merchantState: 'NY',
            networkDetails: ['visa' => ['standInProcessingReason' => 'issuer_error']],
            networkRiskScore: 0,
            physicalCardID: 'physical_card_id',
            processingCategory: [
                'category' => 'account_funding',
                'refund' => ['originalCardPaymentID' => 'original_card_payment_id'],
            ],
            terminalID: 'x',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardAuthorizationNewResponse::class, $result);
    }
}
