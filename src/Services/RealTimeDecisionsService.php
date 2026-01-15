<?php

declare(strict_types=1);

namespace Increase\Services;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\RealTimeDecisions\RealTimeDecision;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthentication;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthenticationChallenge;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardBalanceInquiry;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletAuthentication;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletToken;
use Increase\RequestOptions;
use Increase\ServiceContracts\RealTimeDecisionsContract;

/**
 * @phpstan-import-type CardAuthenticationShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthentication
 * @phpstan-import-type CardAuthenticationChallengeShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthenticationChallenge
 * @phpstan-import-type CardAuthorizationShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization
 * @phpstan-import-type CardBalanceInquiryShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardBalanceInquiry
 * @phpstan-import-type DigitalWalletAuthenticationShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletAuthentication
 * @phpstan-import-type DigitalWalletTokenShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletToken
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class RealTimeDecisionsService implements RealTimeDecisionsContract
{
    /**
     * @api
     */
    public RealTimeDecisionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RealTimeDecisionsRawService($client);
    }

    /**
     * @api
     *
     * Retrieve a Real-Time Decision
     *
     * @param string $realTimeDecisionID the identifier of the Real-Time Decision
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $realTimeDecisionID,
        RequestOptions|array|null $requestOptions = null
    ): RealTimeDecision {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($realTimeDecisionID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Action a Real-Time Decision
     *
     * @param string $realTimeDecisionID the identifier of the Real-Time Decision
     * @param CardAuthentication|CardAuthenticationShape $cardAuthentication if the Real-Time Decision relates to a 3DS card authentication attempt, this object contains your response to the authentication
     * @param CardAuthenticationChallenge|CardAuthenticationChallengeShape $cardAuthenticationChallenge if the Real-Time Decision relates to 3DS card authentication challenge delivery, this object contains your response
     * @param CardAuthorization|CardAuthorizationShape $cardAuthorization if the Real-Time Decision relates to a card authorization attempt, this object contains your response to the authorization
     * @param CardBalanceInquiry|CardBalanceInquiryShape $cardBalanceInquiry if the Real-Time Decision relates to a card balance inquiry attempt, this object contains your response to the inquiry
     * @param DigitalWalletAuthentication|DigitalWalletAuthenticationShape $digitalWalletAuthentication if the Real-Time Decision relates to a digital wallet authentication attempt, this object contains your response to the authentication
     * @param DigitalWalletToken|DigitalWalletTokenShape $digitalWalletToken if the Real-Time Decision relates to a digital wallet token provisioning attempt, this object contains your response to the attempt
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function action(
        string $realTimeDecisionID,
        CardAuthentication|array|null $cardAuthentication = null,
        CardAuthenticationChallenge|array|null $cardAuthenticationChallenge = null,
        CardAuthorization|array|null $cardAuthorization = null,
        CardBalanceInquiry|array|null $cardBalanceInquiry = null,
        DigitalWalletAuthentication|array|null $digitalWalletAuthentication = null,
        DigitalWalletToken|array|null $digitalWalletToken = null,
        RequestOptions|array|null $requestOptions = null,
    ): RealTimeDecision {
        $params = Util::removeNulls(
            [
                'cardAuthentication' => $cardAuthentication,
                'cardAuthenticationChallenge' => $cardAuthenticationChallenge,
                'cardAuthorization' => $cardAuthorization,
                'cardBalanceInquiry' => $cardBalanceInquiry,
                'digitalWalletAuthentication' => $digitalWalletAuthentication,
                'digitalWalletToken' => $digitalWalletToken,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->action($realTimeDecisionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
