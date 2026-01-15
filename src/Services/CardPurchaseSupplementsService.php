<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\CardPurchaseSupplements\CardPurchaseSupplement;
use Increase\CardPurchaseSupplements\CardPurchaseSupplementListParams\CreatedAt;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CardPurchaseSupplementsContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\CardPurchaseSupplements\CardPurchaseSupplementListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardPurchaseSupplementsService implements CardPurchaseSupplementsContract
{
    /**
     * @api
     */
    public CardPurchaseSupplementsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CardPurchaseSupplementsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a Card Purchase Supplement
     *
     * @param string $cardPurchaseSupplementID the identifier of the Card Purchase Supplement
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardPurchaseSupplementID,
        RequestOptions|array|null $requestOptions = null,
    ): CardPurchaseSupplement {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($cardPurchaseSupplementID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Card Purchase Supplements
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
    ): Page {
        $params = Util::removeNulls(
            [
                'cardPaymentID' => $cardPaymentID,
                'createdAt' => $createdAt,
                'cursor' => $cursor,
                'limit' => $limit,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
