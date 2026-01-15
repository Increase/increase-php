<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\CardPushTransfers\CardPushTransfer;
use Increase\CardPushTransfers\CardPushTransferCreateParams;
use Increase\CardPushTransfers\CardPushTransferCreateParams\BusinessApplicationIdentifier;
use Increase\CardPushTransfers\CardPushTransferCreateParams\PresentmentAmount;
use Increase\CardPushTransfers\CardPushTransferListParams;
use Increase\CardPushTransfers\CardPushTransferListParams\CreatedAt;
use Increase\CardPushTransfers\CardPushTransferListParams\Status;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CardPushTransfersRawContract;

/**
 * @phpstan-import-type PresentmentAmountShape from \Increase\CardPushTransfers\CardPushTransferCreateParams\PresentmentAmount
 * @phpstan-import-type CreatedAtShape from \Increase\CardPushTransfers\CardPushTransferListParams\CreatedAt
 * @phpstan-import-type StatusShape from \Increase\CardPushTransfers\CardPushTransferListParams\Status
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardPushTransfersRawService implements CardPushTransfersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Card Push Transfer
     *
     * @param array{
     *   businessApplicationIdentifier: value-of<BusinessApplicationIdentifier>,
     *   cardTokenID: string,
     *   merchantCategoryCode: string,
     *   merchantCityName: string,
     *   merchantName: string,
     *   merchantNamePrefix: string,
     *   merchantPostalCode: string,
     *   merchantState: string,
     *   presentmentAmount: PresentmentAmount|PresentmentAmountShape,
     *   recipientName: string,
     *   senderAddressCity: string,
     *   senderAddressLine1: string,
     *   senderAddressPostalCode: string,
     *   senderAddressState: string,
     *   senderName: string,
     *   sourceAccountNumberID: string,
     *   requireApproval?: bool,
     * }|CardPushTransferCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPushTransfer>
     *
     * @throws APIException
     */
    public function create(
        array|CardPushTransferCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardPushTransferCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'card_push_transfers',
            body: (object) $parsed,
            options: $options,
            convert: CardPushTransfer::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Card Push Transfer
     *
     * @param string $cardPushTransferID the identifier of the Card Push Transfer
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPushTransfer>
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardPushTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['card_push_transfers/%1$s', $cardPushTransferID],
            options: $requestOptions,
            convert: CardPushTransfer::class,
        );
    }

    /**
     * @api
     *
     * List Card Push Transfers
     *
     * @param array{
     *   accountID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     *   status?: Status|StatusShape,
     * }|CardPushTransferListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<CardPushTransfer>>
     *
     * @throws APIException
     */
    public function list(
        array|CardPushTransferListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardPushTransferListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'card_push_transfers',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'accountID' => 'account_id',
                    'createdAt' => 'created_at',
                    'idempotencyKey' => 'idempotency_key',
                ],
            ),
            options: $options,
            convert: CardPushTransfer::class,
            page: Page::class,
        );
    }

    /**
     * @api
     *
     * Approves a Card Push Transfer in a pending_approval state.
     *
     * @param string $cardPushTransferID the identifier of the Card Push Transfer to approve
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPushTransfer>
     *
     * @throws APIException
     */
    public function approve(
        string $cardPushTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['card_push_transfers/%1$s/approve', $cardPushTransferID],
            options: $requestOptions,
            convert: CardPushTransfer::class,
        );
    }

    /**
     * @api
     *
     * Cancels a Card Push Transfer in a pending_approval state.
     *
     * @param string $cardPushTransferID the identifier of the pending Card Push Transfer to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPushTransfer>
     *
     * @throws APIException
     */
    public function cancel(
        string $cardPushTransferID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['card_push_transfers/%1$s/cancel', $cardPushTransferID],
            options: $requestOptions,
            convert: CardPushTransfer::class,
        );
    }
}
