<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthenticationChallenge;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization;
use Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry;
use Increase\RealTimeDecisions\RealTimeDecision\Category;
use Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletAuthentication;
use Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken;
use Increase\RealTimeDecisions\RealTimeDecision\Status;
use Increase\RealTimeDecisions\RealTimeDecision\Type;

/**
 * Real Time Decisions are created when your application needs to take action in real-time to some event such as a card authorization. For more information, see our [Real-Time Decisions guide](https://increase.com/documentation/real-time-decisions).
 *
 * @phpstan-import-type CardAuthenticationShape from \Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication
 * @phpstan-import-type CardAuthenticationChallengeShape from \Increase\RealTimeDecisions\RealTimeDecision\CardAuthenticationChallenge
 * @phpstan-import-type CardAuthorizationShape from \Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization
 * @phpstan-import-type CardBalanceInquiryShape from \Increase\RealTimeDecisions\RealTimeDecision\CardBalanceInquiry
 * @phpstan-import-type DigitalWalletAuthenticationShape from \Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletAuthentication
 * @phpstan-import-type DigitalWalletTokenShape from \Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken
 *
 * @phpstan-type RealTimeDecisionShape = array{
 *   id: string,
 *   cardAuthentication: null|CardAuthentication|CardAuthenticationShape,
 *   cardAuthenticationChallenge: null|CardAuthenticationChallenge|CardAuthenticationChallengeShape,
 *   cardAuthorization: null|CardAuthorization|CardAuthorizationShape,
 *   cardBalanceInquiry: null|CardBalanceInquiry|CardBalanceInquiryShape,
 *   category: Category|value-of<Category>,
 *   createdAt: \DateTimeInterface,
 *   digitalWalletAuthentication: null|DigitalWalletAuthentication|DigitalWalletAuthenticationShape,
 *   digitalWalletToken: null|DigitalWalletToken|DigitalWalletTokenShape,
 *   status: Status|value-of<Status>,
 *   timeoutAt: \DateTimeInterface,
 *   type: Type|value-of<Type>,
 * }
 */
final class RealTimeDecision implements BaseModel
{
    /** @use SdkModel<RealTimeDecisionShape> */
    use SdkModel;

    /**
     * The Real-Time Decision identifier.
     */
    #[Required]
    public string $id;

    /**
     * Fields related to a 3DS authentication attempt.
     */
    #[Required('card_authentication')]
    public ?CardAuthentication $cardAuthentication;

    /**
     * Fields related to a 3DS authentication attempt.
     */
    #[Required('card_authentication_challenge')]
    public ?CardAuthenticationChallenge $cardAuthenticationChallenge;

    /**
     * Fields related to a card authorization.
     */
    #[Required('card_authorization')]
    public ?CardAuthorization $cardAuthorization;

    /**
     * Fields related to a card balance inquiry.
     */
    #[Required('card_balance_inquiry')]
    public ?CardBalanceInquiry $cardBalanceInquiry;

    /**
     * The category of the Real-Time Decision.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Real-Time Decision was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Fields related to a digital wallet authentication attempt.
     */
    #[Required('digital_wallet_authentication')]
    public ?DigitalWalletAuthentication $digitalWalletAuthentication;

    /**
     * Fields related to a digital wallet token provisioning attempt.
     */
    #[Required('digital_wallet_token')]
    public ?DigitalWalletToken $digitalWalletToken;

    /**
     * The status of the Real-Time Decision.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which your application can no longer respond to the Real-Time Decision.
     */
    #[Required('timeout_at')]
    public \DateTimeInterface $timeoutAt;

