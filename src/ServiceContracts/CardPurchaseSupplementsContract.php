<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\CardPurchaseSupplements\CardPurchaseSupplement;
use Increase\CardPurchaseSupplements\CardPurchaseSupplementListParams\CreatedAt;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\CardPurchaseSupplements\CardPurchaseSupplementListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardPurchaseSupplementsContract
{
    /**
     * @api
     *
     * @param string $cardPurchaseSupplementID the identifier of the Card Purchase Supplement
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardPurchaseSupplementID,
        RequestOptions|array|null $requestOptions = null,
    ): CardPurchaseSupplement;

    /**
     * @api
     *
     * @param string $cardPaymentID filter Card Purchase Supplements to ones belonging to the specified Card Payment
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<CardPurchaseSupplement>
     *
     * @throws APIException
     */
    public function list(
        ?string $cardPaymentID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;
}
