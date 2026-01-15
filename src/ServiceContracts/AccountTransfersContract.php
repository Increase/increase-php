<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\AccountTransfers\AccountTransfer;
use Increase\AccountTransfers\AccountTransferListParams\CreatedAt;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\AccountTransfers\AccountTransferListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface AccountTransfersContract
{
    /**
     * @api
     *
     * @param string $accountID the identifier for the originating Account that will send the transfer
     * @param int $amount The transfer amount in the minor unit of the account currency. For dollars, for example, this is cents.
     * @param string $description An internal-facing description for the transfer for display in the API and dashboard. This will also show in the description of the created Transactions.
     * @param string $destinationAccountID the identifier for the destination Account that will receive the transfer
     * @param bool $requireApproval Whether the transfer should require explicit approval via the dashboard or API. For more information, see [Transfer Approvals](/documentation/transfer-approvals).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        int $amount,
        string $description,
        string $destinationAccountID,
        ?bool $requireApproval = null,
        RequestOptions|array|null $requestOptions = null,
    ): AccountTransfer;

    /**
     * @api
     *
     * @param string $accountTransferID the identifier of the Account Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $accountTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): AccountTransfer;

    /**
     * @api
     *
     * @param string $accountID filter Account Transfers to those that originated from the specified Account
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<AccountTransfer>
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

    /**
     * @api
     *
     * @param string $accountTransferID the identifier of the Account Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function approve(
        string $accountTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): AccountTransfer;

    /**
     * @api
     *
     * @param string $accountTransferID the identifier of the pending Account Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $accountTransferID,
        RequestOptions|array|null $requestOptions = null,
    ): AccountTransfer;
}
