<?php

declare(strict_types=1);

namespace Increase\Entities\Entity;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\Entity\Trust\Address;
use Increase\Entities\Entity\Trust\Category;
use Increase\Entities\Entity\Trust\Grantor;
use Increase\Entities\Entity\Trust\Trustee;

/**
 * Details of the trust entity. Will be present if `structure` is equal to `trust`.
 *
 * @phpstan-import-type AddressShape from \Increase\Entities\Entity\Trust\Address
 * @phpstan-import-type GrantorShape from \Increase\Entities\Entity\Trust\Grantor
 * @phpstan-import-type TrusteeShape from \Increase\Entities\Entity\Trust\Trustee
 *
 * @phpstan-type TrustShape = array{
 *   address: Address|AddressShape,
 *   category: Category|value-of<Category>,
 *   formationDocumentFileID: string|null,
 *   formationState: string|null,
 *   grantor: null|Grantor|GrantorShape,
 *   name: string,
 *   taxIdentifier: string|null,
 *   trustees: list<Trustee|TrusteeShape>,
 * }
 */
final class Trust implements BaseModel
{
    /** @use SdkModel<TrustShape> */
    use SdkModel;

    /**
     * The trust's address.
     */
    #[Required]
    public Address $address;

    /**
     * Whether the trust is `revocable` or `irrevocable`.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * The ID for the File containing the formation document of the trust.
     */
    #[Required('formation_document_file_id')]
    public ?string $formationDocumentFileID;

    /**
     * The two-letter United States Postal Service (USPS) abbreviation for the state in which the trust was formed.
     */
    #[Required('formation_state')]
    public ?string $formationState;

    /**
     * The grantor of the trust. Will be present if the `category` is `revocable`.
     */
    #[Required]
    public ?Grantor $grantor;

    /**
     * The trust's name.
     */
    #[Required]
    public string $name;

    /**
     * The Employer Identification Number (EIN) of the trust itself.
     */
    #[Required('tax_identifier')]
    public ?string $taxIdentifier;

    /**
     * The trustees of the trust.
     *
     * @var list<Trustee> $trustees
     */
    #[Required(list: Trustee::class)]
    public array $trustees;

    /**
     * `new Trust()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Trust::with(
     *   address: ...,
     *   category: ...,
     *   formationDocumentFileID: ...,
     *   formationState: ...,
     *   grantor: ...,
     *   name: ...,
     *   taxIdentifier: ...,
     *   trustees: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Trust)
     *   ->withAddress(...)
     *   ->withCategory(...)
     *   ->withFormationDocumentFileID(...)
     *   ->withFormationState(...)
     *   ->withGrantor(...)
     *   ->withName(...)
     *   ->withTaxIdentifier(...)
     *   ->withTrustees(...)
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
     * @param Category|value-of<Category> $category
     * @param Grantor|GrantorShape|null $grantor
     * @param list<Trustee|TrusteeShape> $trustees
     */
    public static function with(
        Address|array $address,
        Category|string $category,
        ?string $formationDocumentFileID,
        ?string $formationState,
        Grantor|array|null $grantor,
        string $name,
        ?string $taxIdentifier,
        array $trustees,
    ): self {
        $self = new self;

        $self['address'] = $address;
        $self['category'] = $category;
        $self['formationDocumentFileID'] = $formationDocumentFileID;
        $self['formationState'] = $formationState;
        $self['grantor'] = $grantor;
        $self['name'] = $name;
        $self['taxIdentifier'] = $taxIdentifier;
        $self['trustees'] = $trustees;

        return $self;
    }

    /**
     * The trust's address.
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
     * Whether the trust is `revocable` or `irrevocable`.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(Category|string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * The ID for the File containing the formation document of the trust.
     */
    public function withFormationDocumentFileID(
        ?string $formationDocumentFileID
    ): self {
        $self = clone $this;
        $self['formationDocumentFileID'] = $formationDocumentFileID;

        return $self;
    }

    /**
     * The two-letter United States Postal Service (USPS) abbreviation for the state in which the trust was formed.
     */
    public function withFormationState(?string $formationState): self
    {
        $self = clone $this;
        $self['formationState'] = $formationState;

        return $self;
    }

    /**
     * The grantor of the trust. Will be present if the `category` is `revocable`.
     *
     * @param Grantor|GrantorShape|null $grantor
     */
    public function withGrantor(Grantor|array|null $grantor): self
    {
        $self = clone $this;
        $self['grantor'] = $grantor;

        return $self;
    }

    /**
     * The trust's name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The Employer Identification Number (EIN) of the trust itself.
     */
    public function withTaxIdentifier(?string $taxIdentifier): self
    {
        $self = clone $this;
        $self['taxIdentifier'] = $taxIdentifier;

        return $self;
    }

    /**
     * The trustees of the trust.
     *
     * @param list<Trustee|TrusteeShape> $trustees
     */
    public function withTrustees(array $trustees): self
    {
        $self = clone $this;
        $self['trustees'] = $trustees;

        return $self;
    }
}
