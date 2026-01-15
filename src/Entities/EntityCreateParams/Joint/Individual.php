<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams\Joint;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityCreateParams\Joint\Individual\Address;
use Increase\Entities\EntityCreateParams\Joint\Individual\Identification;

/**
 * @phpstan-import-type AddressShape from \Increase\Entities\EntityCreateParams\Joint\Individual\Address
 * @phpstan-import-type IdentificationShape from \Increase\Entities\EntityCreateParams\Joint\Individual\Identification
 *
 * @phpstan-type IndividualShape = array{
 *   address: Address|AddressShape,
 *   dateOfBirth: string,
 *   identification: Identification|IdentificationShape,
 *   name: string,
 *   confirmedNoUsTaxID?: bool|null,
 * }
 */
final class Individual implements BaseModel
{
    /** @use SdkModel<IndividualShape> */
    use SdkModel;

    /**
     * The individual's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     */
    #[Required]
    public Address $address;

    /**
     * The person's date of birth in YYYY-MM-DD format.
     */
    #[Required('date_of_birth')]
    public string $dateOfBirth;

    /**
     * A means of verifying the person's identity.
     */
    #[Required]
    public Identification $identification;

    /**
     * The person's legal name.
     */
    #[Required]
    public string $name;

    /**
     * The identification method for an individual can only be a passport, driver's license, or other document if you've confirmed the individual does not have a US tax id (either a Social Security Number or Individual Taxpayer Identification Number).
     */
    #[Optional('confirmed_no_us_tax_id')]
    public ?bool $confirmedNoUsTaxID;

    /**
     * `new Individual()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Individual::with(address: ..., dateOfBirth: ..., identification: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Individual)
     *   ->withAddress(...)
     *   ->withDateOfBirth(...)
     *   ->withIdentification(...)
     *   ->withName(...)
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
     *
     * @param Address|AddressShape $address
     * @param Identification|IdentificationShape $identification
     */
    public static function with(
        Address|array $address,
        string $dateOfBirth,
        Identification|array $identification,
        string $name,
        ?bool $confirmedNoUsTaxID = null,
    ): self {
        $self = new self;

        $self['address'] = $address;
        $self['dateOfBirth'] = $dateOfBirth;
        $self['identification'] = $identification;
        $self['name'] = $name;

        null !== $confirmedNoUsTaxID && $self['confirmedNoUsTaxID'] = $confirmedNoUsTaxID;

        return $self;
    }

    /**
     * The individual's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
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
     * The person's date of birth in YYYY-MM-DD format.
     */
    public function withDateOfBirth(string $dateOfBirth): self
    {
        $self = clone $this;
        $self['dateOfBirth'] = $dateOfBirth;

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
     * The person's legal name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

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
}
