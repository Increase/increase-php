<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\CheckTransfers\CheckTransfer;
use Increase\CheckTransfers\CheckTransferCreateParams\BalanceCheck;
use Increase\CheckTransfers\CheckTransferCreateParams\FulfillmentMethod;
use Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck;
use Increase\CheckTransfers\CheckTransferCreateParams\ThirdParty;
use Increase\CheckTransfers\CheckTransferListParams\CreatedAt;
use Increase\CheckTransfers\CheckTransferListParams\Status;
use Increase\CheckTransfers\CheckTransferStopPaymentParams\Reason;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type PhysicalCheckShape from \Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck
 * @phpstan-import-type ThirdPartyShape from \Increase\CheckTransfers\CheckTransferCreateParams\ThirdParty
 * @phpstan-import-type CreatedAtShape from \Increase\CheckTransfers\CheckTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\CheckTransfers\CheckTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CheckTransfersContract
{
    /**
     * @api
     *
     * @param string $accountID the identifier for the account that will send the transfer
     * @param int $amount the transfer amount in USD cents
     * @param FulfillmentMethod|value-of<FulfillmentMethod> $fulfillmentMethod whether Increase will print and mail the check or if you will do it yourself
     * @param string $sourceAccountNumberID the identifier of the Account Number from which to send the transfer and print on the check
     * @param BalanceCheck|value-of<BalanceCheck> $balanceCheck How the account's available balance should be checked. If omitted, the default behavior is `balance_check: full`.
     * @param string $checkNumber The check number Increase should use for the check. This should not contain leading zeroes and must be unique across the `source_account_number`. If this is omitted, Increase will generate a check number for you.
     * @param PhysicalCheck|PhysicalCheckShape $physicalCheck Details relating to the physical check that Increase will print and mail. This is required if `fulfillment_method` is equal to `physical_check`. It must not be included if any other `fulfillment_method` is provided.
     * @param bool $requireApproval whether the transfer requires explicit approval via the dashboard or API
     * @param ThirdParty|ThirdPartyShape $thirdParty Details relating to the custom fulfillment you will perform. This is required if `fulfillment_method` is equal to `third_party`. It must not be included if any other `fulfillment_method` is provided.
     * @param string $validUntilDate If provided, the check will be valid on or before this date. After this date, the check transfer will be automatically stopped and deposits will not be accepted. For checks printed by Increase, this date is included on the check as its expiry.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        int $amount,
        FulfillmentMethod|string $fulfillmentMethod,
        string $sourceAccountNumberID,
        BalanceCheck|string|null $balanceCheck = null,
        ?string $checkNumber = null,
        PhysicalCheck|array|null $physicalCheck = null,
        ?bool $requireApproval = null,
        ThirdParty|array|null $thirdParty = null,
        ?string $validUntilDate = null,
        RequestOptions|array|null $requestOptions = null,
    ): CheckTransfer;

    /**
     * @api
     *
     * @param string $checkTransferID the identifier of the Check Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $checkTransferID,
        RequestOptions|array|null $requestOptions = null
    ): CheckTransfer;

    /**
     * @api
     *
     * @param string $accountID filter Check Transfers to those that originated from the specified Account
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<CheckTransfer>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;

    /**
     * @api
     *
     * @param string $checkTransferID the identifier of the Check Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function approve(
        string $checkTransferID,
        RequestOptions|array|null $requestOptions = null
    ): CheckTransfer;

    /**
     * @api
     *
     * @param string $checkTransferID the identifier of the pending Check Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $checkTransferID,
        RequestOptions|array|null $requestOptions = null
    ): CheckTransfer;

    /**
     * @api
     *
     * @param string $checkTransferID the identifier of the Check Transfer
     * @param Reason|value-of<Reason> $reason the reason why this transfer should be stopped
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function stopPayment(
        string $checkTransferID,
        Reason|string|null $reason = null,
        RequestOptions|array|null $requestOptions = null,
    ): CheckTransfer;
}
