<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CardDisputes\CardDispute;
use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardDisputesContract;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Network;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa;

/**
 * @phpstan-import-type VisaShape from \Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardDisputesService implements CardDisputesContract
{
    /**
     * @api
     */
    public CardDisputesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new CardDisputesRawService($client);
    }

    /**
     * @api
     *
     * After a [Card Dispute](#card-disputes) is created in production, the dispute will initially be in a `pending_user_submission_reviewing` state. Since no review or further action happens in sandbox, this endpoint simulates moving a Card Dispute through its various states.
     *
     * @param string $cardDisputeID the dispute you would like to action
     * @param Network|value-of<Network> $network The network of the Card Dispute. Details specific to the network are required under the sub-object with the same identifier as the network.
     * @param Visa|VisaShape $visa The Visa-specific parameters for the taking action on the dispute. Required if and only if `network` is `visa`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function action(
        string $cardDisputeID,
        Network|string $network,
        Visa|array|null $visa = null,
        RequestOptions|array|null $requestOptions = null,
    ): CardDispute {
        $params = Util::removeNulls(['network' => $network, 'visa' => $visa]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->action($cardDisputeID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
