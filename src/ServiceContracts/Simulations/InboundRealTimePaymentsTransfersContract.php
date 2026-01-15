<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\InboundRealTimePaymentsTransfers\InboundRealTimePaymentsTransfer;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundRealTimePaymentsTransfersContract
{
    /**
     * @api
     *
     * @param string $accountNumberID the identifier of the Account Number the inbound Real-Time Payments Transfer is for
     * @param int $amount The transfer amount in USD cents. Must be positive.
     * @param string $debtorAccountNumber the account number of the account that sent the transfer
     * @param string $debtorName the name provided by the sender of the transfer
     * @param string $debtorRoutingNumber the routing number of the account that sent the transfer
     * @param string $remittanceInformation additional information included with the transfer
     * @param string $requestForPaymentID the identifier of a pending Request for Payment that this transfer will fulfill
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
        ?string $remittanceInformation = null,
        ?string $requestForPaymentID = null,
        RequestOptions|array|null $requestOptions = null,
    ): InboundRealTimePaymentsTransfer;
}
