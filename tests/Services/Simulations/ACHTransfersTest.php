<?php

namespace Tests\Services\Simulations;

use Increase\ACHTransfers\ACHTransfer;
use Increase\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ACHTransfersTest extends TestCase
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
    public function testAcknowledge(): void
    {
        $result = $this->client->simulations->achTransfers->acknowledge(
            'ach_transfer_uoxatyh3lt5evrsdvo7q'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ACHTransfer::class, $result);
    }

    #[Test]
    public function testCreateNotificationOfChange(): void
    {
        $result = $this
            ->client
            ->simulations
            ->achTransfers
            ->createNotificationOfChange(
                'ach_transfer_uoxatyh3lt5evrsdvo7q',
                changeCode: 'incorrect_routing_number',
                correctedData: '123456789',
            )
        ;

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ACHTransfer::class, $result);
    }

    #[Test]
    public function testCreateNotificationOfChangeWithOptionalParams(): void
    {
        $result = $this
            ->client
            ->simulations
            ->achTransfers
            ->createNotificationOfChange(
                'ach_transfer_uoxatyh3lt5evrsdvo7q',
                changeCode: 'incorrect_routing_number',
                correctedData: '123456789',
            )
        ;

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ACHTransfer::class, $result);
    }

    #[Test]
    public function testReturn(): void
    {
        $result = $this->client->simulations->achTransfers->return(
            'ach_transfer_uoxatyh3lt5evrsdvo7q'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ACHTransfer::class, $result);
    }

    #[Test]
    public function testSettle(): void
    {
        $result = $this->client->simulations->achTransfers->settle(
            'ach_transfer_uoxatyh3lt5evrsdvo7q'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ACHTransfer::class, $result);
    }

    #[Test]
    public function testSubmit(): void
    {
        $result = $this->client->simulations->achTransfers->submit(
            'ach_transfer_uoxatyh3lt5evrsdvo7q'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ACHTransfer::class, $result);
    }
}
