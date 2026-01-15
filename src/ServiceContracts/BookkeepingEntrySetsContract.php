<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\BookkeepingEntrySets\BookkeepingEntrySet;
use Increase\BookkeepingEntrySets\BookkeepingEntrySetCreateParams\Entry;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type EntryShape from \Increase\BookkeepingEntrySets\BookkeepingEntrySetCreateParams\Entry
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface BookkeepingEntrySetsContract
{
    /**
     * @api
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
    ): BookkeepingEntrySet;

    /**
     * @api
     *
     * @param string $bookkeepingEntrySetID the identifier of the Bookkeeping Entry Set
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $bookkeepingEntrySetID,
        RequestOptions|array|null $requestOptions = null,
    ): BookkeepingEntrySet;

    /**
     * @api
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
    ): Page;
}
