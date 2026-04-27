<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\LockboxRecipients\LockboxRecipient;
use Increase\LockboxRecipients\LockboxRecipientListParams\CreatedAt;
use Increase\LockboxRecipients\LockboxRecipientUpdateParams\Status;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\LockboxRecipients\LockboxRecipientListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface LockboxRecipientsContract
{
    /**
     * @api
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
    ): LockboxRecipient;

    /**
     * @api
     *
     * @param string $lockboxRecipientID the identifier of the Lockbox Recipient to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $lockboxRecipientID,
        RequestOptions|array|null $requestOptions = null,
    ): LockboxRecipient;

    /**
     * @api
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
    ): LockboxRecipient;

    /**
     * @api
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
    ): Page;
}
