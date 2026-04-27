<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\LockboxAddresses\LockboxAddress;
use Increase\LockboxAddresses\LockboxAddressListParams\CreatedAt;
use Increase\LockboxAddresses\LockboxAddressUpdateParams\Status;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\LockboxAddressesContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\LockboxAddresses\LockboxAddressListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class LockboxAddressesService implements LockboxAddressesContract
{
    /**
     * @api
     */
    public LockboxAddressesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LockboxAddressesRawService($client);
    }

    /**
     * @api
     *
     * Create a Lockbox Address
     *
     * @param string $description the description you choose for the Lockbox Address
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        ?string $description = null,
        RequestOptions|array|null $requestOptions = null
    ): LockboxAddress {
        $params = Util::removeNulls(['description' => $description]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a Lockbox Address
     *
     * @param string $lockboxAddressID the identifier of the Lockbox Address to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $lockboxAddressID,
        RequestOptions|array|null $requestOptions = null
    ): LockboxAddress {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($lockboxAddressID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a Lockbox Address
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
    ): LockboxAddress {
        $params = Util::removeNulls(
            ['description' => $description, 'status' => $status]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($lockboxAddressID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Lockbox Addresses
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
    ): Page {
        $params = Util::removeNulls(
            [
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'idempotencyKey' => $idempotencyKey,
                'limit' => $limit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
