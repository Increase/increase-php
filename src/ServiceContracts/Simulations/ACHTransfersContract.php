<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\ACHTransfers\ACHTransfer;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\ACHTransfers\ACHTransferCreateNotificationOfChangeParams\CorrectedAccountFunding;
use Increase\Simulations\ACHTransfers\ACHTransferReturnParams\Reason;
use Increase\Simulations\ACHTransfers\ACHTransferSettleParams\InboundFundsHoldBehavior;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface ACHTransfersContract
{
    /**
     * @api
     *
     * @param string $achTransferID the identifier of the ACH Transfer you wish to become acknowledged
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function acknowledge(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): ACHTransfer;

    /**
     * @api
     *
     * @param string $achTransferID the identifier of the ACH Transfer you wish to create a notification of change for
     * @param CorrectedAccountFunding|value-of<CorrectedAccountFunding> $correctedAccountFunding the corrected account funding type
     * @param string $correctedAccountNumber the corrected account number
     * @param string $correctedIndividualID the corrected individual identifier
     * @param string $correctedRoutingNumber the corrected routing number
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createNotificationOfChange(
        string $achTransferID,
        CorrectedAccountFunding|string|null $correctedAccountFunding = null,
        ?string $correctedAccountNumber = null,
        ?string $correctedIndividualID = null,
        ?string $correctedRoutingNumber = null,
        RequestOptions|array|null $requestOptions = null,
    ): ACHTransfer;

    /**
     * @api
     *
     * @param string $achTransferID the identifier of the ACH Transfer you wish to return
     * @param string $addendaInformation Free-form information the returning bank includes in the return addenda. For a `file_record_edit_criteria` (R17) return, set this to `QUESTIONABLE` to simulate a return the bank believes was initiated under questionable circumstances.
     * @param Reason|value-of<Reason> $reason the reason why the Federal Reserve or destination bank returned this transfer
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function return(
        string $achTransferID,
        ?string $addendaInformation = null,
        Reason|string $reason = 'no_account',
        RequestOptions|array|null $requestOptions = null,
    ): ACHTransfer;

    /**
     * @api
     *
     * @param string $achTransferID the identifier of the ACH Transfer you wish to become settled
     * @param InboundFundsHoldBehavior|value-of<InboundFundsHoldBehavior> $inboundFundsHoldBehavior The behavior of the inbound funds hold that is created when the ACH Transfer is settled. If no behavior is specified, the inbound funds hold will be released immediately in order for the funds to be available for use.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function settle(
        string $achTransferID,
        InboundFundsHoldBehavior|string|null $inboundFundsHoldBehavior = null,
        RequestOptions|array|null $requestOptions = null,
    ): ACHTransfer;

    /**
     * @api
     *
     * @param string $achTransferID the identifier of the ACH Transfer you wish to submit
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function submit(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): ACHTransfer;
}
