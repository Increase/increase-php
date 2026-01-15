<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\InboundWireTransfers\InboundWireTransfer;
use Increase\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundWireTransfersContract
{
    /**
     * @api
     *
     * @param string $accountNumberID the identifier of the Account Number the inbound Wire Transfer is for
     * @param int $amount The transfer amount in cents. Must be positive.
     * @param string $creditorAddressLine1 The sending bank will set creditor_address_line1 in production. You can simulate any value here.
     * @param string $creditorAddressLine2 The sending bank will set creditor_address_line2 in production. You can simulate any value here.
     * @param string $creditorAddressLine3 The sending bank will set creditor_address_line3 in production. You can simulate any value here.
     * @param string $creditorName The sending bank will set creditor_name in production. You can simulate any value here.
     * @param string $debtorAddressLine1 The sending bank will set debtor_address_line1 in production. You can simulate any value here.
     * @param string $debtorAddressLine2 The sending bank will set debtor_address_line2 in production. You can simulate any value here.
     * @param string $debtorAddressLine3 The sending bank will set debtor_address_line3 in production. You can simulate any value here.
     * @param string $debtorName The sending bank will set debtor_name in production. You can simulate any value here.
     * @param string $endToEndIdentification The sending bank will set end_to_end_identification in production. You can simulate any value here.
     * @param string $instructingAgentRoutingNumber The sending bank will set instructing_agent_routing_number in production. You can simulate any value here.
     * @param string $instructionIdentification The sending bank will set instruction_identification in production. You can simulate any value here.
     * @param string $uniqueEndToEndTransactionReference The sending bank will set unique_end_to_end_transaction_reference in production. You can simulate any value here.
     * @param string $unstructuredRemittanceInformation The sending bank will set unstructured_remittance_information in production. You can simulate any value here.
     * @param string $wireDrawdownRequestID the identifier of a Wire Drawdown Request the inbound Wire Transfer is fulfilling
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $accountNumberID,
        int $amount,
        ?string $creditorAddressLine1 = null,
        ?string $creditorAddressLine2 = null,
        ?string $creditorAddressLine3 = null,
        ?string $creditorName = null,
        ?string $debtorAddressLine1 = null,
        ?string $debtorAddressLine2 = null,
        ?string $debtorAddressLine3 = null,
        ?string $debtorName = null,
        ?string $endToEndIdentification = null,
        ?string $instructingAgentRoutingNumber = null,
        ?string $instructionIdentification = null,
        ?string $uniqueEndToEndTransactionReference = null,
        ?string $unstructuredRemittanceInformation = null,
        ?string $wireDrawdownRequestID = null,
        RequestOptions|array|null $requestOptions = null,
    ): InboundWireTransfer;
}
