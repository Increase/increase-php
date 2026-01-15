<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\PhysicalCards\PhysicalCard;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\PhysicalCardsContract;
use Increase\Simulations\PhysicalCards\PhysicalCardAdvanceShipmentParams\ShipmentStatus;
use Increase\Simulations\PhysicalCards\PhysicalCardCreateParams\Category;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class PhysicalCardsService implements PhysicalCardsContract
{
    /**
     * @api
     */
    public PhysicalCardsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PhysicalCardsRawService($client);
    }

    /**
     * @api
     *
     * This endpoint allows you to simulate receiving a tracking update for a Physical Card, to simulate the progress of a shipment.
     *
     * @param string $physicalCardID the Physical Card you would like to action
     * @param Category|value-of<Category> $category the type of tracking event
     * @param \DateTimeInterface $carrierEstimatedDeliveryAt The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time when the carrier expects the card to be delivered.
     * @param string $city the city where the event took place
     * @param string $postalCode the postal code where the event took place
     * @param string $state the state where the event took place
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $physicalCardID,
        Category|string $category,
        ?\DateTimeInterface $carrierEstimatedDeliveryAt = null,
        ?string $city = null,
        ?string $postalCode = null,
        ?string $state = null,
        RequestOptions|array|null $requestOptions = null,
    ): PhysicalCard {
        $params = Util::removeNulls(
            [
                'category' => $category,
                'carrierEstimatedDeliveryAt' => $carrierEstimatedDeliveryAt,
                'city' => $city,
                'postalCode' => $postalCode,
                'state' => $state,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($physicalCardID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * This endpoint allows you to simulate advancing the shipment status of a Physical Card, to simulate e.g., that a physical card was attempted shipped but then failed delivery.
     *
     * @param string $physicalCardID the Physical Card you would like to action
     * @param ShipmentStatus|value-of<ShipmentStatus> $shipmentStatus the shipment status to move the Physical Card to
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function advanceShipment(
        string $physicalCardID,
        ShipmentStatus|string $shipmentStatus,
        RequestOptions|array|null $requestOptions = null,
    ): PhysicalCard {
        $params = Util::removeNulls(['shipmentStatus' => $shipmentStatus]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->advanceShipment($physicalCardID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
