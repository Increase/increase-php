<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\PhysicalCheckBatches\PhysicalCheckBatch;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class PhysicalCheckBatchesTest extends TestCase
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
        $result = $this->client->physicalCheckBatches->create(
            mailingAddress: [
                'city' => 'New York',
                'line1' => '33 Liberty Street',
                'name' => 'Ian Crease',
                'postalCode' => '10045',
                'state' => 'NY',
            ],
            returnAddress: [
                'city' => 'New York',
                'line1' => '33 Liberty Street',
                'name' => 'National Phonograph Company',
                'postalCode' => '10045',
                'state' => 'NY',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PhysicalCheckBatch::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->physicalCheckBatches->create(
            mailingAddress: [
                'city' => 'New York',
                'line1' => '33 Liberty Street',
                'name' => 'Ian Crease',
                'postalCode' => '10045',
                'state' => 'NY',
                'line2' => 'line2',
                'phone' => 'x',
            ],
            returnAddress: [
                'city' => 'New York',
                'line1' => '33 Liberty Street',
                'name' => 'National Phonograph Company',
                'postalCode' => '10045',
                'state' => 'NY',
                'line2' => 'line2',
                'phone' => 'x',
            ],
            shippingMethod: 'usps_first_class',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PhysicalCheckBatch::class, $result);
    }

    #[Test]
    public function testCancel(): void
    {
        $result = $this->client->physicalCheckBatches->cancel(
            'physical_check_batch_yzdwjhdbw0in6191whce'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PhysicalCheckBatch::class, $result);
    }

    #[Test]
    public function testComplete(): void
    {
        $result = $this->client->physicalCheckBatches->complete(
            'physical_check_batch_yzdwjhdbw0in6191whce'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PhysicalCheckBatch::class, $result);
    }
}
