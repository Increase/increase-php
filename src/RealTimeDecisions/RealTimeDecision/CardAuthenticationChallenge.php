<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthenticationChallenge\Result;

/**
 * Fields related to a 3DS authentication attempt.
 *
 * @phpstan-type CardAuthenticationChallengeShape = array{
 *   accountID: string,
 *   cardID: string,
 *   cardPaymentID: string,
 *   oneTimeCode: string,
 *   result: null|Result|value-of<Result>,
 * }
 */
final class CardAuthenticationChallenge implements BaseModel
{
    /** @use SdkModel<CardAuthenticationChallengeShape> */
    use SdkModel;

    /**
     * The identifier of the Account the card belongs to.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The identifier of the Card that is being tokenized.
     */
    #[Required('card_id')]
    public string $cardID;

    /**
     * The identifier of the Card Payment this authentication challenge attempt belongs to.
     */
    #[Required('card_payment_id')]
    public string $cardPaymentID;

    /**
     * The one-time code delivered to the cardholder.
     */
    #[Required('one_time_code')]
    public string $oneTimeCode;

    /**
     * Whether or not the challenge was delivered to the cardholder.
     *
     * @var value-of<Result>|null $result
     */
    #[Required(enum: Result::class)]
    public ?string $result;

    /**
     * `new CardAuthenticationChallenge()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardAuthenticationChallenge::with(
     *   accountID: ..., cardID: ..., cardPaymentID: ..., oneTimeCode: ..., result: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardAuthenticationChallenge)
     *   ->withAccountID(...)
     *   ->withCardID(...)
     *   ->withCardPaymentID(...)
     *   ->withOneTimeCode(...)
     *   ->withResult(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Result|value-of<Result>|null $result
     */
    public static function with(
        string $accountID,
        string $cardID,
        string $cardPaymentID,
        string $oneTimeCode,
        Result|string|null $result,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['cardID'] = $cardID;
        $self['cardPaymentID'] = $cardPaymentID;
        $self['oneTimeCode'] = $oneTimeCode;
        $self['result'] = $result;

        return $self;
    }

    /**
     * The identifier of the Account the card belongs to.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The identifier of the Card that is being tokenized.
     */
    public function withCardID(string $cardID): self
    {
        $self = clone $this;
        $self['cardID'] = $cardID;

        return $self;
    }

    /**
     * The identifier of the Card Payment this authentication challenge attempt belongs to.
     */
    public function withCardPaymentID(string $cardPaymentID): self
    {
        $self = clone $this;
        $self['cardPaymentID'] = $cardPaymentID;

        return $self;
    }

    /**
     * The one-time code delivered to the cardholder.
     */
    public function withOneTimeCode(string $oneTimeCode): self
    {
        $self = clone $this;
        $self['oneTimeCode'] = $oneTimeCode;

        return $self;
    }

    /**
     * Whether or not the challenge was delivered to the cardholder.
     *
     * @param Result|value-of<Result>|null $result
     */
    public function withResult(Result|string|null $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }
}
