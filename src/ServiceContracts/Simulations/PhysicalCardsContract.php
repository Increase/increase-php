<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\Core\Exceptions\APIException;
use Increase\PhysicalCards\PhysicalCard;
use Increase\RequestOptions;
use Increase\Simulations\PhysicalCards\PhysicalCardAdvanceShipmentParams\ShipmentStatus;
use Increase\Simulations\PhysicalCards\PhysicalCardCreateParams\Category;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface PhysicalCardsContract
{
    /**
     * @api
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
    ): PhysicalCard;

    /**
     * @api
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
    ): PhysicalCard;
}
