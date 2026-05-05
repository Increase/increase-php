<?php

namespace Tests\Services\Simulations;

use Increase\Client;
use Increase\Core\Util;
use Increase\Entities\Entity;
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
    public function testUpdateValidation(): void
    {
        $result = $this->client->simulations->entities->updateValidation(
            'entity_n8y8tnk2p9339ti393yi',
            issues: [['category' => 'entity_tax_identifier']],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Entity::class, $result);
    }

    #[Test]
    public function testUpdateValidationWithOptionalParams(): void
    {
        $result = $this->client->simulations->entities->updateValidation(
            'entity_n8y8tnk2p9339ti393yi',
            issues: [['category' => 'entity_tax_identifier']],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Entity::class, $result);
    }
}
