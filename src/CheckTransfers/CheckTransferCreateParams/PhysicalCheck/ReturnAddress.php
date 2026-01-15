<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The return address to be printed on the check. If omitted this will default to an Increase-owned address that will mark checks as delivery failed and shred them.
 *
 * @phpstan-type ReturnAddressShape = array{
 *   city: string,
 *   line1: string,
 *   name: string,
 *   postalCode: string,
 *   state: string,
 *   line2?: string|null,
 *   phone?: string|null,
 * }
 */
final class ReturnAddress implements BaseModel
{
    /** @use SdkModel<ReturnAddressShape> */
    use SdkModel;

    /**
     * The city of the return address.
     */
    #[Required]
    public string $city;

    /**
     * The first line of the return address.
     */
    #[Required]
    public string $line1;

    /**
     * The name of the return address.
     */
    #[Required]
    public string $name;

    /**
     * The postal code of the return address.
     */
    #[Required('postal_code')]
    public string $postalCode;

    /**
     * The US state of the return address.
     */
    #[Required]
    public string $state;

    /**
     * The second line of the return address.
     */
    #[Optional]
    public ?string $line2;

    /**
     * The phone number to associate with the shipper. The phone number is only used when `shipping_method` is `fedex_overnight` and will be supplied to FedEx to be used in case of delivery issues.
     */
    #[Optional]
    public ?string $phone;

    /**
     * `new ReturnAddress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ReturnAddress::with(
     *   city: ..., line1: ..., name: ..., postalCode: ..., state: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ReturnAddress)
     *   ->withCity(...)
     *   ->withLine1(...)
     *   ->withName(...)
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
        string $name,
        string $postalCode,
        string $state,
        ?string $line2 = null,
        ?string $phone = null,
    ): self {
        $self = new self;

        $self['city'] = $city;
        $self['line1'] = $line1;
        $self['name'] = $name;
        $self['postalCode'] = $postalCode;
        $self['state'] = $state;

        null !== $line2 && $self['line2'] = $line2;
        null !== $phone && $self['phone'] = $phone;

        return $self;
    }

    /**
     * The city of the return address.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * The first line of the return address.
     */
    public function withLine1(string $line1): self
    {
        $self = clone $this;
        $self['line1'] = $line1;

        return $self;
    }

    /**
     * The name of the return address.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The postal code of the return address.
     */
    public function withPostalCode(string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * The US state of the return address.
     */
    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * The second line of the return address.
     */
    public function withLine2(string $line2): self
    {
        $self = clone $this;
        $self['line2'] = $line2;

        return $self;
    }

    /**
     * The phone number to associate with the shipper. The phone number is only used when `shipping_method` is `fedex_overnight` and will be supplied to FedEx to be used in case of delivery issues.
     */
    public function withPhone(string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }
}
