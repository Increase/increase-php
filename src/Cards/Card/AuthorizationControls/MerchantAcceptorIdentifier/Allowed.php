<?php

declare(strict_types=1);

namespace Increase\Cards\Card\AuthorizationControls\MerchantAcceptorIdentifier;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type AllowedShape = array{identifier: string}
 */
final class Allowed implements BaseModel
{
    /** @use SdkModel<AllowedShape> */
    use SdkModel;

    /**
     * The Merchant Acceptor ID.
     */
    #[Required]
    public string $identifier;

    /**
     * `new Allowed()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Allowed::with(identifier: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Allowed)->withIdentifier(...)
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
    public static function with(string $identifier): self
    {
        $self = new self;

        $self['identifier'] = $identifier;

        return $self;
    }

    /**
     * The Merchant Acceptor ID.
     */
    public function withIdentifier(string $identifier): self
    {
        $self = clone $this;
        $self['identifier'] = $identifier;

        return $self;
    }
}
