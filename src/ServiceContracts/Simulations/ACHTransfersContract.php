<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\ACHTransfers\ACHTransfer;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\ACHTransfers\ACHTransferCreateNotificationOfChangeParams\ChangeCode;
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
     * @param ChangeCode|value-of<ChangeCode> $changeCode the reason for the notification of change
     * @param string $correctedData The corrected data for the notification of change (e.g., a new routing number).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createNotificationOfChange(
        string $achTransferID,
        ChangeCode|string $changeCode,
        string $correctedData,
        RequestOptions|array|null $requestOptions = null,
    ): ACHTransfer;

    /**
     * @api
     *
     * @param string $achTransferID the identifier of the ACH Transfer you wish to return
     * @param Reason|value-of<Reason> $reason The reason why the Federal Reserve or destination bank returned this transfer. Defaults to `no_account`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function return(
        string $achTransferID,
        Reason|string|null $reason = null,
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
