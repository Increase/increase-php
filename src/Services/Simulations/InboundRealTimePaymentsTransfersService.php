<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransfer;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\InboundRealTimePaymentsTransfersContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundRealTimePaymentsTransfersService implements InboundRealTimePaymentsTransfersContract
{
    /**
     * @api
     */
    public InboundRealTimePaymentsTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InboundRealTimePaymentsTransfersRawService($client);
    }

    /**
     * @api
     *
     * Simulates an [Inbound Real-Time Payments Transfer](#inbound-real-time-payments-transfers) to your account. Real-Time Payments are a beta feature.
     *
     * @param string $accountNumberID the identifier of the Account Number the inbound Real-Time Payments Transfer is for
     * @param int $amount The transfer amount in USD cents. Must be positive.
     * @param string $debtorAccountNumber the account number of the account that sent the transfer
     * @param string $debtorName the name provided by the sender of the transfer
     * @param string $debtorRoutingNumber the routing number of the account that sent the transfer
     * @param string $requestForPaymentID the identifier of a pending Request for Payment that this transfer will fulfill
     * @param string $unstructuredRemittanceInformation additional information included with the transfer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountNumberID,
        int $amount,
        ?string $debtorAccountNumber = null,
        ?string $debtorName = null,
        ?string $debtorRoutingNumber = null,
        ?string $requestForPaymentID = null,
        ?string $unstructuredRemittanceInformation = null,
        RequestOptions|array|null $requestOptions = null,
    ): InboundRealTimePaymentsTransfer {
        $params = Util::removeNulls(
            [
                'accountNumberID' => $accountNumberID,
                'amount' => $amount,
                'debtorAccountNumber' => $debtorAccountNumber,
                'debtorName' => $debtorName,
                'debtorRoutingNumber' => $debtorRoutingNumber,
                'requestForPaymentID' => $requestForPaymentID,
                'unstructuredRemittanceInformation' => $unstructuredRemittanceInformation,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
