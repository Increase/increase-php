<?php

declare(strict_types=1);

namespace Increase\Entities\Entity;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\Entity\GovernmentAuthority\Address;
use Increase\Entities\Entity\GovernmentAuthority\AuthorizedPerson;
use Increase\Entities\Entity\GovernmentAuthority\Category;

/**
 * Details of the government authority entity. Will be present if `structure` is equal to `government_authority`.
 *
 * @phpstan-import-type AddressShape from \Increase\Entities\Entity\GovernmentAuthority\Address
 * @phpstan-import-type AuthorizedPersonShape from \Increase\Entities\Entity\GovernmentAuthority\AuthorizedPerson
 *
 * @phpstan-type GovernmentAuthorityShape = array{
 *   address: Address|AddressShape,
 *   authorizedPersons: list<AuthorizedPerson|AuthorizedPersonShape>,
 *   category: Category|value-of<Category>,
 *   name: string,
 *   taxIdentifier: string|null,
 *   website: string|null,
 * }
 */
final class GovernmentAuthority implements BaseModel
{
    /** @use SdkModel<GovernmentAuthorityShape> */
    use SdkModel;

    /**
     * The government authority's address.
     */
    #[Required]
    public Address $address;

    /**
     * The identifying details of authorized persons of the government authority.
     *
     * @var list<AuthorizedPerson> $authorizedPersons
     */
    #[Required('authorized_persons', list: AuthorizedPerson::class)]
    public array $authorizedPersons;

    /**
     * The category of the government authority.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * The government authority's name.
     */
    #[Required]
    public string $name;

    /**
     * The Employer Identification Number (EIN) of the government authority.
     */
    #[Required('tax_identifier')]
    public ?string $taxIdentifier;

    /**
     * The government authority's website.
     */
    #[Required]
    public ?string $website;

    /**
     * `new GovernmentAuthority()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GovernmentAuthority::with(
     *   address: ...,
     *   authorizedPersons: ...,
     *   category: ...,
     *   name: ...,
     *   taxIdentifier: ...,
     *   website: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GovernmentAuthority)
     *   ->withAddress(...)
     *   ->withAuthorizedPersons(...)
     *   ->withCategory(...)
     *   ->withName(...)
     *   ->withTaxIdentifier(...)
     *   ->withWebsite(...)
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
     * @param list<AuthorizedPerson|AuthorizedPersonShape> $authorizedPersons
     * @param Category|value-of<Category> $category
     */
    public static function with(
        Address|array $address,
        array $authorizedPersons,
        Category|string $category,
        string $name,
        ?string $taxIdentifier,
        ?string $website,
    ): self {
        $self = new self;

        $self['address'] = $address;
        $self['authorizedPersons'] = $authorizedPersons;
        $self['category'] = $category;
        $self['name'] = $name;
        $self['taxIdentifier'] = $taxIdentifier;
        $self['website'] = $website;

        return $self;
    }

    /**
     * The government authority's address.
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
     * The identifying details of authorized persons of the government authority.
     *
     * @param list<AuthorizedPerson|AuthorizedPersonShape> $authorizedPersons
     */
    public function withAuthorizedPersons(array $authorizedPersons): self
    {
        $self = clone $this;
        $self['authorizedPersons'] = $authorizedPersons;

        return $self;
    }

    /**
     * The category of the government authority.
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
     * The government authority's name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The Employer Identification Number (EIN) of the government authority.
     */
    public function withTaxIdentifier(?string $taxIdentifier): self
    {
        $self = clone $this;
        $self['taxIdentifier'] = $taxIdentifier;

        return $self;
    }

    /**
     * The government authority's website.
     */
    public function withWebsite(?string $website): self
    {
        $self = clone $this;
        $self['website'] = $website;

        return $self;
    }
}
