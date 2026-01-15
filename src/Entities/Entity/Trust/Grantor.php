<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Trust;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\Entity\Trust\Grantor\Address;
use Increase\Entities\Entity\Trust\Grantor\Identification;

/**
 * The grantor of the trust. Will be present if the `category` is `revocable`.
 *
 * @phpstan-import-type AddressShape from \Increase\Entities\Entity\Trust\Grantor\Address
 * @phpstan-import-type IdentificationShape from \Increase\Entities\Entity\Trust\Grantor\Identification
 *
 * @phpstan-type GrantorShape = array{
 *   address: \Increase\Entities\Entity\Trust\Grantor\Address|AddressShape,
 *   dateOfBirth: string,
 *   identification: Identification|IdentificationShape,
 *   name: string,
 * }
 */
final class Grantor implements BaseModel
{
    /** @use SdkModel<GrantorShape> */
    use SdkModel;

    /**
     * The person's address.
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
     * `new Grantor()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Grantor::with(address: ..., dateOfBirth: ..., identification: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Grantor)
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
     * The person's address.
     *
     * @param Address|AddressShape $address
     */
    public function withAddress(
        Address|array $address
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
}
