<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CardPayments\CardPayment;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardReversalsContract;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardReversalsService implements CardReversalsContract
{
    /**
     * @api
     */
    public CardReversalsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CardReversalsRawService($client);
    }

    /**
     * @api
     *
     * Simulates the reversal of an authorization by a card acquirer. An authorization can be partially reversed multiple times, up until the total authorized amount. Marks the pending transaction as complete if the authorization is fully reversed.
     *
     * @param string $cardPaymentID the identifier of the Card Payment to create a reversal on
     * @param int $amount The amount of the reversal in minor units in the card authorization's currency. This defaults to the authorization amount.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $cardPaymentID,
        ?int $amount = null,
        RequestOptions|array|null $requestOptions = null,
    ): CardPayment {
        $params = Util::removeNulls(
            ['cardPaymentID' => $cardPaymentID, 'amount' => $amount]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
