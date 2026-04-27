<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\LockboxAddresses\LockboxAddress;
use Increase\LockboxAddresses\LockboxAddressListParams\CreatedAt;
use Increase\LockboxAddresses\LockboxAddressUpdateParams\Status;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\LockboxAddresses\LockboxAddressListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface LockboxAddressesContract
{
    /**
     * @api
     *
     * @param string $description the description you choose for the Lockbox Address
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?string $description = null,
        RequestOptions|array|null $requestOptions = null,
    ): LockboxAddress;

    /**
     * @api
     *
     * @param string $lockboxAddressID the identifier of the Lockbox Address to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $lockboxAddressID,
        RequestOptions|array|null $requestOptions = null
    ): LockboxAddress;

    /**
     * @api
     *
     * @param string $lockboxAddressID the identifier of the Lockbox Address
     * @param string $description the description you choose for the Lockbox Address
     * @param Status|value-of<Status> $status the status of the Lockbox Address
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $lockboxAddressID,
        ?string $description = null,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): LockboxAddress;

    /**
     * @api
     *
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<LockboxAddress>
     *
     * @throws APIException
     */
    public function list(
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;
}
