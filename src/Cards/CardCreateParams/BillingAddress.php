<?php

declare(strict_types=1);

namespace Increase\Cards\CardCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The card's billing address.
 *
 * @phpstan-type BillingAddressShape = array{
 *   city: string,
 *   line1: string,
 *   postalCode: string,
 *   state: string,
 *   line2?: string|null,
 * }
 */
final class BillingAddress implements BaseModel
{
    /** @use SdkModel<BillingAddressShape> */
    use SdkModel;

    /**
     * The city of the billing address.
     */
    #[Required]
    public string $city;

    /**
     * The first line of the billing address.
     */
    #[Required]
    public string $line1;

    /**
     * The postal code of the billing address.
     */
    #[Required('postal_code')]
    public string $postalCode;

    /**
     * The US state of the billing address.
     */
    #[Required]
    public string $state;

    /**
     * The second line of the billing address.
     */
    #[Optional]
    public ?string $line2;

    /**
     * `new BillingAddress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BillingAddress::with(city: ..., line1: ..., postalCode: ..., state: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BillingAddress)
     *   ->withCity(...)
     *   ->withLine1(...)
     *   ->withPostalCode(...)
     *   ->withState(...)
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
    public static function with(
        string $city,
        string $line1,
        string $postalCode,
        string $state,
        ?string $line2 = null,
    ): self {
        $self = new self;

        $self['city'] = $city;
        $self['line1'] = $line1;
        $self['postalCode'] = $postalCode;
        $self['state'] = $state;

        null !== $line2 && $self['line2'] = $line2;

        return $self;
    }

    /**
     * The city of the billing address.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * The first line of the billing address.
     */
    public function withLine1(string $line1): self
    {
        $self = clone $this;
        $self['line1'] = $line1;

        return $self;
    }

    /**
     * The postal code of the billing address.
     */
    public function withPostalCode(string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * The US state of the billing address.
     */
    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * The second line of the billing address.
     */
    public function withLine2(string $line2): self
    {
        $self = clone $this;
        $self['line2'] = $line2;

        return $self;
    }
}
