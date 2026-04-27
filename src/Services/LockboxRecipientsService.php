<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\LockboxRecipients\LockboxRecipient;
use Increase\LockboxRecipients\LockboxRecipientListParams\CreatedAt;
use Increase\LockboxRecipients\LockboxRecipientUpdateParams\Status;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\LockboxRecipientsContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\LockboxRecipients\LockboxRecipientListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class LockboxRecipientsService implements LockboxRecipientsContract
{
    /**
     * @api
     */
    public LockboxRecipientsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LockboxRecipientsRawService($client);
    }

    /**
     * @api
     *
     * Create a Lockbox Recipient
     *
     * @param string $accountID the Account that checks sent to this Lockbox Recipient should be deposited into
     * @param string $lockboxAddressID the Lockbox Address where this Lockbox Recipient may receive mail
     * @param string $description the description you choose for the Lockbox Recipient
     * @param string $recipientName The name of the Lockbox Recipient
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        string $lockboxAddressID,
        ?string $description = null,
        ?string $recipientName = null,
        RequestOptions|array|null $requestOptions = null,
    ): LockboxRecipient {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'lockboxAddressID' => $lockboxAddressID,
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
     * Retrieve a Lockbox Recipient
     *
     * @param string $lockboxRecipientID the identifier of the Lockbox Recipient to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $lockboxRecipientID,
        RequestOptions|array|null $requestOptions = null
    ): LockboxRecipient {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($lockboxRecipientID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a Lockbox Recipient
     *
     * @param string $lockboxRecipientID the identifier of the Lockbox Recipient
     * @param string $description the description you choose for the Lockbox Recipient
     * @param string $recipientName the name of the Lockbox Recipient
     * @param Status|value-of<Status> $status the status of the Lockbox Recipient
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $lockboxRecipientID,
        ?string $description = null,
        ?string $recipientName = null,
        Status|string|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): LockboxRecipient {
        $params = Util::removeNulls(
            [
                'description' => $description,
                'recipientName' => $recipientName,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($lockboxRecipientID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Lockbox Recipients
     *
     * @param string $accountID filter Lockbox Recipients to those associated with the provided Account
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param string $lockboxAddressID filter Lockbox Recipients to those associated with the provided Lockbox Address
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<LockboxRecipient>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        ?string $lockboxAddressID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'idempotencyKey' => $idempotencyKey,
                'limit' => $limit,
                'lockboxAddressID' => $lockboxAddressID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
