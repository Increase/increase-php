<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\InboundMailItems\InboundMailItem;
use Increase\InboundMailItems\InboundMailItemActionParams\Check;
use Increase\InboundMailItems\InboundMailItemListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\InboundMailItemsContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\InboundMailItems\InboundMailItemListParams\CreatedAt
 * @phpstan-import-type CheckShape from \Increase\InboundMailItems\InboundMailItemActionParams\Check
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class InboundMailItemsService implements InboundMailItemsContract
{
    /**
     * @api
     */
    public InboundMailItemsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InboundMailItemsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve an Inbound Mail Item
     *
     * @param string $inboundMailItemID the identifier of the Inbound Mail Item to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundMailItemID,
        RequestOptions|array|null $requestOptions = null
    ): InboundMailItem {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($inboundMailItemID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Inbound Mail Items
     *
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param string $lockboxID filter Inbound Mail Items to ones sent to the provided Lockbox
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<InboundMailItem>
     *
     * @throws APIException
     */
    public function list(
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
        ?string $lockboxID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'limit' => $limit,
                'lockboxID' => $lockboxID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Action a Inbound Mail Item
     *
     * @param string $inboundMailItemID the identifier of the Inbound Mail Item to action
     * @param list<Check|CheckShape> $checks the actions to perform on the Inbound Mail Item
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function action(
        string $inboundMailItemID,
        array $checks,
        RequestOptions|array|null $requestOptions = null,
    ): InboundMailItem {
        $params = Util::removeNulls(['checks' => $checks]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->action($inboundMailItemID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
