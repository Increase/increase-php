<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundWireDrawdownRequests\InboundWireDrawdownRequest;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\InboundWireDrawdownRequestsContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundWireDrawdownRequestsService implements InboundWireDrawdownRequestsContract
{
    /**
     * @api
     */
    public InboundWireDrawdownRequestsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InboundWireDrawdownRequestsRawService($client);
    }

    /**
     * @api
     *
     * Simulates receiving an [Inbound Wire Drawdown Request](#inbound-wire-drawdown-requests).
     *
     * @param int $amount the amount being requested in cents
     * @param string $creditorAccountNumber the creditor's account number
     * @param string $creditorRoutingNumber the creditor's routing number
     * @param string $currency The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the amount being requested. Will always be "USD".
     * @param string $recipientAccountNumberID the Account Number to which the recipient of this request is being requested to send funds from
     * @param string $creditorAddressLine1 a free-form address field set by the sender representing the first line of the creditor's address
     * @param string $creditorAddressLine2 a free-form address field set by the sender representing the second line of the creditor's address
     * @param string $creditorAddressLine3 a free-form address field set by the sender representing the third line of the creditor's address
     * @param string $creditorName a free-form name field set by the sender representing the creditor's name
     * @param string $debtorAccountNumber the debtor's account number
     * @param string $debtorAddressLine1 a free-form address field set by the sender representing the first line of the debtor's address
     * @param string $debtorAddressLine2 a free-form address field set by the sender representing the second line of the debtor's address
     * @param string $debtorAddressLine3 a free-form address field set by the sender
     * @param string $debtorName a free-form name field set by the sender representing the debtor's name
     * @param string $debtorRoutingNumber the debtor's routing number
     * @param string $endToEndIdentification a free-form reference string set by the sender, to help identify the transfer
     * @param string $instructionIdentification the sending bank's identifier for the wire transfer
     * @param string $uniqueEndToEndTransactionReference The Unique End-to-end Transaction Reference ([UETR](https://www.swift.com/payments/what-unique-end-end-transaction-reference-uetr)) of the transfer.
     * @param string $unstructuredRemittanceInformation a free-form message set by the sender
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        int $amount,
        string $creditorAccountNumber,
        string $creditorRoutingNumber,
        string $currency,
        string $recipientAccountNumberID,
        ?string $creditorAddressLine1 = null,
        ?string $creditorAddressLine2 = null,
        ?string $creditorAddressLine3 = null,
        ?string $creditorName = null,
        ?string $debtorAccountNumber = null,
        ?string $debtorAddressLine1 = null,
        ?string $debtorAddressLine2 = null,
        ?string $debtorAddressLine3 = null,
        ?string $debtorName = null,
        ?string $debtorRoutingNumber = null,
        ?string $endToEndIdentification = null,
        ?string $instructionIdentification = null,
        ?string $uniqueEndToEndTransactionReference = null,
        ?string $unstructuredRemittanceInformation = null,
        RequestOptions|array|null $requestOptions = null,
    ): InboundWireDrawdownRequest {
        $params = Util::removeNulls(
            [
                'amount' => $amount,
                'creditorAccountNumber' => $creditorAccountNumber,
                'creditorRoutingNumber' => $creditorRoutingNumber,
                'currency' => $currency,
                'recipientAccountNumberID' => $recipientAccountNumberID,
                'creditorAddressLine1' => $creditorAddressLine1,
                'creditorAddressLine2' => $creditorAddressLine2,
                'creditorAddressLine3' => $creditorAddressLine3,
                'creditorName' => $creditorName,
                'debtorAccountNumber' => $debtorAccountNumber,
                'debtorAddressLine1' => $debtorAddressLine1,
                'debtorAddressLine2' => $debtorAddressLine2,
                'debtorAddressLine3' => $debtorAddressLine3,
                'debtorName' => $debtorName,
                'debtorRoutingNumber' => $debtorRoutingNumber,
                'endToEndIdentification' => $endToEndIdentification,
                'instructionIdentification' => $instructionIdentification,
                'uniqueEndToEndTransactionReference' => $uniqueEndToEndTransactionReference,
                'unstructuredRemittanceInformation' => $unstructuredRemittanceInformation,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
