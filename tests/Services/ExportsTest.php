<?php

namespace Tests\Services;

use Increase\Client;
use Increase\Exports\Export;
use Increase\Page;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ExportsTest extends TestCase
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
        $result = $this->client->exports->create(category: 'transaction_csv');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Export::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->exports->create(
            category: 'transaction_csv',
            accountStatementBai2: [
                'accountID' => 'account_id',
                'effectiveDate' => '2019-12-27',
                'programID' => 'program_id',
            ],
            accountStatementOfx: [
                'accountID' => 'account_id',
                'createdAt' => [
                    'after' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                    'before' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                    'onOrAfter' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                    'onOrBefore' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                ],
            ],
            accountVerificationLetter: [
                'accountNumberID' => 'account_number_id', 'balanceDate' => '2019-12-27',
            ],
            balanceCsv: [
                'accountID' => 'account_id',
                'createdAt' => [
                    'after' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                    'before' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                    'onOrAfter' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                    'onOrBefore' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                ],
                'programID' => 'program_id',
            ],
            bookkeepingAccountBalanceCsv: [
                'bookkeepingAccountID' => 'bookkeeping_account_id',
                'createdAt' => [
                    'after' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                    'before' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                    'onOrAfter' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                    'onOrBefore' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                ],
            ],
            entityCsv: ['status' => ['in' => ['active']]],
            fundingInstructions: ['accountNumberID' => 'account_number_id'],
            transactionCsv: [
                'accountID' => 'account_in71c4amph0vgo2qllky',
                'createdAt' => [
                    'after' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                    'before' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                    'onOrAfter' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                    'onOrBefore' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
                ],
            ],
            vendorCsv: [],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Export::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->exports->retrieve('export_8s4m48qz3bclzje0zwh9');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Export::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $page = $this->client->exports->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Page::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(Export::class, $item);
        }
    }
}
