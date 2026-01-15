<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\PhysicalCards\PhysicalCard;
use Increase\PhysicalCards\PhysicalCardCreateParams;
use Increase\PhysicalCards\PhysicalCardCreateParams\Cardholder;
use Increase\PhysicalCards\PhysicalCardCreateParams\Shipment;
use Increase\PhysicalCards\PhysicalCardListParams;
use Increase\PhysicalCards\PhysicalCardListParams\CreatedAt;
use Increase\PhysicalCards\PhysicalCardUpdateParams;
use Increase\PhysicalCards\PhysicalCardUpdateParams\Status;
use Increase\RequestOptions;
use Increase\ServiceContracts\PhysicalCardsRawContract;

/**
 * @phpstan-import-type CardholderShape from \Increase\PhysicalCards\PhysicalCardCreateParams\Cardholder
 * @phpstan-import-type ShipmentShape from \Increase\PhysicalCards\PhysicalCardCreateParams\Shipment
 * @phpstan-import-type CreatedAtShape from \Increase\PhysicalCards\PhysicalCardListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class PhysicalCardsRawService implements PhysicalCardsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a Physical Card
     *
     * @param array{
     *   cardID: string,
     *   cardholder: Cardholder|CardholderShape,
     *   shipment: Shipment|ShipmentShape,
     *   physicalCardProfileID?: string,
     * }|PhysicalCardCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCard>
     *
     * @throws APIException
     */
    public function create(
        array|PhysicalCardCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PhysicalCardCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'physical_cards',
            body: (object) $parsed,
            options: $options,
            convert: PhysicalCard::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a Physical Card
     *
     * @param string $physicalCardID the identifier of the Physical Card
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCard>
     *
     * @throws APIException
     */
    public function retrieve(
        string $physicalCardID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['physical_cards/%1$s', $physicalCardID],
            options: $requestOptions,
            convert: PhysicalCard::class,
        );
    }

    /**
     * @api
     *
     * Update a Physical Card
     *
     * @param string $physicalCardID the Physical Card identifier
     * @param array{status: Status|value-of<Status>}|PhysicalCardUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCard>
     *
     * @throws APIException
     */
    public function update(
        string $physicalCardID,
        array|PhysicalCardUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PhysicalCardUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'patch',
            path: ['physical_cards/%1$s', $physicalCardID],
            body: (object) $parsed,
            options: $options,
            convert: PhysicalCard::class,
        );
    }

    /**
     * @api
     *
     * List Physical Cards
     *
     * @param array{
     *   cardID?: string,
     *   createdAt?: CreatedAt|CreatedAtShape,
     *   cursor?: string,
     *   idempotencyKey?: string,
     *   limit?: int,
     * }|PhysicalCardListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Page<PhysicalCard>>
     *
     * @throws APIException
     */
    public function list(
        array|PhysicalCardListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PhysicalCardListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'physical_cards',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'cardID' => 'card_id',
                    'createdAt' => 'created_at',
                    'idempotencyKey' => 'idempotency_key',
                ],
            ),
            options: $options,
            convert: PhysicalCard::class,
            page: Page::class,
        );
    }
}
