<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\Lockboxes\Lockbox;
use Increase\Lockboxes\LockboxListParams\CreatedAt;
use Increase\Lockboxes\LockboxUpdateParams\CheckDepositBehavior;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\Lockboxes\LockboxListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface LockboxesContract
{
    /**
     * @api
     *
     * @param string $accountID the Account checks sent to this Lockbox should be deposited into
     * @param string $description the description you choose for the Lockbox, for display purposes
     * @param string $recipientName the name of the recipient that will receive mail at this location
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        ?string $description = null,
        ?string $recipientName = null,
        RequestOptions|array|null $requestOptions = null,
    ): Lockbox;

    /**
     * @api
     *
     * @param string $lockboxID the identifier of the Lockbox to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $lockboxID,
        RequestOptions|array|null $requestOptions = null
    ): Lockbox;

    /**
     * @api
     *
     * @param string $lockboxID the identifier of the Lockbox
     * @param CheckDepositBehavior|value-of<CheckDepositBehavior> $checkDepositBehavior this indicates if checks mailed to this lockbox will be deposited
     * @param string $description the description you choose for the Lockbox
     * @param string $recipientName the recipient name you choose for the Lockbox
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $lockboxID,
        CheckDepositBehavior|string|null $checkDepositBehavior = null,
        ?string $description = null,
        ?string $recipientName = null,
        RequestOptions|array|null $requestOptions = null,
    ): Lockbox;

    /**
     * @api
     *
     * @param string $accountID filter Lockboxes to those associated with the provided Account
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<Lockbox>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;
}
