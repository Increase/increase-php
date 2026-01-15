<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\CheckTransfers\CheckTransfer;
use Increase\CheckTransfers\CheckTransferCreateParams\BalanceCheck;
use Increase\CheckTransfers\CheckTransferCreateParams\FulfillmentMethod;
use Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck;
use Increase\CheckTransfers\CheckTransferCreateParams\ThirdParty;
use Increase\CheckTransfers\CheckTransferListParams\CreatedAt;
use Increase\CheckTransfers\CheckTransferListParams\Status;
use Increase\CheckTransfers\CheckTransferStopPaymentParams\Reason;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CheckTransfersContract;

/**
 * @phpstan-import-type PhysicalCheckShape from \Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck
 * @phpstan-import-type ThirdPartyShape from \Increase\CheckTransfers\CheckTransferCreateParams\ThirdParty
 * @phpstan-import-type CreatedAtShape from \Increase\CheckTransfers\CheckTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\CheckTransfers\CheckTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CheckTransfersService implements CheckTransfersContract
{
    /**
     * @api
     */
    public CheckTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CheckTransfersRawService($client);
    }

    /**
     * @api
     *
     * Create a Check Transfer
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
    ): CheckTransfer {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'amount' => $amount,
                'fulfillmentMethod' => $fulfillmentMethod,
                'sourceAccountNumberID' => $sourceAccountNumberID,
                'balanceCheck' => $balanceCheck,
                'checkNumber' => $checkNumber,
                'physicalCheck' => $physicalCheck,
                'requireApproval' => $requireApproval,
                'thirdParty' => $thirdParty,
                'validUntilDate' => $validUntilDate,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a Check Transfer
     *
     * @param string $checkTransferID the identifier of the Check Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $checkTransferID,
        RequestOptions|array|null $requestOptions = null
    ): CheckTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($checkTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Check Transfers
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
    ): Page {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'idempotencyKey' => $idempotencyKey,
                'limit' => $limit,
                'status' => $status,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Approve a Check Transfer
     *
     * @param string $checkTransferID the identifier of the Check Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function approve(
        string $checkTransferID,
        RequestOptions|array|null $requestOptions = null
    ): CheckTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->approve($checkTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancel a Check Transfer with the `pending_approval` status. See [Transfer Approvals](/documentation/transfer-approvals) for more information.
     *
     * @param string $checkTransferID the identifier of the pending Check Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $checkTransferID,
        RequestOptions|array|null $requestOptions = null
    ): CheckTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($checkTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Stop payment on a Check Transfer
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
    ): CheckTransfer {
        $params = Util::removeNulls(['reason' => $reason]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->stopPayment($checkTransferID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
