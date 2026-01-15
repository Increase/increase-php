<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer\PhysicalCheck;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details for where Increase will mail the check.
 *
 * @phpstan-type MailingAddressShape = array{
 *   city: string|null,
 *   line1: string|null,
 *   line2: string|null,
 *   name: string|null,
 *   phone: string|null,
 *   postalCode: string|null,
 *   state: string|null,
 * }
 */
final class MailingAddress implements BaseModel
{
    /** @use SdkModel<MailingAddressShape> */
    use SdkModel;

    /**
     * The city of the check's destination.
     */
    #[Required]
    public ?string $city;

    /**
     * The street address of the check's destination.
     */
    #[Required]
    public ?string $line1;

    /**
     * The second line of the address of the check's destination.
     */
    #[Required]
    public ?string $line2;

    /**
     * The name component of the check's mailing address.
     */
    #[Required]
    public ?string $name;

    /**
     * The phone number to be used in case of delivery issues at the check's mailing address. Only used for FedEx overnight shipping.
     */
    #[Required]
    public ?string $phone;

    /**
     * The postal code of the check's destination.
     */
    #[Required('postal_code')]
    public ?string $postalCode;

    /**
     * The state of the check's destination.
     */
    #[Required]
    public ?string $state;

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
        ?string $city,
        ?string $line1,
        ?string $line2,
        ?string $name,
        ?string $phone,
        ?string $postalCode,
        ?string $state,
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
     * The city of the check's destination.
     */
    public function withCity(?string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * The street address of the check's destination.
     */
    public function withLine1(?string $line1): self
    {
        $self = clone $this;
        $self['line1'] = $line1;

        return $self;
    }

    /**
     * The second line of the address of the check's destination.
     */
    public function withLine2(?string $line2): self
    {
        $self = clone $this;
        $self['line2'] = $line2;

        return $self;
    }

    /**
     * The name component of the check's mailing address.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The phone number to be used in case of delivery issues at the check's mailing address. Only used for FedEx overnight shipping.
     */
    public function withPhone(?string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }

    /**
     * The postal code of the check's destination.
     */
    public function withPostalCode(?string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * The state of the check's destination.
     */
    public function withState(?string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }
}
