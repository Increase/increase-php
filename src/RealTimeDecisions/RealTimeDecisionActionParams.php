<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthentication;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthenticationChallenge;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardBalanceInquiry;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletAuthentication;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletToken;

/**
 * Action a Real-Time Decision.
 *
 * @see Increase\Services\RealTimeDecisionsService::action()
 *
 * @phpstan-import-type CardAuthenticationShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthentication
 * @phpstan-import-type CardAuthenticationChallengeShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthenticationChallenge
 * @phpstan-import-type CardAuthorizationShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization
 * @phpstan-import-type CardBalanceInquiryShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardBalanceInquiry
 * @phpstan-import-type DigitalWalletAuthenticationShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletAuthentication
 * @phpstan-import-type DigitalWalletTokenShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletToken
 *
 * @phpstan-type RealTimeDecisionActionParamsShape = array{
 *   cardAuthentication?: null|CardAuthentication|CardAuthenticationShape,
 *   cardAuthenticationChallenge?: null|CardAuthenticationChallenge|CardAuthenticationChallengeShape,
 *   cardAuthorization?: null|CardAuthorization|CardAuthorizationShape,
 *   cardBalanceInquiry?: null|CardBalanceInquiry|CardBalanceInquiryShape,
 *   digitalWalletAuthentication?: null|DigitalWalletAuthentication|DigitalWalletAuthenticationShape,
 *   digitalWalletToken?: null|DigitalWalletToken|DigitalWalletTokenShape,
 * }
 */
final class RealTimeDecisionActionParams implements BaseModel
{
    /** @use SdkModel<RealTimeDecisionActionParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * If the Real-Time Decision relates to a 3DS card authentication attempt, this object contains your response to the authentication.
     */
    #[Optional('card_authentication')]
    public ?CardAuthentication $cardAuthentication;

    /**
     * If the Real-Time Decision relates to 3DS card authentication challenge delivery, this object contains your response.
     */
    #[Optional('card_authentication_challenge')]
    public ?CardAuthenticationChallenge $cardAuthenticationChallenge;

    /**
     * If the Real-Time Decision relates to a card authorization attempt, this object contains your response to the authorization.
     */
    #[Optional('card_authorization')]
    public ?CardAuthorization $cardAuthorization;

    /**
     * If the Real-Time Decision relates to a card balance inquiry attempt, this object contains your response to the inquiry.
     */
    #[Optional('card_balance_inquiry')]
    public ?CardBalanceInquiry $cardBalanceInquiry;

    /**
     * If the Real-Time Decision relates to a digital wallet authentication attempt, this object contains your response to the authentication.
     */
    #[Optional('digital_wallet_authentication')]
    public ?DigitalWalletAuthentication $digitalWalletAuthentication;

    /**
     * If the Real-Time Decision relates to a digital wallet token provisioning attempt, this object contains your response to the attempt.
     */
    #[Optional('digital_wallet_token')]
    public ?DigitalWalletToken $digitalWalletToken;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param CardAuthentication|CardAuthenticationShape|null $cardAuthentication
     * @param CardAuthenticationChallenge|CardAuthenticationChallengeShape|null $cardAuthenticationChallenge
     * @param CardAuthorization|CardAuthorizationShape|null $cardAuthorization
     * @param CardBalanceInquiry|CardBalanceInquiryShape|null $cardBalanceInquiry
     * @param DigitalWalletAuthentication|DigitalWalletAuthenticationShape|null $digitalWalletAuthentication
     * @param DigitalWalletToken|DigitalWalletTokenShape|null $digitalWalletToken
     */
    public static function with(
        CardAuthentication|array|null $cardAuthentication = null,
        CardAuthenticationChallenge|array|null $cardAuthenticationChallenge = null,
        CardAuthorization|array|null $cardAuthorization = null,
        CardBalanceInquiry|array|null $cardBalanceInquiry = null,
        DigitalWalletAuthentication|array|null $digitalWalletAuthentication = null,
        DigitalWalletToken|array|null $digitalWalletToken = null,
    ): self {
        $self = new self;

        null !== $cardAuthentication && $self['cardAuthentication'] = $cardAuthentication;
        null !== $cardAuthenticationChallenge && $self['cardAuthenticationChallenge'] = $cardAuthenticationChallenge;
        null !== $cardAuthorization && $self['cardAuthorization'] = $cardAuthorization;
        null !== $cardBalanceInquiry && $self['cardBalanceInquiry'] = $cardBalanceInquiry;
        null !== $digitalWalletAuthentication && $self['digitalWalletAuthentication'] = $digitalWalletAuthentication;
        null !== $digitalWalletToken && $self['digitalWalletToken'] = $digitalWalletToken;

        return $self;
    }

    /**
     * If the Real-Time Decision relates to a 3DS card authentication attempt, this object contains your response to the authentication.
     *
     * @param CardAuthentication|CardAuthenticationShape $cardAuthentication
     */
    public function withCardAuthentication(
        CardAuthentication|array $cardAuthentication
    ): self {
        $self = clone $this;
        $self['cardAuthentication'] = $cardAuthentication;

        return $self;
    }

    /**
     * If the Real-Time Decision relates to 3DS card authentication challenge delivery, this object contains your response.
     *
     * @param CardAuthenticationChallenge|CardAuthenticationChallengeShape $cardAuthenticationChallenge
     */
    public function withCardAuthenticationChallenge(
        CardAuthenticationChallenge|array $cardAuthenticationChallenge
    ): self {
        $self = clone $this;
        $self['cardAuthenticationChallenge'] = $cardAuthenticationChallenge;

        return $self;
    }

    /**
     * If the Real-Time Decision relates to a card authorization attempt, this object contains your response to the authorization.
     *
     * @param CardAuthorization|CardAuthorizationShape $cardAuthorization
     */
    public function withCardAuthorization(
        CardAuthorization|array $cardAuthorization
    ): self {
        $self = clone $this;
        $self['cardAuthorization'] = $cardAuthorization;

        return $self;
    }

    /**
     * If the Real-Time Decision relates to a card balance inquiry attempt, this object contains your response to the inquiry.
     *
     * @param CardBalanceInquiry|CardBalanceInquiryShape $cardBalanceInquiry
     */
    public function withCardBalanceInquiry(
        CardBalanceInquiry|array $cardBalanceInquiry
    ): self {
        $self = clone $this;
        $self['cardBalanceInquiry'] = $cardBalanceInquiry;

        return $self;
    }

    /**
     * If the Real-Time Decision relates to a digital wallet authentication attempt, this object contains your response to the authentication.
     *
     * @param DigitalWalletAuthentication|DigitalWalletAuthenticationShape $digitalWalletAuthentication
     */
    public function withDigitalWalletAuthentication(
        DigitalWalletAuthentication|array $digitalWalletAuthentication
    ): self {
        $self = clone $this;
        $self['digitalWalletAuthentication'] = $digitalWalletAuthentication;

        return $self;
    }

    /**
     * If the Real-Time Decision relates to a digital wallet token provisioning attempt, this object contains your response to the attempt.
     *
     * @param DigitalWalletToken|DigitalWalletTokenShape $digitalWalletToken
     */
    public function withDigitalWalletToken(
        DigitalWalletToken|array $digitalWalletToken
    ): self {
        $self = clone $this;
        $self['digitalWalletToken'] = $digitalWalletToken;

        return $self;
    }
}
