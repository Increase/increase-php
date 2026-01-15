<?php

declare(strict_types=1);

namespace Increase\FednowTransfers\FednowTransferCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The creditor's address.
 *
 * @phpstan-type CreditorAddressShape = array{
 *   city: string, postalCode: string, state: string, line1?: string|null
 * }
 */
final class CreditorAddress implements BaseModel
{
    /** @use SdkModel<CreditorAddressShape> */
    use SdkModel;

    /**
     * The city, district, town, or village of the address.
     */
    #[Required]
    public string $city;

    /**
     * The postal code component of the address.
     */
    #[Required('postal_code')]
    public string $postalCode;

    /**
     * The US state component of the address.
     */
    #[Required]
    public string $state;

    /**
     * The first line of the address. This is usually the street number and street.
     */
    #[Optional]
    public ?string $line1;

    /**
     * `new CreditorAddress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreditorAddress::with(city: ..., postalCode: ..., state: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreditorAddress)->withCity(...)->withPostalCode(...)->withState(...)
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
        string $postalCode,
        string $state,
        ?string $line1 = null
    ): self {
        $self = new self;

        $self['city'] = $city;
        $self['postalCode'] = $postalCode;
        $self['state'] = $state;

        null !== $line1 && $self['line1'] = $line1;

        return $self;
    }

    /**
     * The city, district, town, or village of the address.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * The postal code component of the address.
     */
    public function withPostalCode(string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * The US state component of the address.
     */
    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * The first line of the address. This is usually the street number and street.
     */
    public function withLine1(string $line1): self
    {
        $self = clone $this;
        $self['line1'] = $line1;

        return $self;
    }
}
