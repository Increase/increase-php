<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokens\DigitalWalletToken;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The redacted Dynamic Primary Account Number.
 *
 * @phpstan-type DynamicPrimaryAccountNumberShape = array{
 *   first6: string, last4: string
 * }
 */
final class DynamicPrimaryAccountNumber implements BaseModel
{
    /** @use SdkModel<DynamicPrimaryAccountNumberShape> */
    use SdkModel;

    /**
     * The first 6 digits of the token's Dynamic Primary Account Number.
     */
    #[Required]
    public string $first6;

    /**
     * The last 4 digits of the token's Dynamic Primary Account Number.
     */
    #[Required]
    public string $last4;

    /**
     * `new DynamicPrimaryAccountNumber()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DynamicPrimaryAccountNumber::with(first6: ..., last4: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DynamicPrimaryAccountNumber)->withFirst6(...)->withLast4(...)
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
    public static function with(string $first6, string $last4): self
    {
        $self = new self;

        $self['first6'] = $first6;
        $self['last4'] = $last4;

        return $self;
    }

    /**
     * The first 6 digits of the token's Dynamic Primary Account Number.
     */
    public function withFirst6(string $first6): self
    {
        $self = clone $this;
        $self['first6'] = $first6;

        return $self;
    }

    /**
     * The last 4 digits of the token's Dynamic Primary Account Number.
     */
    public function withLast4(string $last4): self
    {
        $self = clone $this;
        $self['last4'] = $last4;

        return $self;
    }
}
