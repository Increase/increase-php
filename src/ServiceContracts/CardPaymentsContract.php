<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\CardPayments\CardPayment;
use Increase\CardPayments\CardPaymentListParams\CreatedAt;
use Increase\Core\Exceptions\APIException;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type CreatedAtShape from \Increase\CardPayments\CardPaymentListParams\CreatedAt
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardPaymentsContract
{
    /**
     * @api
     *
     * @param string $cardPaymentID the identifier of the Card Payment
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $cardPaymentID,
        RequestOptions|array|null $requestOptions = null
    ): CardPayment;

    /**
     * @api
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
    ): Page;
}
