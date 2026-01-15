<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\CardPayments\CardPayment;
use Increase\CardPayments\CardPaymentListParams\CreatedAt;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Page;
use Increase\RequestOptions;
use Increase\ServiceContracts\CardPaymentsContract;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\CardPayments\CardPaymentListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardPaymentsService implements CardPaymentsContract
{
    /**
     * @api
     */
    public CardPaymentsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CardPaymentsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a Card Payment
     *
     * @param string $cardPaymentID the identifier of the Card Payment
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardPaymentID,
        RequestOptions|array|null $requestOptions = null
    ): CardPayment {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($cardPaymentID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Card Payments
     *
     * @param string $accountID filter Card Payments to ones belonging to the specified Account
     * @param string $cardID filter Card Payments to ones belonging to the specified Card
     * @param CreatedAt|CreatedAtShape $createdAt
     * @param string $cursor return the page of entries after this one
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<CardPayment>
     *
     * @throws APIException
     */
    public function list(
        ?string $accountID = null,
        ?string $cardID = null,
        CreatedAt|array|null $createdAt = null,
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page {
        $params = Util::removeNulls(
            [
                'accountID' => $accountID,
                'cardID' => $cardID,
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
