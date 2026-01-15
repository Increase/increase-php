<?php

namespace Tests\Services\Simulations;

use Increase\CardDisputes\CardDispute;
use Increase\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class CardDisputesTest extends TestCase
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
    public function testAction(): void
    {
        $result = $this->client->simulations->cardDisputes->action(
            'card_dispute_h9sc95nbl1cgltpp7men',
            network: 'visa'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardDispute::class, $result);
    }

    #[Test]
    public function testActionWithOptionalParams(): void
    {
        $result = $this->client->simulations->cardDisputes->action(
            'card_dispute_h9sc95nbl1cgltpp7men',
            network: 'visa',
            visa: [
                'action' => 'accept_user_submission',
                'acceptChargeback' => [],
                'acceptUserSubmission' => [],
                'declineUserPrearbitration' => [],
                'receiveMerchantPrearbitration' => [],
                'represent' => [],
                'requestFurtherInformation' => ['reason' => 'x'],
                'timeOutChargeback' => [],
                'timeOutMerchantPrearbitration' => [],
                'timeOutRepresentment' => [],
                'timeOutUserPrearbitration' => [],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardDispute::class, $result);
    }
}
