<?php

declare(strict_types=1);

namespace Increase\ServiceContracts\Simulations;

use Increase\CardDisputes\CardDispute;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Network;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa;

/**
 * @phpstan-import-type VisaShape from \Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface CardDisputesContract
{
    /**
     * @api
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
    ): CardDispute;
}
