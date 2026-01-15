<?php

declare(strict_types=1);

namespace Increase\Lockboxes\Lockbox;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The mailing address for the Lockbox.
 *
 * @phpstan-type AddressShape = array{
 *   city: string,
 *   line1: string,
 *   line2: string,
 *   postalCode: string,
 *   recipient: string|null,
 *   state: string,
 * }
 */
final class Address implements BaseModel
{
    /** @use SdkModel<AddressShape> */
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
    public string $line2;

    /**
     * The postal code of the address.
     */
    #[Required('postal_code')]
    public string $postalCode;

    /**
     * The recipient line of the address. This will include the recipient name you provide when creating the address, as well as an ATTN suffix to help route the mail to your lockbox. Mail senders must include this ATTN line to receive mail at this Lockbox.
     */
    #[Required]
    public ?string $recipient;

    /**
     * The two-letter United States Postal Service (USPS) abbreviation for the state of the address.
     */
    #[Required]
    public string $state;

    /**
     * `new Address()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Address::with(
     *   city: ..., line1: ..., line2: ..., postalCode: ..., recipient: ..., state: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Address)
     *   ->withCity(...)
     *   ->withLine1(...)
     *   ->withLine2(...)
     *   ->withPostalCode(...)
     *   ->withRecipient(...)
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
        string $line2,
        string $postalCode,
        ?string $recipient,
        string $state,
    ): self {
        $self = new self;

        $self['city'] = $city;
        $self['line1'] = $line1;
        $self['line2'] = $line2;
        $self['postalCode'] = $postalCode;
        $self['recipient'] = $recipient;
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
    public function withLine2(string $line2): self
    {
        $self = clone $this;
        $self['line2'] = $line2;

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
     * The recipient line of the address. This will include the recipient name you provide when creating the address, as well as an ATTN suffix to help route the mail to your lockbox. Mail senders must include this ATTN line to receive mail at this Lockbox.
     */
    public function withRecipient(?string $recipient): self
    {
        $self = clone $this;
        $self['recipient'] = $recipient;

        return $self;
    }

    /**
     * The two-letter United States Postal Service (USPS) abbreviation for the state of the address.
     */
    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }
}
