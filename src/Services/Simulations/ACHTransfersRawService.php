<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\ACHTransfers\ACHTransfer;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\ACHTransfersRawContract;
use Increase\Simulations\ACHTransfers\ACHTransferCreateNotificationOfChangeParams;
use Increase\Simulations\ACHTransfers\ACHTransferCreateNotificationOfChangeParams\ChangeCode;
use Increase\Simulations\ACHTransfers\ACHTransferReturnParams;
use Increase\Simulations\ACHTransfers\ACHTransferReturnParams\Reason;
use Increase\Simulations\ACHTransfers\ACHTransferSettleParams;
use Increase\Simulations\ACHTransfers\ACHTransferSettleParams\InboundFundsHoldBehavior;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class ACHTransfersRawService implements ACHTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates the acknowledgement of an [ACH Transfer](#ach-transfers) by the Federal Reserve. This transfer must first have a `status` of `submitted` . In production, the Federal Reserve generally acknowledges submitted ACH files within 30 minutes. Since sandbox ACH Transfers are not submitted to the Federal Reserve, this endpoint allows you to skip that delay and add the acknowledgment subresource to the ACH Transfer.
     *
     * @param string $achTransferID the identifier of the ACH Transfer you wish to become acknowledged
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHTransfer>
     *
     * @throws APIException
     */
    public function acknowledge(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['simulations/ach_transfers/%1$s/acknowledge', $achTransferID],
            options: $requestOptions,
            convert: ACHTransfer::class,
        );
    }

    /**
     * @api
     *
     * Simulates receiving a Notification of Change for an [ACH Transfer](#ach-transfers).
     *
     * @param string $achTransferID the identifier of the ACH Transfer you wish to create a notification of change for
     * @param array{
     *   changeCode: value-of<ChangeCode>, correctedData: string
     * }|ACHTransferCreateNotificationOfChangeParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHTransfer>
     *
     * @throws APIException
     */
    public function createNotificationOfChange(
        string $achTransferID,
        array|ACHTransferCreateNotificationOfChangeParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ACHTransferCreateNotificationOfChangeParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'simulations/ach_transfers/%1$s/create_notification_of_change',
                $achTransferID,
            ],
            body: (object) $parsed,
            options: $options,
            convert: ACHTransfer::class,
        );
    }

    /**
     * @api
     *
     * Simulates the return of an [ACH Transfer](#ach-transfers) by the Federal Reserve due to an error condition. This will also create a Transaction to account for the returned funds. This transfer must first have a `status` of `submitted`.
     *
     * @param string $achTransferID the identifier of the ACH Transfer you wish to return
     * @param array{reason?: value-of<Reason>}|ACHTransferReturnParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHTransfer>
     *
     * @throws APIException
     */
    public function return(
        string $achTransferID,
        array|ACHTransferReturnParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ACHTransferReturnParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['simulations/ach_transfers/%1$s/return', $achTransferID],
            body: (object) $parsed,
            options: $options,
            convert: ACHTransfer::class,
        );
    }

    /**
     * @api
     *
     * Simulates the settlement of an [ACH Transfer](#ach-transfers) by the Federal Reserve. This transfer must first have a `status` of `pending_submission` or `submitted`. For convenience, if the transfer is in `status`: `pending_submission`, the simulation will also submit the transfer. Without this simulation the transfer will eventually settle on its own following the same Federal Reserve timeline as in production. Additionally, you can specify the behavior of the inbound funds hold that is created when the ACH Transfer is settled. If no behavior is specified, the inbound funds hold will be released immediately in order for the funds to be available for use.
     *
     * @param string $achTransferID the identifier of the ACH Transfer you wish to become settled
     * @param array{
     *   inboundFundsHoldBehavior?: InboundFundsHoldBehavior|value-of<InboundFundsHoldBehavior>,
     * }|ACHTransferSettleParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHTransfer>
     *
     * @throws APIException
     */
    public function settle(
        string $achTransferID,
        array|ACHTransferSettleParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ACHTransferSettleParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['simulations/ach_transfers/%1$s/settle', $achTransferID],
            body: (object) $parsed,
            options: $options,
            convert: ACHTransfer::class,
        );
    }

    /**
     * @api
     *
     * Simulates the submission of an [ACH Transfer](#ach-transfers) to the Federal Reserve. This transfer must first have a `status` of `pending_approval` or `pending_submission`. In production, Increase submits ACH Transfers to the Federal Reserve three times per day on weekdays. Since sandbox ACH Transfers are not submitted to the Federal Reserve, this endpoint allows you to skip that delay and transition the ACH Transfer to a status of `submitted`.
     *
     * @param string $achTransferID the identifier of the ACH Transfer you wish to submit
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ACHTransfer>
     *
     * @throws APIException
     */
    public function submit(
        string $achTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['simulations/ach_transfers/%1$s/submit', $achTransferID],
            options: $requestOptions,
            convert: ACHTransfer::class,
        );
    }
}
