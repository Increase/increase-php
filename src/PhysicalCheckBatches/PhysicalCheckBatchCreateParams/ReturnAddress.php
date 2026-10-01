<?php

declare(strict_types=1);

namespace Increase\PhysicalCheckBatches\PhysicalCheckBatchCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details for where the parcel should return if it is unable to be delivered.
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
     * The recipient at the return address.
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
     * The phone number used for delivery issues at the return address. Only used when `shipping_method` is `fedex_overnight`.
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
     * The recipient at the return address.
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
     * The phone number used for delivery issues at the return address. Only used when `shipping_method` is `fedex_overnight`.
     */
    public function withPhone(string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }
}
