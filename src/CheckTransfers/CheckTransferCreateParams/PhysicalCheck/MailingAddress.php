<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details for where Increase will mail the check.
 *
 * @phpstan-type MailingAddressShape = array{
 *   city: string,
 *   line1: string,
 *   postalCode: string,
 *   state: string,
 *   line2?: string|null,
 *   name?: string|null,
 *   phone?: string|null,
 * }
 */
final class MailingAddress implements BaseModel
{
    /** @use SdkModel<MailingAddressShape> */
    use SdkModel;

    /**
     * The city component of the check's destination address.
     */
    #[Required]
    public string $city;

    /**
     * The first line of the address component of the check's destination address.
     */
    #[Required]
    public string $line1;

    /**
     * The postal code component of the check's destination address.
     */
    #[Required('postal_code')]
    public string $postalCode;

    /**
     * The US state component of the check's destination address.
     */
    #[Required]
    public string $state;

    /**
     * The second line of the address component of the check's destination address.
     */
    #[Optional]
    public ?string $line2;

    /**
     * The name component of the check's destination address. Defaults to the provided `recipient_name` parameter if `name` is not provided.
     */
    #[Optional]
    public ?string $name;

    /**
     * The phone number to associate with the check's destination address. The phone number is only used when `shipping_method` is `fedex_overnight` and will be supplied to FedEx to be used in case of delivery issues.
     */
    #[Optional]
    public ?string $phone;

    /**
     * `new MailingAddress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MailingAddress::with(city: ..., line1: ..., postalCode: ..., state: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MailingAddress)
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
        ?string $name = null,
        ?string $phone = null,
    ): self {
        $self = new self;

        $self['city'] = $city;
        $self['line1'] = $line1;
        $self['postalCode'] = $postalCode;
        $self['state'] = $state;

        null !== $line2 && $self['line2'] = $line2;
        null !== $name && $self['name'] = $name;
        null !== $phone && $self['phone'] = $phone;

        return $self;
    }

    /**
     * The city component of the check's destination address.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * The first line of the address component of the check's destination address.
     */
    public function withLine1(string $line1): self
    {
        $self = clone $this;
        $self['line1'] = $line1;

        return $self;
    }

    /**
     * The postal code component of the check's destination address.
     */
    public function withPostalCode(string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * The US state component of the check's destination address.
     */
    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * The second line of the address component of the check's destination address.
     */
    public function withLine2(string $line2): self
    {
        $self = clone $this;
        $self['line2'] = $line2;

        return $self;
    }

    /**
     * The name component of the check's destination address. Defaults to the provided `recipient_name` parameter if `name` is not provided.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The phone number to associate with the check's destination address. The phone number is only used when `shipping_method` is `fedex_overnight` and will be supplied to FedEx to be used in case of delivery issues.
     */
    public function withPhone(string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }
}
