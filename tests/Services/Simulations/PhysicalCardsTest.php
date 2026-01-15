<?php

namespace Tests\Services\Simulations;

use Increase\Client;
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
        $result = $this->client->simulations->physicalCards->create(
            'physical_card_ode8duyq5v2ynhjoharl',
            category: 'delivered'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PhysicalCard::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->simulations->physicalCards->create(
            'physical_card_ode8duyq5v2ynhjoharl',
            category: 'delivered',
            carrierEstimatedDeliveryAt: new \DateTimeImmutable(
                '2019-12-27T18:11:19.117Z'
            ),
            city: 'New York',
            postalCode: '10045',
            state: 'NY',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PhysicalCard::class, $result);
    }

    #[Test]
    public function testAdvanceShipment(): void
    {
        $result = $this->client->simulations->physicalCards->advanceShipment(
            'physical_card_ode8duyq5v2ynhjoharl',
            shipmentStatus: 'shipped'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PhysicalCard::class, $result);
    }

    #[Test]
    public function testAdvanceShipmentWithOptionalParams(): void
    {
        $result = $this->client->simulations->physicalCards->advanceShipment(
            'physical_card_ode8duyq5v2ynhjoharl',
            shipmentStatus: 'shipped'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PhysicalCard::class, $result);
    }
}
