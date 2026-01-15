<?php

namespace Tests\Services;

use Increase\Cards\Card;
use Increase\Cards\CardDetails;
use Increase\Cards\CardIframeURL;
use Increase\Client;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class CardsTest extends TestCase
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
        $result = $this->client->cards->create(
            accountID: 'account_in71c4amph0vgo2qllky'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Card::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->cards->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            billingAddress: [
                'city' => 'x',
                'line1' => 'x',
                'postalCode' => 'x',
                'state' => 'x',
                'line2' => 'x',
            ],
            description: 'Card for Ian Crease',
            digitalWallet: [
                'digitalCardProfileID' => 'digital_card_profile_id',
                'email' => 'dev@stainless.com',
                'phone' => 'x',
            ],
            entityID: 'entity_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Card::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->cards->retrieve('card_oubs0hwk5rn6knuecxg2');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Card::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->cards->update('card_oubs0hwk5rn6knuecxg2');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Card::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->cards->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Card::class, $item);
        }
    }

    #[Test]
    public function testCreateDetailsIframe(): void
    {
        $result = $this->client->cards->createDetailsIframe(
            'card_oubs0hwk5rn6knuecxg2'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardIframeURL::class, $result);
    }

    #[Test]
    public function testDetails(): void
    {
        $result = $this->client->cards->details('card_oubs0hwk5rn6knuecxg2');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardDetails::class, $result);
    }

    #[Test]
    public function testUpdatePin(): void
    {
        $result = $this->client->cards->updatePin(
            'card_oubs0hwk5rn6knuecxg2',
            pin: '1234'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardDetails::class, $result);
    }

    #[Test]
    public function testUpdatePinWithOptionalParams(): void
    {
        $result = $this->client->cards->updatePin(
            'card_oubs0hwk5rn6knuecxg2',
            pin: '1234'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardDetails::class, $result);
    }
}
