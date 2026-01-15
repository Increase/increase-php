<?php

declare(strict_types=1);

namespace Increase\Entities\EntityUpdateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityUpdateParams\Corporation\Address;

/**
 * Details of the corporation entity to update. If you specify this parameter and the entity is not a corporation, the request will fail.
 *
 * @phpstan-import-type AddressShape from \Increase\Entities\EntityUpdateParams\Corporation\Address
 *
 * @phpstan-type CorporationShape = array{
 *   address?: null|Address|AddressShape,
 *   email?: string|null,
 *   incorporationState?: string|null,
 *   industryCode?: string|null,
 *   name?: string|null,
 * }
 */
final class Corporation implements BaseModel
{
    /** @use SdkModel<CorporationShape> */
    use SdkModel;

    /**
     * The entity's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     */
    #[Optional]
    public ?Address $address;

    /**
     * An email address for the business. Not every program requires an email for submitted Entities.
     */
    #[Optional]
    public ?string $email;

    /**
     * The two-letter United States Postal Service (USPS) abbreviation for the corporation's state of incorporation.
     */
    #[Optional('incorporation_state')]
    public ?string $incorporationState;

    /**
     * The North American Industry Classification System (NAICS) code for the corporation's primary line of business. This is a number, like `5132` for `Software Publishers`. A full list of classification codes is available [here](https://increase.com/documentation/data-dictionary#north-american-industry-classification-system-codes).
     */
    #[Optional('industry_code')]
    public ?string $industryCode;

    /**
     * The legal name of the corporation.
     */
    #[Optional]
    public ?string $name;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Address|AddressShape|null $address
     */
    public static function with(
        Address|array|null $address = null,
        ?string $email = null,
        ?string $incorporationState = null,
        ?string $industryCode = null,
        ?string $name = null,
    ): self {
        $self = new self;

        null !== $address && $self['address'] = $address;
        null !== $email && $self['email'] = $email;
        null !== $incorporationState && $self['incorporationState'] = $incorporationState;
        null !== $industryCode && $self['industryCode'] = $industryCode;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * The entity's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     *
     * @param Address|AddressShape $address
     */
    public function withAddress(Address|array $address): self
    {
        $self = clone $this;
        $self['address'] = $address;

        return $self;
    }

    /**
     * An email address for the business. Not every program requires an email for submitted Entities.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * The two-letter United States Postal Service (USPS) abbreviation for the corporation's state of incorporation.
     */
    public function withIncorporationState(string $incorporationState): self
    {
        $self = clone $this;
        $self['incorporationState'] = $incorporationState;

        return $self;
    }

    /**
     * The North American Industry Classification System (NAICS) code for the corporation's primary line of business. This is a number, like `5132` for `Software Publishers`. A full list of classification codes is available [here](https://increase.com/documentation/data-dictionary#north-american-industry-classification-system-codes).
     */
    public function withIndustryCode(string $industryCode): self
    {
        $self = clone $this;
        $self['industryCode'] = $industryCode;

        return $self;
    }

    /**
     * The legal name of the corporation.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
