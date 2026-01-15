<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardAuthorizationsRawContract;
use Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams;
use Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams\DeclineReason;
use Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams\NetworkDetails;
use Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams\ProcessingCategory;
use Increase\Simulations\CardAuthorizations\CardAuthorizationNewResponse;

/**
 * @phpstan-import-type NetworkDetailsShape from \Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams\NetworkDetails
 * @phpstan-import-type ProcessingCategoryShape from \Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams\ProcessingCategory
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardAuthorizationsRawService implements CardAuthorizationsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates a purchase authorization on a [Card](#cards). Depending on the balance available to the card and the `amount` submitted, the authorization activity will result in a [Pending Transaction](#pending-transactions) of type `card_authorization` or a [Declined Transaction](#declined-transactions) of type `card_decline`. You can pass either a Card id or a [Digital Wallet Token](#digital-wallet-tokens) id to simulate the two different ways purchases can be made.
     *
     * @param array{
     *   amount: int,
     *   authenticatedCardPaymentID?: string,
     *   cardID?: string,
     *   declineReason?: value-of<DeclineReason>,
     *   digitalWalletTokenID?: string,
     *   eventSubscriptionID?: string,
     *   merchantAcceptorID?: string,
     *   merchantCategoryCode?: string,
     *   merchantCity?: string,
     *   merchantCountry?: string,
     *   merchantDescriptor?: string,
     *   merchantState?: string,
     *   networkDetails?: NetworkDetails|NetworkDetailsShape,
     *   networkRiskScore?: int,
     *   physicalCardID?: string,
     *   processingCategory?: ProcessingCategory|ProcessingCategoryShape,
     *   terminalID?: string,
     * }|CardAuthorizationCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardAuthorizationNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|CardAuthorizationCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardAuthorizationCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/card_authorizations',
            body: (object) $parsed,
            options: $options,
            convert: CardAuthorizationNewResponse::class,
        );
    }
}
