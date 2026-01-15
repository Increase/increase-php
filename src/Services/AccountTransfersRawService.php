<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\AccountTransfers\AccountTransfer;
use Increase\AccountTransfers\AccountTransferCreateParams;
use Increase\AccountTransfers\AccountTransferListParams;
use Increase\AccountTransfers\AccountTransferListParams\CreatedAt;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\AccountTransfersRawContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\AccountTransfers\AccountTransferListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class AccountTransfersRawService implements AccountTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create an Account Transfer
     *
     * @param array{
     *   accountID: string,
     *   amount: int,
     *   description: string,
     *   destinationAccountID: string,
     *   requireApproval?: bool,
     * }|AccountTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|AccountTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountTransferCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'account_transfers',
            body: (object) $parsed,
            options: $options,
            convert: AccountTransfer::class,
        );
    }

    /**
     * @api
     *
     * Retrieve an Account Transfer
     *
     * @param string $accountTransferID the identifier of the Account Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $accountTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['account_transfers/%1$s', $accountTransferID],
            options: $requestOptions,
            convert: AccountTransfer::class,
        );
    }

    /**
     * @api
     *
     * List Account Transfers
     *
     * @param array{
     *   accountID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     * }|AccountTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<AccountTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|AccountTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AccountTransferListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'account_transfers',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'createdAt' => 'created_at',
                    'idempotencyKey' => 'idempotency_key',
                ],
            ),
            options: $options,
            convert: AccountTransfer::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Approves an Account Transfer in status `pending_approval`.
     *
     * @param string $accountTransferID the identifier of the Account Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountTransfer>
     *
     * @throws APIException
     */
    public function approve(
        string $accountTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['account_transfers/%1$s/approve', $accountTransferID],
            options: $requestOptions,
            convert: AccountTransfer::class,
        );
    }

    /**
     * @api
     *
     * Cancels an Account Transfer in status `pending_approval`.
     *
     * @param string $accountTransferID the identifier of the pending Account Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AccountTransfer>
     *
     * @throws APIException
     */
    public function cancel(
        string $accountTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['account_transfers/%1$s/cancel', $accountTransferID],
            options: $requestOptions,
            convert: AccountTransfer::class,
        );
    }
}
