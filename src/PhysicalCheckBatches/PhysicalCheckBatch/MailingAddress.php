<?php

declare(strict_types=1);

namespace Increase\PhysicalCheckBatches\PhysicalCheckBatch;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The mailing address of the parcel.
 *
 * @phpstan-type MailingAddressShape = array{
 *   city: string,
 *   line1: string,
 *   line2: string|null,
 *   name: string,
 *   phone: string|null,
 *   postalCode: string,
 *   state: string,
 * }
 */
final class MailingAddress implements BaseModel
{
    /** @use SdkModel<MailingAddressShape> */
    use SdkModel;

    /**
     * The city of the address.
     */
    #[Required]
    public string $city;

    /**
     * The first line of the address.
     */
    #[Required]
    public string $line1;

    /**
     * The second line of the address.
     */
    #[Required]
    public ?string $line2;

    /**
     * The name component of the address.
     */
    #[Required]
    public string $name;

    /**
     * The phone number that is used for delivery issues.
     */
    #[Required]
    public ?string $phone;

    /**
     * The postal code of the address.
     */
    #[Required('postal_code')]
    public string $postalCode;

    /**
     * The state of the address.
     */
    #[Required]
    public string $state;

    /**
     * `new MailingAddress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MailingAddress::with(
     *   city: ...,
     *   line1: ...,
     *   line2: ...,
     *   name: ...,
     *   phone: ...,
     *   postalCode: ...,
     *   state: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MailingAddress)
     *   ->withCity(...)
     *   ->withLine1(...)
     *   ->withLine2(...)
     *   ->withName(...)
     *   ->withPhone(...)
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
        ?string $line2,
        string $name,
        ?string $phone,
        string $postalCode,
        string $state,
    ): self {
        $self = new self;

        $self['city'] = $city;
        $self['line1'] = $line1;
        $self['line2'] = $line2;
        $self['name'] = $name;
        $self['phone'] = $phone;
        $self['postalCode'] = $postalCode;
        $self['state'] = $state;

        return $self;
    }

    /**
     * The city of the address.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * The first line of the address.
     */
    public function withLine1(string $line1): self
    {
        $self = clone $this;
        $self['line1'] = $line1;

        return $self;
    }

    /**
     * The second line of the address.
     */
    public function withLine2(?string $line2): self
    {
        $self = clone $this;
        $self['line2'] = $line2;

        return $self;
    }

    /**
     * The name component of the address.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The phone number that is used for delivery issues.
     */
    public function withPhone(?string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }

    /**
     * The postal code of the address.
     */
    public function withPostalCode(string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * The state of the address.
     */
    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }
}
