<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\BookkeepingEntrySets\BookkeepingEntrySet;
use Increase\BookkeepingEntrySets\BookkeepingEntrySetCreateParams\Entry;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\BookkeepingEntrySetsContract;

/**
 * @phpstan-import-type EntryShape from \Increase\BookkeepingEntrySets\BookkeepingEntrySetCreateParams\Entry
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class BookkeepingEntrySetsService implements BookkeepingEntrySetsContract
{
    /**
     * @api
     */
    public BookkeepingEntrySetsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BookkeepingEntrySetsRawService($client);
    }

    /**
     * @api
     *
     * Create a Bookkeeping Entry Set
     *
     * @param list<Entry|EntryShape> $entries the bookkeeping entries
     * @param \DateTimeInterface $date The date of the transaction. Optional if `transaction_id` is provided, in which case we use the `date` of that transaction. Required otherwise.
     * @param string $transactionID the identifier of the Transaction related to this entry set, if any
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        array $entries,
        ?\DateTimeInterface $date = null,
        ?string $transactionID = null,
        RequestOptions|array|null $requestOptions = null,
    ): BookkeepingEntrySet {
        $params = Util::removeNulls(
            [
                'entries' => $entries,
                'date' => $date,
                'transactionID' => $transactionID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a Bookkeeping Entry Set
     *
     * @param string $bookkeepingEntrySetID the identifier of the Bookkeeping Entry Set
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $bookkeepingEntrySetID,
        RequestOptions|array|null $requestOptions = null,
    ): BookkeepingEntrySet {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($bookkeepingEntrySetID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Bookkeeping Entry Sets
     *
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param string $transactionID filter to the Bookkeeping Entry Set that maps to this Transaction
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<BookkeepingEntrySet>
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        ?string $transactionID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'cursor' => $cursor,
                'idempotencyKey' => $idempotencyKey,
                'limit' => $limit,
                'transactionID' => $transactionID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
