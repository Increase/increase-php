<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\Decision;

/**
 * Fields related to a 3DS authentication attempt.
 *
 * @phpstan-type CardAuthenticationShape = array{
 *   accountID: string,
 *   cardID: string,
 *   decision: null|Decision|value-of<Decision>,
 *   upcomingCardPaymentID: string,
 * }
 */
final class CardAuthentication implements BaseModel
{
    /** @use SdkModel<CardAuthenticationShape> */
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
     * Whether or not the authentication attempt was approved.
     *
     * @var value-of<Decision>|null $decision
     */
    #[Required(enum: Decision::class)]
    public ?string $decision;

    /**
     * The identifier of the Card Payment this authentication attempt will belong to. Available in the API once the card authentication has completed.
     */
    #[Required('upcoming_card_payment_id')]
    public string $upcomingCardPaymentID;

    /**
     * `new CardAuthentication()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardAuthentication::with(
     *   accountID: ..., cardID: ..., decision: ..., upcomingCardPaymentID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardAuthentication)
     *   ->withAccountID(...)
     *   ->withCardID(...)
     *   ->withDecision(...)
     *   ->withUpcomingCardPaymentID(...)
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
     * @param Decision|value-of<Decision>|null $decision
     */
    public static function with(
        string $accountID,
        string $cardID,
        Decision|string|null $decision,
        string $upcomingCardPaymentID,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['cardID'] = $cardID;
        $self['decision'] = $decision;
        $self['upcomingCardPaymentID'] = $upcomingCardPaymentID;

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
     * Whether or not the authentication attempt was approved.
     *
     * @param Decision|value-of<Decision>|null $decision
     */
    public function withDecision(Decision|string|null $decision): self
    {
        $self = clone $this;
        $self['decision'] = $decision;

        return $self;
    }

    /**
     * The identifier of the Card Payment this authentication attempt will belong to. Available in the API once the card authentication has completed.
     */
    public function withUpcomingCardPaymentID(
        string $upcomingCardPaymentID
    ): self {
        $self = clone $this;
        $self['upcomingCardPaymentID'] = $upcomingCardPaymentID;

        return $self;
    }
}
