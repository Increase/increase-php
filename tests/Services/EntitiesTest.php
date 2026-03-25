<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Core\Util;
use Increase\Entities\Entity;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class EntitiesTest extends TestCase
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
        $result = $this->client->entities->create(structure: 'corporation');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Entity::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->entities->create(
            structure: 'corporation',
            corporation: [
                'address' => [
                    'city' => 'New York',
                    'line1' => '33 Liberty Street',
                    'state' => 'NY',
                    'zip' => '10045',
                    'line2' => 'x',
                ],
                'beneficialOwners' => [
                    [
                        'individual' => [
                            'address' => [
                                'city' => 'New York',
                                'country' => 'x',
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
                        'prongs' => ['control'],
                        'companyTitle' => 'CEO',
                    ],
                ],
                'legalIdentifier' => [
                    'value' => '602214076',
                    'category' => 'us_employer_identification_number',
                ],
                'name' => 'National Phonograph Company',
                'beneficialOwnershipExemptionReason' => 'regulated_financial_institution',
                'email' => 'dev@stainless.com',
                'incorporationState' => 'NY',
                'industryCode' => 'x',
                'website' => 'https://example.com',
            ],
            description: 'x',
            governmentAuthority: [
                'address' => [
                    'city' => 'x',
                    'line1' => 'x',
                    'state' => 'x',
                    'zip' => 'x',
                    'line2' => 'x',
                ],
                'authorizedPersons' => [['name' => 'x']],
                'category' => 'municipality',
                'name' => 'x',
                'taxIdentifier' => 'x',
                'website' => 'website',
            ],
            joint: [
                'individuals' => [
                    [
                        'address' => [
                            'city' => 'x',
                            'line1' => 'x',
                            'state' => 'x',
                            'zip' => 'x',
                            'line2' => 'x',
                        ],
                        'dateOfBirth' => '2019-12-27',
                        'identification' => [
                            'method' => 'social_security_number',
                            'number' => 'xxxx',
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
                        'name' => 'x',
                        'confirmedNoUsTaxID' => true,
                    ],
                ],
            ],
            naturalPerson: [
                'address' => [
                    'city' => 'x',
                    'line1' => 'x',
                    'state' => 'x',
                    'zip' => 'x',
                    'line2' => 'x',
                ],
                'dateOfBirth' => '2019-12-27',
                'identification' => [
                    'method' => 'social_security_number',
                    'number' => 'xxxx',
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
                'name' => 'x',
                'confirmedNoUsTaxID' => true,
            ],
            riskRating: [
                'ratedAt' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                'rating' => 'low',
            ],
            supplementalDocuments: [['fileID' => 'file_makxrc67oh9l6sg7w9yc']],
            termsAgreements: [
                [
                    'agreedAt' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                    'ipAddress' => 'x',
                    'termsURL' => 'x',
                ],
            ],
            thirdPartyVerification: ['reference' => 'x', 'vendor' => 'alloy'],
            trust: [
                'address' => [
                    'city' => 'x',
                    'line1' => 'x',
                    'state' => 'x',
                    'zip' => 'x',
                    'line2' => 'x',
                ],
                'category' => 'revocable',
                'name' => 'x',
                'trustees' => [
                    [
                        'structure' => 'individual',
                        'individual' => [
                            'address' => [
                                'city' => 'x',
                                'line1' => 'x',
                                'state' => 'x',
                                'zip' => 'x',
                                'line2' => 'x',
                            ],
                            'dateOfBirth' => '2019-12-27',
                            'identification' => [
                                'method' => 'social_security_number',
                                'number' => 'xxxx',
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
                            'name' => 'x',
                            'confirmedNoUsTaxID' => true,
                        ],
                    ],
                ],
                'formationDocumentFileID' => 'formation_document_file_id',
                'formationState' => 'x',
                'grantor' => [
                    'address' => [
                        'city' => 'x',
                        'line1' => 'x',
                        'state' => 'x',
                        'zip' => 'x',
                        'line2' => 'x',
                    ],
                    'dateOfBirth' => '2019-12-27',
                    'identification' => [
                        'method' => 'social_security_number',
                        'number' => 'xxxx',
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
                    'name' => 'x',
                    'confirmedNoUsTaxID' => true,
                ],
                'taxIdentifier' => 'x',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Entity::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->entities->retrieve('entity_n8y8tnk2p9339ti393yi');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Entity::class, $result);
    }

    #[Test]
    public function testUpdate(): void
    {
        $result = $this->client->entities->update('entity_n8y8tnk2p9339ti393yi');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Entity::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->entities->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Entity::class, $item);
        }
    }

    #[Test]
    public function testArchive(): void
    {
        $result = $this->client->entities->archive('entity_n8y8tnk2p9339ti393yi');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Entity::class, $result);
    }
}
