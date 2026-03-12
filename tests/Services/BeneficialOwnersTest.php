<?php

namespace Tests\Services;

use Increase\BeneficialOwners\EntityBeneficialOwner;
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
final class BeneficialOwnersTest extends TestCase
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
        $result = $this->client->beneficialOwners->create(
            entityID: 'entity_n8y8tnk2p9339ti393yi',
            individual: [
                'address' => [
                    'city' => 'New York',
                    'country' => 'US',
                    'line1' => '33 Liberty Street',
                ],
                'dateOfBirth' => '1970-01-31',
                'identification' => [
                    'method' => 'social_security_number', 'number' => '078051120',
                ],
                'name' => 'Ian Crease',
            ],
            prongs: ['control'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EntityBeneficialOwner::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->beneficialOwners->create(
            entityID: 'entity_n8y8tnk2p9339ti393yi',
            individual: [
                'address' => [
                    'city' => 'New York',
                    'country' => 'US',
                    'line1' => '33 Liberty Street',
                    'line2' => 'x',
                    'state' => 'NY',
                    'zip' => '10045',
                ],
                'dateOfBirth' => '1970-01-31',
                'identification' => [
                    'method' => 'social_security_number',
                    'number' => '078051120',
                    'driversLicense' => [
                        'expirationDate' => '2019-12-27',
                        'fileID' => 'file_id',
                        'state' => 'x',
                        'backFileID' => 'back_file_id',
                    ],
                    'other' => [
                        'country' => 'x',
                        'description' => 'x',
                        'fileID' => 'file_id',
                        'backFileID' => 'back_file_id',
                        'expirationDate' => '2019-12-27',
                    ],
                    'passport' => [
                        'country' => 'x',
                        'expirationDate' => '2019-12-27',
                        'fileID' => 'file_id',
                    ],
                ],
                'name' => 'Ian Crease',
                'confirmedNoUsTaxID' => true,
            ],
            prongs: ['control'],
            companyTitle: 'CEO',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EntityBeneficialOwner::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->beneficialOwners->retrieve(
            'entity_beneficial_owner_vozma8szzu1sxezp5zq6'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EntityBeneficialOwner::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->beneficialOwners->update(
            'entity_beneficial_owner_vozma8szzu1sxezp5zq6'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EntityBeneficialOwner::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->beneficialOwners->list(entityID: 'entity_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(EntityBeneficialOwner::class, $item);
        }
    }

    #[Test]
    public function testListWithOptionalParams(): void
    {
        $page = $this->client->beneficialOwners->list(
            entityID: 'entity_id',
            cursor: 'cursor',
            idempotencyKey: 'x',
            limit: 1
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(EntityBeneficialOwner::class, $item);
        }
    }

    #[Test]
    public function testArchive(): void
    {
        $result = $this->client->beneficialOwners->archive(
            'entity_beneficial_owner_vozma8szzu1sxezp5zq6'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EntityBeneficialOwner::class, $result);
    }
}
