<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokens\DigitalWalletToken;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The token requestor.
 *
 * @phpstan-type TokenRequestorDetailsShape = array{
 *   identifier: string, name: string|null
 * }
 */
final class TokenRequestorDetails implements BaseModel
{
    /** @use SdkModel<TokenRequestorDetailsShape> */
    use SdkModel;

    /**
     * The token requestor identifier.
     */
    #[Required]
    public string $identifier;

    /**
     * The token requestor name, for example "Apple Inc.".
     */
    #[Required]
    public ?string $name;

    /**
     * `new TokenRequestorDetails()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TokenRequestorDetails::with(identifier: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TokenRequestorDetails)->withIdentifier(...)->withName(...)
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
     */
    public static function with(string $identifier, ?string $name): self
    {
        $self = new self;

        $self['identifier'] = $identifier;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The token requestor identifier.
     */
    public function withIdentifier(string $identifier): self
    {
        $self = clone $this;
        $self['identifier'] = $identifier;

        return $self;
    }

    /**
     * The token requestor name, for example "Apple Inc.".
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
