<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RealTimeDecisions\RealTimeDecision;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthentication;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthenticationChallenge;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardBalanceInquiry;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletAuthentication;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletToken;
use Increase\RequestOptions;
use Increase\ServiceContracts\RealTimeDecisionsRawContract;

/**
 * @phpstan-import-type CardAuthenticationShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthentication
 * @phpstan-import-type CardAuthenticationChallengeShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthenticationChallenge
 * @phpstan-import-type CardAuthorizationShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization
 * @phpstan-import-type CardBalanceInquiryShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardBalanceInquiry
 * @phpstan-import-type DigitalWalletAuthenticationShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletAuthentication
 * @phpstan-import-type DigitalWalletTokenShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletToken
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class RealTimeDecisionsRawService implements RealTimeDecisionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Retrieve a Real-Time Decision
     *
     * @param string $realTimeDecisionID the identifier of the Real-Time Decision
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RealTimeDecision>
     *
     * @throws APIException
     */
    public function retrieve(
        string $realTimeDecisionID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['real_time_decisions/%1$s', $realTimeDecisionID],
            options: $requestOptions,
            convert: RealTimeDecision::class,
        );
    }

    /**
     * @api
     *
     * Action a Real-Time Decision
     *
     * @param string $realTimeDecisionID the identifier of the Real-Time Decision
     * @param array{
     *   cardAuthentication?: CardAuthentication|CardAuthenticationShape,
     *   cardAuthenticationChallenge?: CardAuthenticationChallenge|CardAuthenticationChallengeShape,
     *   cardAuthorization?: CardAuthorization|CardAuthorizationShape,
     *   cardBalanceInquiry?: CardBalanceInquiry|CardBalanceInquiryShape,
     *   digitalWalletAuthentication?: DigitalWalletAuthentication|DigitalWalletAuthenticationShape,
     *   digitalWalletToken?: DigitalWalletToken|DigitalWalletTokenShape,
     * }|RealTimeDecisionActionParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RealTimeDecision>
     *
     * @throws APIException
     */
    public function action(
        string $realTimeDecisionID,
        array|RealTimeDecisionActionParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RealTimeDecisionActionParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['real_time_decisions/%1$s/action', $realTimeDecisionID],
            body: (object) $parsed,
            options: $options,
            convert: RealTimeDecision::class,
        );
    }
}