    /**
     * A constant representing the object's type. For this resource it will always be `real_time_decision`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new RealTimeDecision()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RealTimeDecision::with(
     *   id: ...,
     *   cardAuthentication: ...,
     *   cardAuthenticationChallenge: ...,
     *   cardAuthorization: ...,
     *   cardBalanceInquiry: ...,
     *   category: ...,
     *   createdAt: ...,
     *   digitalWalletAuthentication: ...,
     *   digitalWalletToken: ...,
     *   status: ...,
     *   timeoutAt: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RealTimeDecision)
     *   ->withID(...)
     *   ->withCardAuthentication(...)
     *   ->withCardAuthenticationChallenge(...)
     *   ->withCardAuthorization(...)
     *   ->withCardBalanceInquiry(...)
     *   ->withCategory(...)
     *   ->withCreatedAt(...)
     *   ->withDigitalWalletAuthentication(...)
     *   ->withDigitalWalletToken(...)
     *   ->withStatus(...)
     *   ->withTimeoutAt(...)
     *   ->withType(...)
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
     * @param CardAuthentication|CardAuthenticationShape|null $cardAuthentication
     * @param CardAuthenticationChallenge|CardAuthenticationChallengeShape|null $cardAuthenticationChallenge
     * @param CardAuthorization|CardAuthorizationShape|null $cardAuthorization
     * @param CardBalanceInquiry|CardBalanceInquiryShape|null $cardBalanceInquiry
     * @param Category|value-of<Category> $category
     * @param DigitalWalletAuthentication|DigitalWalletAuthenticationShape|null $digitalWalletAuthentication
     * @param DigitalWalletToken|DigitalWalletTokenShape|null $digitalWalletToken
     * @param Status|value-of<Status> $status
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        CardAuthentication|array|null $cardAuthentication,
        CardAuthenticationChallenge|array|null $cardAuthenticationChallenge,
        CardAuthorization|array|null $cardAuthorization,
        CardBalanceInquiry|array|null $cardBalanceInquiry,
        Category|string $category,
        \DateTimeInterface $createdAt,
        DigitalWalletAuthentication|array|null $digitalWalletAuthentication,
        DigitalWalletToken|array|null $digitalWalletToken,
        Status|string $status,
        \DateTimeInterface $timeoutAt,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['cardAuthentication'] = $cardAuthentication;
        $self['cardAuthenticationChallenge'] = $cardAuthenticationChallenge;
        $self['cardAuthorization'] = $cardAuthorization;
        $self['cardBalanceInquiry'] = $cardBalanceInquiry;
        $self['category'] = $category;
        $self['createdAt'] = $createdAt;
        $self['digitalWalletAuthentication'] = $digitalWalletAuthentication;
        $self['digitalWalletToken'] = $digitalWalletToken;
        $self['status'] = $status;
        $self['timeoutAt'] = $timeoutAt;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Real-Time Decision identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Fields related to a 3DS authentication attempt.
     *
     * @param CardAuthentication|CardAuthenticationShape|null $cardAuthentication
     */
    public function withCardAuthentication(
        CardAuthentication|array|null $cardAuthentication
    ): self {
        $self = clone $this;
        $self['cardAuthentication'] = $cardAuthentication;

        return $self;
    }

    /**
     * Fields related to a 3DS authentication attempt.
     *
     * @param CardAuthenticationChallenge|CardAuthenticationChallengeShape|null $cardAuthenticationChallenge
     */
    public function withCardAuthenticationChallenge(
        CardAuthenticationChallenge|array|null $cardAuthenticationChallenge
    ): self {
        $self = clone $this;
        $self['cardAuthenticationChallenge'] = $cardAuthenticationChallenge;

        return $self;
    }

    /**
     * Fields related to a card authorization.
     *
     * @param CardAuthorization|CardAuthorizationShape|null $cardAuthorization
     */
    public function withCardAuthorization(
        CardAuthorization|array|null $cardAuthorization
    ): self {
        $self = clone $this;
        $self['cardAuthorization'] = $cardAuthorization;

        return $self;
    }

    /**
     * Fields related to a card balance inquiry.
     *
     * @param CardBalanceInquiry|CardBalanceInquiryShape|null $cardBalanceInquiry
     */
    public function withCardBalanceInquiry(
        CardBalanceInquiry|array|null $cardBalanceInquiry
    ): self {
        $self = clone $this;
        $self['cardBalanceInquiry'] = $cardBalanceInquiry;

        return $self;
    }

    /**
     * The category of the Real-Time Decision.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(Category|string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the Real-Time Decision was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Fields related to a digital wallet authentication attempt.
     *
     * @param DigitalWalletAuthentication|DigitalWalletAuthenticationShape|null $digitalWalletAuthentication
     */
    public function withDigitalWalletAuthentication(
        DigitalWalletAuthentication|array|null $digitalWalletAuthentication
    ): self {
        $self = clone $this;
        $self['digitalWalletAuthentication'] = $digitalWalletAuthentication;

        return $self;
    }

    /**
     * Fields related to a digital wallet token provisioning attempt.
     *
     * @param DigitalWalletToken|DigitalWalletTokenShape|null $digitalWalletToken
     */
    public function withDigitalWalletToken(
        DigitalWalletToken|array|null $digitalWalletToken
    ): self {
        $self = clone $this;
        $self['digitalWalletToken'] = $digitalWalletToken;

        return $self;
    }

    /**
     * The status of the Real-Time Decision.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which your application can no longer respond to the Real-Time Decision.
     */
    public function withTimeoutAt(\DateTimeInterface $timeoutAt): self
    {
        $self = clone $this;
        $self['timeoutAt'] = $timeoutAt;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `real_time_decision`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
