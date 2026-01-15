<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CardDisputes\CardDispute;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardDisputesRawContract;
use Increase\Simulations\CardDisputes\CardDisputeActionParams;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Network;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa;

/**
 * @phpstan-import-type VisaShape from \Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardDisputesRawService implements CardDisputesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * After a [Card Dispute](#card-disputes) is created in production, the dispute will initially be in a `pending_user_submission_reviewing` state. Since no review or further action happens in sandbox, this endpoint simulates moving a Card Dispute through its various states.
     *
     * @param string $cardDisputeID the dispute you would like to action
     * @param array{
     *   network: Network|value-of<Network>, visa?: Visa|VisaShape
     * }|CardDisputeActionParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardDispute>
     *
     * @throws APIException
     */
    public function action(
        string $cardDisputeID,
        array|CardDisputeActionParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardDisputeActionParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['simulations/card_disputes/%1$s/action', $cardDisputeID],
            body: (object) $parsed,
            options: $options,
            convert: CardDispute::class,
        );
    }
}
