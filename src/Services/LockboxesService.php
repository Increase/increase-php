<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Lockboxes\Lockbox;
use Increase\Lockboxes\LockboxListParams\CreatedAt;
use Increase\Lockboxes\LockboxUpdateParams\CheckDepositBehavior;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\LockboxesContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\Lockboxes\LockboxListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class LockboxesService implements LockboxesContract
{
    /**
     * @api
     */
    public LockboxesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LockboxesRawService($client);
    }

    /**
     * @api
     *
     * Create a Lockbox
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
    ): Lockbox {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'description' => $description,
                'recipientName' => $recipientName,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a Lockbox
     *
     * @param string $lockboxID the identifier of the Lockbox to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $lockboxID,
        RequestOptions|array|null $requestOptions = null
    ): Lockbox {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($lockboxID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a Lockbox
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
    ): Lockbox {
        $params = Util::removeNulls(
            [
                'checkDepositBehavior' => $checkDepositBehavior,
                'description' => $description,
                'recipientName' => $recipientName,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($lockboxID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Lockboxes
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
    ): Page {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
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
