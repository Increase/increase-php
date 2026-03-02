<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CardPayments\CardPayment;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardAuthenticationsContract;
use Increase\Simulations\CardAuthentications\CardAuthenticationCreateParams\Category;
use Increase\Simulations\CardAuthentications\CardAuthenticationCreateParams\DeviceChannel;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardAuthenticationsService implements CardAuthenticationsContract
{
    /**
     * @api
     */
    public CardAuthenticationsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CardAuthenticationsRawService($client);
    }

    /**
     * @api
     *
     * Simulates a Card Authentication attempt on a [Card](#cards). The attempt always results in a [Card Payment](#card_payments) being created, either with a status that allows further action or a terminal failed status.
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
    ): CardPayment {
        $params = Util::removeNulls(
            [
                'cardID' => $cardID,
                'category' => $category,
                'deviceChannel' => $deviceChannel,
                'merchantAcceptorID' => $merchantAcceptorID,
                'merchantCategoryCode' => $merchantCategoryCode,
                'merchantCountry' => $merchantCountry,
                'merchantName' => $merchantName,
                'purchaseAmount' => $purchaseAmount,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Simulates an attempt at a Card Authentication Challenge. This updates the `card_authentications` object under the [Card Payment](#card_payments). You can also attempt the challenge by navigating to https://dashboard.increase.com/card_authentication_simulation/:card_payment_id.
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
    ): CardPayment {
        $params = Util::removeNulls(['oneTimeCode' => $oneTimeCode]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->challengeAttempts($cardPaymentID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Simulates starting a Card Authentication Challenge for an existing Card Authentication. This updates the `card_authentications` object under the [Card Payment](#card_payments). To attempt the challenge, use the `/simulations/card_authentications/:card_payment_id/challenge_attempts` endpoint or navigate to https://dashboard.increase.com/card_authentication_simulation/:card_payment_id.
     *
     * @param string $cardPaymentID the identifier of the Card Payment to be challenged
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function challenges(
        string $cardPaymentID,
        RequestOptions|array|null $requestOptions = null
    ): CardPayment {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->challenges($cardPaymentID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
