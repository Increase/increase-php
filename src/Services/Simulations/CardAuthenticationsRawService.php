<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CardPayments\CardPayment;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardAuthenticationsRawContract;
use Increase\Simulations\CardAuthentications\CardAuthenticationChallengeAttemptsParams;
use Increase\Simulations\CardAuthentications\CardAuthenticationCreateParams;
use Increase\Simulations\CardAuthentications\CardAuthenticationCreateParams\Category;
use Increase\Simulations\CardAuthentications\CardAuthenticationCreateParams\DeviceChannel;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardAuthenticationsRawService implements CardAuthenticationsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates a Card Authentication attempt on a [Card](#cards). The attempt always results in a [Card Payment](#card_payments) being created, either with a status that allows further action or a terminal failed status.
     *
     * @param array{
     *   cardID: string,
     *   category?: Category|value-of<Category>,
     *   deviceChannel?: DeviceChannel|value-of<DeviceChannel>,
     *   merchantAcceptorID?: string,
     *   merchantCategoryCode?: string,
     *   merchantCountry?: string,
     *   merchantName?: string,
     *   purchaseAmount?: int,
     * }|CardAuthenticationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPayment>
     *
     * @throws APIException
     */
    public function create(
        array|CardAuthenticationCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardAuthenticationCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/card_authentications',
            body: (object) $parsed,
            options: $options,
            convert: CardPayment::class,
        );
    }

    /**
     * @api
     *
     * Simulates an attempt at a Card Authentication Challenge. This updates the `card_authentications` object under the [Card Payment](#card_payments). You can also attempt the challenge by navigating to https://dashboard.increase.com/card_authentication_simulation/:card_payment_id.
     *
     * @param string $cardPaymentID the identifier of the Card Payment to be challenged
     * @param array{
     *   oneTimeCode: string
     * }|CardAuthenticationChallengeAttemptsParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPayment>
     *
     * @throws APIException
     */
    public function challengeAttempts(
        string $cardPaymentID,
        array|CardAuthenticationChallengeAttemptsParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardAuthenticationChallengeAttemptsParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'simulations/card_authentications/%1$s/challenge_attempts',
                $cardPaymentID,
            ],
            body: (object) $parsed,
            options: $options,
            convert: CardPayment::class,
        );
    }

    /**
     * @api
     *
     * Simulates starting a Card Authentication Challenge for an existing Card Authentication. This updates the `card_authentications` object under the [Card Payment](#card_payments). To attempt the challenge, use the `/simulations/card_authentications/:card_payment_id/challenge_attempts` endpoint or navigate to https://dashboard.increase.com/card_authentication_simulation/:card_payment_id.
     *
     * @param string $cardPaymentID the identifier of the Card Payment to be challenged
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPayment>
     *
     * @throws APIException
     */
    public function challenges(
        string $cardPaymentID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                'simulations/card_authentications/%1$s/challenges', $cardPaymentID,
            ],
            options: $requestOptions,
            convert: CardPayment::class,
        );
    }
}
