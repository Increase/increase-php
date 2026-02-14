<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\ACHTransfers\ACHTransfer;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\ACHTransfersContract;
use Increase\Simulations\ACHTransfers\ACHTransferCreateNotificationOfChangeParams\ChangeCode;
use Increase\Simulations\ACHTransfers\ACHTransferReturnParams\Reason;
use Increase\Simulations\ACHTransfers\ACHTransferSettleParams\InboundFundsHoldBehavior;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class ACHTransfersService implements ACHTransfersContract
{
    /**
     * @api
     */
    public ACHTransfersRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ACHTransfersRawService($client);
    }

    /**
     * @api
     *
     * Simulates the acknowledgement of an [ACH Transfer](#ach-transfers) by the Federal Reserve. This transfer must first have a `status` of `submitted`. In production, the Federal Reserve generally acknowledges submitted ACH files within 30 minutes. Since sandbox ACH Transfers are not submitted to the Federal Reserve, this endpoint allows you to skip that delay and add the acknowledgement subresource to the ACH Transfer.
     *
     * @param string $achTransferID the identifier of the ACH Transfer you wish to become acknowledged
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function acknowledge(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): ACHTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->acknowledge($achTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Simulates receiving a Notification of Change for an [ACH Transfer](#ach-transfers).
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
    ): ACHTransfer {
        $params = Util::removeNulls(
            ['changeCode' => $changeCode, 'correctedData' => $correctedData]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createNotificationOfChange($achTransferID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Simulates the return of an [ACH Transfer](#ach-transfers) by the Federal Reserve due to an error condition. This will also create a Transaction to account for the returned funds. This transfer must first have a `status` of `submitted`.
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
    ): ACHTransfer {
        $params = Util::removeNulls(['reason' => $reason]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->return($achTransferID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Simulates the settlement of an [ACH Transfer](#ach-transfers) by the Federal Reserve. This transfer must first have a `status` of `pending_submission` or `submitted`. For convenience, if the transfer is in `status`: `pending_submission`, the simulation will also submit the transfer. Without this simulation the transfer will eventually settle on its own following the same Federal Reserve timeline as in production. Additionally, you can specify the behavior of the inbound funds hold that is created when the ACH Transfer is settled. If no behavior is specified, the inbound funds hold will be released immediately in order for the funds to be available for use.
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
    ): ACHTransfer {
        $params = Util::removeNulls(
            ['inboundFundsHoldBehavior' => $inboundFundsHoldBehavior]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->settle($achTransferID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Simulates the submission of an [ACH Transfer](#ach-transfers) to the Federal Reserve. This transfer must first have a `status` of `pending_approval` or `pending_submission`. In production, Increase submits ACH Transfers to the Federal Reserve three times per day on weekdays. Since sandbox ACH Transfers are not submitted to the Federal Reserve, this endpoint allows you to skip that delay and transition the ACH Transfer to a status of `submitted`.
     *
     * @param string $achTransferID the identifier of the ACH Transfer you wish to submit
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function submit(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): ACHTransfer {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->submit($achTransferID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
