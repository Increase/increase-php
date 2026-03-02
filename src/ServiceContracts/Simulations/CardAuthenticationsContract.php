<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\CardPayments\CardPayment;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\CardAuthentications\CardAuthenticationCreateParams\Category;
use Increase\Simulations\CardAuthentications\CardAuthenticationCreateParams\DeviceChannel;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardAuthenticationsContract
{
    /**
     * @api
     *
     * @param string $cardID the identifier of the Card to be authorized
     * @param Category|value-of<Category> $category the category of the card authentication attempt
     * @param DeviceChannel|value-of<DeviceChannel> $deviceChannel the device channel of the card authentication attempt
     * @param string $merchantAcceptorID the merchant identifier (commonly abbreviated as MID) of the merchant the card is transacting with
     * @param string $merchantCategoryCode the Merchant Category Code (commonly abbreviated as MCC) of the merchant the card is transacting with
     * @param string $merchantCountry the country the merchant resides in
     * @param string $merchantName The name of the merchant
     * @param int $purchaseAmount the purchase amount in cents
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $cardID,
        Category|string|null $category = null,
        DeviceChannel|string|null $deviceChannel = null,
        ?string $merchantAcceptorID = null,
        ?string $merchantCategoryCode = null,
        ?string $merchantCountry = null,
        ?string $merchantName = null,
        ?int $purchaseAmount = null,
        RequestOptions|array|null $requestOptions = null,
    ): CardPayment;

    /**
     * @api
     *
     * @param string $cardPaymentID the identifier of the Card Payment to be challenged
     * @param string $oneTimeCode the one-time code to be validated
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function challengeAttempts(
        string $cardPaymentID,
        string $oneTimeCode,
        RequestOptions|array|null $requestOptions = null,
    ): CardPayment;

    /**
     * @api
     *
     * @param string $cardPaymentID the identifier of the Card Payment to be challenged
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function challenges(
        string $cardPaymentID,
        RequestOptions|array|null $requestOptions = null
    ): CardPayment;
}
