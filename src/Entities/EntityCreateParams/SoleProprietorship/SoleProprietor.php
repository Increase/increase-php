<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams\SoleProprietorship;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityCreateParams\SoleProprietorship\SoleProprietor\Address;
use Increase\Entities\EntityCreateParams\SoleProprietorship\SoleProprietor\Identification;

/**
 * The individual who operates the sole proprietorship.
 *
 * @phpstan-import-type AddressShape from \Increase\Entities\EntityCreateParams\SoleProprietorship\SoleProprietor\Address
 * @phpstan-import-type IdentificationShape from \Increase\Entities\EntityCreateParams\SoleProprietorship\SoleProprietor\Identification
 *
 * @phpstan-type SoleProprietorShape = array{
 *   address: \Increase\Entities\EntityCreateParams\SoleProprietorship\SoleProprietor\Address|AddressShape,
 *   dateOfBirth: string,
 *   identification: Identification|IdentificationShape,
 *   name: string,
 * }
 */
final class SoleProprietor implements BaseModel
{
    /** @use SdkModel<SoleProprietorShape> */
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
     * A means of verifying the person's identity. Sole proprietors must be identified with a `social_security_number` or an `individual_taxpayer_identification_number`.
     */
    #[Required]
    public Identification $identification;

    /**
     * The person's legal name.
     */
    #[Required]
    public string $name;

    /**
     * `new SoleProprietor()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SoleProprietor::with(
     *   address: ..., dateOfBirth: ..., identification: ..., name: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SoleProprietor)
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
    ): self {
        $self = new self;

        $self['address'] = $address;
        $self['dateOfBirth'] = $dateOfBirth;
        $self['identification'] = $identification;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The individual's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     *
     * @param Address|AddressShape $address
     */
    public function withAddress(
        Address|array $address,
    ): self {
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
     * A means of verifying the person's identity. Sole proprietors must be identified with a `social_security_number` or an `individual_taxpayer_identification_number`.
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
}
