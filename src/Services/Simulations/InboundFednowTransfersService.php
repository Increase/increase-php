<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundFednowTransfers\InboundFednowTransfer;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\InboundFednowTransfersContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundFednowTransfersService implements InboundFednowTransfersContract
{
    /**
     * @api
     */
    public InboundFednowTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InboundFednowTransfersRawService($client);
    }

    /**
     * @api
     *
     * Simulates an [Inbound FedNow Transfer](#inbound-fednow-transfers) to your account.
     *
     * @param string $accountNumberID the identifier of the Account Number the inbound FedNow Transfer is for
     * @param int $amount The transfer amount in USD cents. Must be positive.
     * @param string $debtorAccountNumber the account number of the account that sent the transfer
     * @param string $debtorName the name provided by the sender of the transfer
     * @param string $debtorRoutingNumber the routing number of the account that sent the transfer
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
        ?string $unstructuredRemittanceInformation = null,
        RequestOptions|array|null $requestOptions = null,
    ): InboundFednowTransfer {
        $params = Util::removeNulls(
            [
                'accountNumberID' => $accountNumberID,
                'amount' => $amount,
                'debtorAccountNumber' => $debtorAccountNumber,
                'debtorName' => $debtorName,
                'debtorRoutingNumber' => $debtorRoutingNumber,
                'unstructuredRemittanceInformation' => $unstructuredRemittanceInformation,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
