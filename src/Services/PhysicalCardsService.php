<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\PhysicalCards\PhysicalCard;
use Increase\PhysicalCards\PhysicalCardCreateParams\Cardholder;
use Increase\PhysicalCards\PhysicalCardCreateParams\Shipment;
use Increase\PhysicalCards\PhysicalCardListParams\CreatedAt;
use Increase\PhysicalCards\PhysicalCardUpdateParams\Status;
use Increase\RequestOptions;
use Increase\ServiceContracts\PhysicalCardsContract;

/**
 * @phpstan-import-type CardholderShape from \Increase\PhysicalCards\PhysicalCardCreateParams\Cardholder
 * @phpstan-import-type ShipmentShape from \Increase\PhysicalCards\PhysicalCardCreateParams\Shipment
 * @phpstan-import-type CreatedAtShape from \Increase\PhysicalCards\PhysicalCardListParams\CreatedAt
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
     * Create a Physical Card
     *
     * @param string $cardID the underlying card representing this physical card
     * @param Cardholder|CardholderShape $cardholder details about the cardholder, as it will appear on the physical card
     * @param Shipment|ShipmentShape $shipment the details used to ship this physical card
     * @param string $physicalCardProfileID The physical card profile to use for this physical card. The latest default physical card profile will be used if not provided.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $cardID,
        Cardholder|array $cardholder,
        Shipment|array $shipment,
        ?string $physicalCardProfileID = null,
        RequestOptions|array|null $requestOptions = null,
    ): PhysicalCard {
        $params = Util::removeNulls(
            [
                'cardID' => $cardID,
                'cardholder' => $cardholder,
                'shipment' => $shipment,
                'physicalCardProfileID' => $physicalCardProfileID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a Physical Card
     *
     * @param string $physicalCardID the identifier of the Physical Card
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $physicalCardID,
        RequestOptions|array|null $requestOptions = null
    ): PhysicalCard {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($physicalCardID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a Physical Card
     *
     * @param string $physicalCardID the Physical Card identifier
     * @param Status|value-of<Status> $status the status to update the Physical Card to
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $physicalCardID,
        Status|string $status,
        RequestOptions|array|null $requestOptions = null,
    ): PhysicalCard {
        $params = Util::removeNulls(['status' => $status]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($physicalCardID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Physical Cards
     *
     * @param string $cardID filter Physical Cards to ones belonging to the specified Card
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<PhysicalCard>
     *
     * @throws APIException
     */
    public function list(
        ?string $cardID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'cardID' => $cardID,
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'idempotencyKey' => $idempotencyKey,
                'limit' => $limit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
