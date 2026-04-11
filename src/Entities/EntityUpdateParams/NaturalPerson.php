<?php

declare(strict_types=1);

namespace Increase\Entities\EntityUpdateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityUpdateParams\NaturalPerson\Address;
use Increase\Entities\EntityUpdateParams\NaturalPerson\Identification;

/**
 * Details of the natural person entity to update. If you specify this parameter and the entity is not a natural person, the request will fail.
 *
 * @phpstan-import-type AddressShape from \Increase\Entities\EntityUpdateParams\NaturalPerson\Address
 * @phpstan-import-type IdentificationShape from \Increase\Entities\EntityUpdateParams\NaturalPerson\Identification
 *
 * @phpstan-type NaturalPersonShape = array{
 *   address?: null|Address|AddressShape,
 *   confirmedNoUsTaxID?: bool|null,
 *   identification?: null|Identification|IdentificationShape,
 *   name?: string|null,
 * }
 */
final class NaturalPerson implements BaseModel
{
    /** @use SdkModel<NaturalPersonShape> */
    use SdkModel;

    /**
     * The entity's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     */
    #[Optional]
    public ?Address $address;

    /**
     * The identification method for an individual can only be a passport, driver's license, or other document if you've confirmed the individual does not have a US tax id (either a Social Security Number or Individual Taxpayer Identification Number).
     */
    #[Optional('confirmed_no_us_tax_id')]
    public ?bool $confirmedNoUsTaxID;

    /**
     * A means of verifying the person's identity.
     */
    #[Optional]
    public ?Identification $identification;

    /**
     * The legal name of the natural person.
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
     * @param Identification|IdentificationShape|null $identification
     */
    public static function with(
        Address|array|null $address = null,
        ?bool $confirmedNoUsTaxID = null,
        Identification|array|null $identification = null,
        ?string $name = null,
    ): self {
        $self = new self;

        null !== $address && $self['address'] = $address;
        null !== $confirmedNoUsTaxID && $self['confirmedNoUsTaxID'] = $confirmedNoUsTaxID;
        null !== $identification && $self['identification'] = $identification;
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
     * The identification method for an individual can only be a passport, driver's license, or other document if you've confirmed the individual does not have a US tax id (either a Social Security Number or Individual Taxpayer Identification Number).
     */
    public function withConfirmedNoUsTaxID(bool $confirmedNoUsTaxID): self
    {
        $self = clone $this;
        $self['confirmedNoUsTaxID'] = $confirmedNoUsTaxID;

        return $self;
    }

    /**
     * A means of verifying the person's identity.
     *
     * @param Identification|IdentificationShape $identification
     */
    public function withIdentification(
        Identification|array $identification
    ): self {
        $self = clone $this;
        $self['identification'] = $identification;

        return $self;
    }

    /**
     * The legal name of the natural person.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
