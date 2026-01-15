<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\WireTransfersContract;
use Increase\WireTransfers\WireTransfer;
use Increase\WireTransfers\WireTransferCreateParams\Creditor;
use Increase\WireTransfers\WireTransferCreateParams\Debtor;
use Increase\WireTransfers\WireTransferCreateParams\Remittance;
use Increase\WireTransfers\WireTransferListParams\CreatedAt;

/**
 * @phpstan-import-type CreditorShape from \Increase\WireTransfers\WireTransferCreateParams\Creditor
 * @phpstan-import-type RemittanceShape from \Increase\WireTransfers\WireTransferCreateParams\Remittance
 * @phpstan-import-type DebtorShape from \Increase\WireTransfers\WireTransferCreateParams\Debtor
 * @phpstan-import-type CreatedAtShape from \Increase\WireTransfers\WireTransferListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class WireTransfersService implements WireTransfersContract
{
    /**
     * @api
     */
    public WireTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WireTransfersRawService($client);
    }

    /**
     * @api
     *
     * Create a Wire Transfer
     *
     * @param string $accountID the identifier for the account that will send the transfer
     * @param int $amount the transfer amount in USD cents
     * @param Creditor|CreditorShape $creditor the person or business that is receiving the funds from the transfer
     * @param Remittance|RemittanceShape $remittance additional remittance information related to the wire transfer
     * @param string $accountNumber the account number for the destination account
     * @param Debtor|DebtorShape $debtor The person or business whose funds are being transferred. This is only necessary if you're transferring from a commingled account. Otherwise, we'll use the associated entity's details.
     * @param string $externalAccountID The ID of an External Account to initiate a transfer to. If this parameter is provided, `account_number` and `routing_number` must be absent.
     * @param string $inboundWireDrawdownRequestID the ID of an Inbound Wire Drawdown Request in response to which this transfer is being sent
     * @param bool $requireApproval whether the transfer requires explicit approval via the dashboard or API
     * @param string $routingNumber the American Bankers' Association (ABA) Routing Transit Number (RTN) for the destination account
     * @param string $sourceAccountNumberID The ID of an Account Number that will be passed to the wire's recipient
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountID,
        int $amount,
        Creditor|array $creditor,
        Remittance|array $remittance,
        ?string $accountNumber = null,
        Debtor|array|null $debtor = null,
        ?string $externalAccountID = null,
        ?string $inboundWireDrawdownRequestID = null,
        ?bool $requireApproval = null,
        ?string $routingNumber = null,
        ?string $sourceAccountNumberID = null,
        RequestOptions|array|null $requestOptions = null,
    ): WireTransfer {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'amount' => $amount,
                'creditor' => $creditor,
                'remittance' => $remittance,
                'accountNumber' => $accountNumber,
                'debtor' => $debtor,
                'externalAccountID' => $externalAccountID,
                'inboundWireDrawdownRequestID' => $inboundWireDrawdownRequestID,
                'requireApproval' => $requireApproval,
                'routingNumber' => $routingNumber,
                'sourceAccountNumberID' => $sourceAccountNumberID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a Wire Transfer
     *
     * @param string $wireTransferID the identifier of the Wire Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $wireTransferID,
        RequestOptions|array|null $requestOptions = null
    ): WireTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($wireTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Wire Transfers
     *
     * @param string $accountID filter Wire Transfers to those belonging to the specified Account
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $externalAccountID filter Wire Transfers to those made to the specified External Account
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<WireTransfer>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $externalAccountID = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'externalAccountID' => $externalAccountID,
                'idempotencyKey' => $idempotencyKey,
                'limit' => $limit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Approve a Wire Transfer
     *
     * @param string $wireTransferID the identifier of the Wire Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function approve(
        string $wireTransferID,
        RequestOptions|array|null $requestOptions = null
    ): WireTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->approve($wireTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancel a pending Wire Transfer
     *
     * @param string $wireTransferID the identifier of the pending Wire Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $wireTransferID,
        RequestOptions|array|null $requestOptions = null
    ): WireTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($wireTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
