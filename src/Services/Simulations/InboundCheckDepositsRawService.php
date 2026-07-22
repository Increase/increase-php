<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\InboundCheckDeposits\InboundCheckDeposit;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\InboundCheckDepositsRawContract;
use Increase\Simulations\InboundCheckDeposits\InboundCheckDepositAdjustmentParams;
use Increase\Simulations\InboundCheckDeposits\InboundCheckDepositAdjustmentParams\Reason;
use Increase\Simulations\InboundCheckDeposits\InboundCheckDepositCreateParams;
use Increase\Simulations\InboundCheckDeposits\InboundCheckDepositCreateParams\PayeeNameAnalysis;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundCheckDepositsRawService implements InboundCheckDepositsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates an Inbound Check Deposit against your account. This imitates someone depositing a check at their bank that was issued from your account. It may or may not be associated with a Check Transfer. The resulting Inbound Check Deposit will have a `status` of `pending`, and after an hour Increase will evaluate it as we would in production and either create a Transaction or a Declined Transaction as a result. To resolve it sooner, use the simulation to accept an Inbound Check Deposit or the API to decline one.
     *
     * @param array{
     *   accountNumberID: string,
     *   amount: int,
     *   checkNumber: string,
     *   payeeNameAnalysis?: PayeeNameAnalysis|value-of<PayeeNameAnalysis>,
     * }|InboundCheckDepositCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundCheckDeposit>
     *
     * @throws APIException
     */
    public function create(
        array|InboundCheckDepositCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundCheckDepositCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/inbound_check_deposits',
            body: (object) $parsed,
            options: $options,
            convert: InboundCheckDeposit::class,
        );
    }

    /**
     * @api
     *
     * Simulates an adjustment on an Inbound Check Deposit. The Inbound Check Deposit must have a `status` of `accepted`.
     *
     * @param string $inboundCheckDepositID the identifier of the Inbound Check Deposit to adjust
     * @param array{
     *   amount?: int, reason?: value-of<Reason>
     * }|InboundCheckDepositAdjustmentParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundCheckDeposit>
     *
     * @throws APIException
     */
    public function adjustment(
        string $inboundCheckDepositID,
        array|InboundCheckDepositAdjustmentParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundCheckDepositAdjustmentParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'simulations/inbound_check_deposits/%1$s/adjustment',
                $inboundCheckDepositID,
            ],
            body: (object) $parsed,
            options: $options,
            convert: InboundCheckDeposit::class,
        );
    }
}
