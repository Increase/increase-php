<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\PhysicalCards\PhysicalCard;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\PhysicalCardsRawContract;
use Increase\Simulations\PhysicalCards\PhysicalCardAdvanceShipmentParams;
use Increase\Simulations\PhysicalCards\PhysicalCardAdvanceShipmentParams\ShipmentStatus;
use Increase\Simulations\PhysicalCards\PhysicalCardCreateParams;
use Increase\Simulations\PhysicalCards\PhysicalCardCreateParams\Category;

/**
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
     * This endpoint allows you to simulate receiving a tracking update for a Physical Card, to simulate the progress of a shipment.
     *
     * @param string $physicalCardID the Physical Card you would like to action
     * @param array{
     *   category: value-of<Category>,
     *   carrierEstimatedDeliveryAt?: \DateTimeInterface,
     *   city?: string,
     *   postalCode?: string,
     *   state?: string,
     * }|PhysicalCardCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCard>
     *
     * @throws APIException
     */
    public function create(
        string $physicalCardID,
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
            path: [
                'simulations/physical_cards/%1$s/tracking_updates', $physicalCardID,
            ],
            body: (object) $parsed,
            options: $options,
            convert: PhysicalCard::class,
        );
    }

    /**
     * @api
     *
     * This endpoint allows you to simulate advancing the shipment status of a Physical Card, to simulate e.g., that a physical card was attempted shipped but then failed delivery.
     *
     * @param string $physicalCardID the Physical Card you would like to action
     * @param array{
     *   shipmentStatus: value-of<ShipmentStatus>
     * }|PhysicalCardAdvanceShipmentParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PhysicalCard>
     *
     * @throws APIException
     */
    public function advanceShipment(
        string $physicalCardID,
        array|PhysicalCardAdvanceShipmentParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PhysicalCardAdvanceShipmentParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'simulations/physical_cards/%1$s/advance_shipment', $physicalCardID,
            ],
            body: (object) $parsed,
            options: $options,
            convert: PhysicalCard::class,
        );
    }
}
