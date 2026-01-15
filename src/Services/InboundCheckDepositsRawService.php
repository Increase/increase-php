<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundCheckDeposits\InboundCheckDeposit;
use Increase\InboundCheckDeposits\InboundCheckDepositListParams;
use Increase\InboundCheckDeposits\InboundCheckDepositListParams\CreatedAt;
use Increase\InboundCheckDeposits\InboundCheckDepositReturnParams;
use Increase\InboundCheckDeposits\InboundCheckDepositReturnParams\Reason;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\InboundCheckDepositsRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\InboundCheckDeposits\InboundCheckDepositListParams\CreatedAt
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
     * Retrieve an Inbound Check Deposit
     *
     * @param string $inboundCheckDepositID the identifier of the Inbound Check Deposit to get details for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundCheckDeposit>
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundCheckDepositID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['inbound_check_deposits/%1$s', $inboundCheckDepositID],
            options: $requestOptions,
            convert: InboundCheckDeposit::class,
        );
    }

    /**
     * @api
     *
     * List Inbound Check Deposits
     *
     * @param array{
     *   accountID?: string,
     *   checkTransferID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   limit?: int,
     * }|InboundCheckDepositListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<InboundCheckDeposit>>
     *
     * @throws APIException
     */
    public function list(
        array|InboundCheckDepositListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundCheckDepositListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'inbound_check_deposits',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'checkTransferID' => 'check_transfer_id',
                    'createdAt' => 'created_at',
                ],
            ),
            options: $options,
            convert: InboundCheckDeposit::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Decline an Inbound Check Deposit
     *
     * @param string $inboundCheckDepositID the identifier of the Inbound Check Deposit to decline
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundCheckDeposit>
     *
     * @throws APIException
     */
    public function decline(
        string $inboundCheckDepositID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['inbound_check_deposits/%1$s/decline', $inboundCheckDepositID],
            options: $requestOptions,
            convert: InboundCheckDeposit::class,
        );
    }

    /**
     * @api
     *
     * Return an Inbound Check Deposit
     *
     * @param string $inboundCheckDepositID the identifier of the Inbound Check Deposit to return
     * @param array{reason: value-of<Reason>}|InboundCheckDepositReturnParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<InboundCheckDeposit>
     *
     * @throws APIException
     */
    public function return(
        string $inboundCheckDepositID,
        array|InboundCheckDepositReturnParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InboundCheckDepositReturnParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['inbound_check_deposits/%1$s/return', $inboundCheckDepositID],
            body: (object) $parsed,
            options: $options,
            convert: InboundCheckDeposit::class,
        );
    }
}
