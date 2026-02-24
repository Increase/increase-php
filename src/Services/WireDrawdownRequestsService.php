<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\WireDrawdownRequestsContract;
use Increase\WireDrawdownRequests\WireDrawdownRequest;
use Increase\WireDrawdownRequests\WireDrawdownRequestCreateParams\CreditorAddress;
use Increase\WireDrawdownRequests\WireDrawdownRequestCreateParams\DebtorAddress;
use Increase\WireDrawdownRequests\WireDrawdownRequestListParams\Status;

/**
 * @phpstan-import-type CreditorAddressShape from \Increase\WireDrawdownRequests\WireDrawdownRequestCreateParams\CreditorAddress
 * @phpstan-import-type DebtorAddressShape from \Increase\WireDrawdownRequests\WireDrawdownRequestCreateParams\DebtorAddress
 * @phpstan-import-type StatusShape from \Increase\WireDrawdownRequests\WireDrawdownRequestListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class WireDrawdownRequestsService implements WireDrawdownRequestsContract
{
    /**
     * @api
     */
    public WireDrawdownRequestsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WireDrawdownRequestsRawService($client);
    }

    /**
     * @api
     *
     * Create a Wire Drawdown Request
     *
     * @param string $accountNumberID the Account Number to which the debtor should send funds
     * @param int $amount the amount requested from the debtor, in USD cents
     * @param CreditorAddress|CreditorAddressShape $creditorAddress the creditor's address
     * @param string $creditorName the creditor's name
     * @param DebtorAddress|DebtorAddressShape $debtorAddress the debtor's address
     * @param string $debtorName the debtor's name
     * @param string $unstructuredRemittanceInformation remittance information the debtor will see as part of the request
     * @param string $debtorAccountNumber the debtor's account number
     * @param string $debtorExternalAccountID The ID of an External Account to initiate a transfer to. If this parameter is provided, `debtor_account_number` and `debtor_routing_number` must be absent.
     * @param string $debtorRoutingNumber the debtor's routing number
     * @param string $endToEndIdentification a free-form reference string set by the sender mirrored back in the subsequent wire transfer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountNumberID,
        int $amount,
        CreditorAddress|array $creditorAddress,
        string $creditorName,
        DebtorAddress|array $debtorAddress,
        string $debtorName,
        string $unstructuredRemittanceInformation,
        ?string $debtorAccountNumber = null,
        ?string $debtorExternalAccountID = null,
        ?string $debtorRoutingNumber = null,
        ?string $endToEndIdentification = null,
        RequestOptions|array|null $requestOptions = null,
    ): WireDrawdownRequest {
        $params = Util::removeNulls(
            [
                'accountNumberID' => $accountNumberID,
                'amount' => $amount,
                'creditorAddress' => $creditorAddress,
                'creditorName' => $creditorName,
                'debtorAddress' => $debtorAddress,
                'debtorName' => $debtorName,
                'unstructuredRemittanceInformation' => $unstructuredRemittanceInformation,
                'debtorAccountNumber' => $debtorAccountNumber,
                'debtorExternalAccountID' => $debtorExternalAccountID,
                'debtorRoutingNumber' => $debtorRoutingNumber,
                'endToEndIdentification' => $endToEndIdentification,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a Wire Drawdown Request
     *
     * @param string $wireDrawdownRequestID the identifier of the Wire Drawdown Request to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $wireDrawdownRequestID,
        RequestOptions|array|null $requestOptions = null,
    ): WireDrawdownRequest {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($wireDrawdownRequestID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Wire Drawdown Requests
     *
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<WireDrawdownRequest>
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
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
}
