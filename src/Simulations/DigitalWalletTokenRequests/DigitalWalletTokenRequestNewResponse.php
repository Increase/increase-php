<?php

declare(strict_types=1);

namespace Increase\Simulations\DigitalWalletTokenRequests;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\DigitalWalletTokenRequests\DigitalWalletTokenRequestNewResponse\DeclineReason;
use Increase\Simulations\DigitalWalletTokenRequests\DigitalWalletTokenRequestNewResponse\Type;

/**
 * The results of a Digital Wallet Token simulation.
 *
 * @phpstan-type DigitalWalletTokenRequestNewResponseShape = array{
 *   declineReason: null|DeclineReason|value-of<DeclineReason>,
 *   digitalWalletTokenID: string|null,
 *   type: Type|value-of<Type>,
 * }
 */
final class DigitalWalletTokenRequestNewResponse implements BaseModel
{
    /** @use SdkModel<DigitalWalletTokenRequestNewResponseShape> */
    use SdkModel;

    /**
     * If the simulated tokenization attempt was declined, this field contains details as to why.
     *
     * @var value-of<DeclineReason>|null $declineReason
     */
    #[Required('decline_reason', enum: DeclineReason::class)]
    public ?string $declineReason;

    /**
     * If the simulated tokenization attempt was accepted, this field contains the id of the Digital Wallet Token that was created.
     */
    #[Required('digital_wallet_token_id')]
    public ?string $digitalWalletTokenID;

    /**
     * A constant representing the object's type. For this resource it will always be `inbound_digital_wallet_token_request_simulation_result`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new DigitalWalletTokenRequestNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigitalWalletTokenRequestNewResponse::with(
     *   declineReason: ..., digitalWalletTokenID: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigitalWalletTokenRequestNewResponse)
     *   ->withDeclineReason(...)
     *   ->withDigitalWalletTokenID(...)
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
     * @param DeclineReason|value-of<DeclineReason>|null $declineReason
     * @param Type|value-of<Type> $type
     */
    public static function with(
        DeclineReason|string|null $declineReason,
        ?string $digitalWalletTokenID,
        Type|string $type,
    ): self {
        $self = new self;

        $self['declineReason'] = $declineReason;
        $self['digitalWalletTokenID'] = $digitalWalletTokenID;
        $self['type'] = $type;

        return $self;
    }

    /**
     * If the simulated tokenization attempt was declined, this field contains details as to why.
     *
     * @param DeclineReason|value-of<DeclineReason>|null $declineReason
     */
    public function withDeclineReason(
        DeclineReason|string|null $declineReason
    ): self {
        $self = clone $this;
        $self['declineReason'] = $declineReason;

        return $self;
    }

    /**
     * If the simulated tokenization attempt was accepted, this field contains the id of the Digital Wallet Token that was created.
     */
    public function withDigitalWalletTokenID(
        ?string $digitalWalletTokenID
    ): self {
        $self = clone $this;
        $self['digitalWalletTokenID'] = $digitalWalletTokenID;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `inbound_digital_wallet_token_request_simulation_result`.
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
