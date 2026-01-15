<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\InboundMailItems\InboundMailItem;
use Increase\InboundMailItems\InboundMailItemActionParams\Check;
use Increase\InboundMailItems\InboundMailItemListParams\CreatedAt;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\InboundMailItems\InboundMailItemListParams\CreatedAt
 * @phpstan-import-type CheckShape from \Increase\InboundMailItems\InboundMailItemActionParams\Check
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface InboundMailItemsContract
{
    /**
     * @api
     *
     * @param string $inboundMailItemID the identifier of the Inbound Mail Item to retrieve
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $inboundMailItemID,
        RequestOptions|array|null $requestOptions = null,
    ): InboundMailItem;

    /**
     * @api
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
    ): Page;

    /**
     * @api
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
    ): InboundMailItem;
}
