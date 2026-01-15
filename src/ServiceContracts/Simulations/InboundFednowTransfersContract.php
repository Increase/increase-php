<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\InboundFednowTransfers\InboundFednowTransfer;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundFednowTransfersContract
{
    /**
     * @api
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
    ): InboundFednowTransfer;
}
