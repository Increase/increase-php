<?php

namespace Tests\Services;

use Increase\CardValidations\CardValidation;
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
final class CardValidationsTest extends TestCase
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
        $result = $this->client->cardValidations->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            cardTokenID: 'outbound_card_token_zlt0ml6youq3q7vcdlg0',
            merchantCategoryCode: '1234',
            merchantCityName: 'New York',
            merchantName: 'Acme Corp',
            merchantPostalCode: '10045',
            merchantState: 'NY',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardValidation::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->cardValidations->create(
            accountID: 'account_in71c4amph0vgo2qllky',
            cardTokenID: 'outbound_card_token_zlt0ml6youq3q7vcdlg0',
            merchantCategoryCode: '1234',
            merchantCityName: 'New York',
            merchantName: 'Acme Corp',
            merchantPostalCode: '10045',
            merchantState: 'NY',
            cardholderFirstName: 'Dee',
            cardholderLastName: 'Hock',
            cardholderMiddleName: 'Ward',
            cardholderPostalCode: '10045',
            cardholderStreetAddress: '33 Liberty Street',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardValidation::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->cardValidations->retrieve(
            'outbound_card_validation_qqlzagpc6v1x2gcdhe24'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CardValidation::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->cardValidations->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(CardValidation::class, $item);
        }
    }
}
