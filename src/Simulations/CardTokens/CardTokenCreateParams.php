<?php

declare(strict_types=1);

namespace Increase\Simulations\CardTokens;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\CardTokens\CardTokenCreateParams\Capability;

/**
 * Simulates tokenizing a card in the sandbox environment.
 *
 * @see Increase\Services\Simulations\CardTokensService::create()
 *
 * @phpstan-import-type CapabilityShape from \Increase\Simulations\CardTokens\CardTokenCreateParams\Capability
 *
 * @phpstan-type CardTokenCreateParamsShape = array{
 *   capabilities?: list<Capability|CapabilityShape>|null,
 *   expiration?: string|null,
 *   last4?: string|null,
 *   prefix?: string|null,
 *   primaryAccountNumberLength?: int|null,
 * }
 */
final class CardTokenCreateParams implements BaseModel
{
    /** @use SdkModel<CardTokenCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The capabilities of the outbound card token.
     *
     * @var list<Capability>|null $capabilities
     */
    #[Optional(list: Capability::class)]
    public ?array $capabilities;

    /**
     * The expiration date of the card.
     */
    #[Optional]
    public ?string $expiration;

    /**
     * The last 4 digits of the card number.
     */
    #[Optional]
    public ?string $last4;

    /**
     * The prefix of the card number, usually the first 8 digits.
     */
    #[Optional]
    public ?string $prefix;

    /**
     * The total length of the card number, including prefix and last4.
     */
    #[Optional('primary_account_number_length')]
    public ?int $primaryAccountNumberLength;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Capability|CapabilityShape>|null $capabilities
     */
    public static function with(
        ?array $capabilities = null,
        ?string $expiration = null,
        ?string $last4 = null,
        ?string $prefix = null,
        ?int $primaryAccountNumberLength = null,
    ): self {
        $self = new self;

        null !== $capabilities && $self['capabilities'] = $capabilities;
        null !== $expiration && $self['expiration'] = $expiration;
        null !== $last4 && $self['last4'] = $last4;
        null !== $prefix && $self['prefix'] = $prefix;
        null !== $primaryAccountNumberLength && $self['primaryAccountNumberLength'] = $primaryAccountNumberLength;

        return $self;
    }

    /**
     * The capabilities of the outbound card token.
     *
     * @param list<Capability|CapabilityShape> $capabilities
     */
    public function withCapabilities(array $capabilities): self
    {
        $self = clone $this;
        $self['capabilities'] = $capabilities;

        return $self;
    }

    /**
     * The expiration date of the card.
     */
    public function withExpiration(string $expiration): self
    {
        $self = clone $this;
        $self['expiration'] = $expiration;

        return $self;
    }

    /**
     * The last 4 digits of the card number.
     */
    public function withLast4(string $last4): self
    {
        $self = clone $this;
        $self['last4'] = $last4;

        return $self;
    }

    /**
     * The prefix of the card number, usually the first 8 digits.
     */
    public function withPrefix(string $prefix): self
    {
        $self = clone $this;
        $self['prefix'] = $prefix;

        return $self;
    }

    /**
     * The total length of the card number, including prefix and last4.
     */
    public function withPrimaryAccountNumberLength(
        int $primaryAccountNumberLength
    ): self {
        $self = clone $this;
        $self['primaryAccountNumberLength'] = $primaryAccountNumberLength;

        return $self;
    }
}
