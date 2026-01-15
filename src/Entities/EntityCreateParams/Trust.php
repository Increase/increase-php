<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityCreateParams\Trust\Address;
use Increase\Entities\EntityCreateParams\Trust\Category;
use Increase\Entities\EntityCreateParams\Trust\Grantor;
use Increase\Entities\EntityCreateParams\Trust\Trustee;

/**
 * Details of the trust entity to create. Required if `structure` is equal to `trust`.
 *
 * @phpstan-import-type AddressShape from \Increase\Entities\EntityCreateParams\Trust\Address
 * @phpstan-import-type TrusteeShape from \Increase\Entities\EntityCreateParams\Trust\Trustee
 * @phpstan-import-type GrantorShape from \Increase\Entities\EntityCreateParams\Trust\Grantor
 *
 * @phpstan-type TrustShape = array{
 *   address: Address|AddressShape,
 *   category: Category|value-of<Category>,
 *   name: string,
 *   trustees: list<Trustee|TrusteeShape>,
 *   formationDocumentFileID?: string|null,
 *   formationState?: string|null,
 *   grantor?: null|Grantor|GrantorShape,
 *   taxIdentifier?: string|null,
 * }
 */
final class Trust implements BaseModel
{
    /** @use SdkModel<TrustShape> */
    use SdkModel;

    /**
     * The trust's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
     */
    #[Required]
    public Address $address;

    /**
     * Whether the trust is `revocable` or `irrevocable`. Irrevocable trusts require their own Employer Identification Number. Revocable trusts require information about the individual `grantor` who created the trust.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * The legal name of the trust.
     */
    #[Required]
    public string $name;

    /**
     * The trustees of the trust.
     *
     * @var list<Trustee> $trustees
     */
    #[Required(list: Trustee::class)]
    public array $trustees;

    /**
     * The identifier of the File containing the formation document of the trust.
     */
    #[Optional('formation_document_file_id')]
    public ?string $formationDocumentFileID;

    /**
     * The two-letter United States Postal Service (USPS) abbreviation for the state in which the trust was formed.
     */
    #[Optional('formation_state')]
    public ?string $formationState;

    /**
     * The grantor of the trust. Required if `category` is equal to `revocable`.
     */
    #[Optional]
    public ?Grantor $grantor;

    /**
     * The Employer Identification Number (EIN) for the trust. Required if `category` is equal to `irrevocable`.
     */
    #[Optional('tax_identifier')]
    public ?string $taxIdentifier;

    /**
     * `new Trust()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Trust::with(address: ..., category: ..., name: ..., trustees: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Trust)
     *   ->withAddress(...)
     *   ->withCategory(...)
     *   ->withName(...)
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
     * @param list<Trustee|TrusteeShape> $trustees
     * @param Grantor|GrantorShape|null $grantor
     */
    public static function with(
        Address|array $address,
        Category|string $category,
        string $name,
        array $trustees,
        ?string $formationDocumentFileID = null,
        ?string $formationState = null,
        Grantor|array|null $grantor = null,
        ?string $taxIdentifier = null,
    ): self {
        $self = new self;

        $self['address'] = $address;
        $self['category'] = $category;
        $self['name'] = $name;
        $self['trustees'] = $trustees;

        null !== $formationDocumentFileID && $self['formationDocumentFileID'] = $formationDocumentFileID;
        null !== $formationState && $self['formationState'] = $formationState;
        null !== $grantor && $self['grantor'] = $grantor;
        null !== $taxIdentifier && $self['taxIdentifier'] = $taxIdentifier;

        return $self;
    }

    /**
     * The trust's physical address. Mail receiving locations like PO Boxes and PMB's are disallowed.
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
     * Whether the trust is `revocable` or `irrevocable`. Irrevocable trusts require their own Employer Identification Number. Revocable trusts require information about the individual `grantor` who created the trust.
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
     * The legal name of the trust.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

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

    /**
     * The identifier of the File containing the formation document of the trust.
     */
    public function withFormationDocumentFileID(
        string $formationDocumentFileID
    ): self {
        $self = clone $this;
        $self['formationDocumentFileID'] = $formationDocumentFileID;

        return $self;
    }

    /**
     * The two-letter United States Postal Service (USPS) abbreviation for the state in which the trust was formed.
     */
    public function withFormationState(string $formationState): self
    {
        $self = clone $this;
        $self['formationState'] = $formationState;

        return $self;
    }

    /**
     * The grantor of the trust. Required if `category` is equal to `revocable`.
     *
     * @param Grantor|GrantorShape $grantor
     */
    public function withGrantor(Grantor|array $grantor): self
    {
        $self = clone $this;
        $self['grantor'] = $grantor;

        return $self;
    }

    /**
     * The Employer Identification Number (EIN) for the trust. Required if `category` is equal to `irrevocable`.
     */
    public function withTaxIdentifier(string $taxIdentifier): self
    {
        $self = clone $this;
        $self['taxIdentifier'] = $taxIdentifier;

        return $self;
    }
}
