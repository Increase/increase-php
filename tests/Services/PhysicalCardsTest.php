<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Page;
use Increase\PhysicalCards\PhysicalCard;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class PhysicalCardsTest extends TestCase
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
        $result = $this->client->physicalCards->create(
            cardID: 'card_oubs0hwk5rn6knuecxg2',
            cardholder: ['firstName' => 'Ian', 'lastName' => 'Crease'],
            shipment: [
                'address' => [
                    'city' => 'New York',
                    'line1' => '33 Liberty Street',
                    'name' => 'Ian Crease',
                    'postalCode' => '10045',
                    'state' => 'NY',
                ],
                'method' => 'usps',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PhysicalCard::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->physicalCards->create(
            cardID: 'card_oubs0hwk5rn6knuecxg2',
            cardholder: ['firstName' => 'Ian', 'lastName' => 'Crease'],
            shipment: [
                'address' => [
                    'city' => 'New York',
                    'line1' => '33 Liberty Street',
                    'name' => 'Ian Crease',
                    'postalCode' => '10045',
                    'state' => 'NY',
                    'country' => 'x',
                    'line2' => 'Unit 2',
                    'line3' => 'x',
                    'phoneNumber' => 'x',
                ],
                'method' => 'usps',
                'schedule' => 'next_day',
            ],
            physicalCardProfileID: 'physical_card_profile_id',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PhysicalCard::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->physicalCards->retrieve(
            'physical_card_ode8duyq5v2ynhjoharl'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PhysicalCard::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->physicalCards->update(
            'physical_card_ode8duyq5v2ynhjoharl',
            status: 'disabled'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PhysicalCard::class, $result);
    }

    #[Test]
    public function testUpdateWithOptionalParams(): void
    {
        $result = $this->client->physicalCards->update(
            'physical_card_ode8duyq5v2ynhjoharl',
            status: 'disabled'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PhysicalCard::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->physicalCards->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(PhysicalCard::class, $item);
        }
    }
}
