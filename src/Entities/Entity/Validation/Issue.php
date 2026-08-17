<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Validation;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\Entity\Validation\Issue\BeneficialOwnerAddress;
use Increase\Entities\Entity\Validation\Issue\BeneficialOwnerIdentity;
use Increase\Entities\Entity\Validation\Issue\Category;
use Increase\Entities\Entity\Validation\Issue\EntityAddress;
use Increase\Entities\Entity\Validation\Issue\EntityIdentity;
use Increase\Entities\Entity\Validation\Issue\EntityTaxIdentifier;

/**
 * @phpstan-import-type BeneficialOwnerAddressShape from \Increase\Entities\Entity\Validation\Issue\BeneficialOwnerAddress
 * @phpstan-import-type BeneficialOwnerIdentityShape from \Increase\Entities\Entity\Validation\Issue\BeneficialOwnerIdentity
 * @phpstan-import-type EntityAddressShape from \Increase\Entities\Entity\Validation\Issue\EntityAddress
 * @phpstan-import-type EntityIdentityShape from \Increase\Entities\Entity\Validation\Issue\EntityIdentity
 * @phpstan-import-type EntityTaxIdentifierShape from \Increase\Entities\Entity\Validation\Issue\EntityTaxIdentifier
 *
 * @phpstan-type IssueShape = array{
 *   beneficialOwnerAddress: null|BeneficialOwnerAddress|BeneficialOwnerAddressShape,
 *   beneficialOwnerIdentity: null|BeneficialOwnerIdentity|BeneficialOwnerIdentityShape,
 *   category: Category|value-of<Category>,
 *   entityAddress: null|EntityAddress|EntityAddressShape,
 *   entityIdentity: null|EntityIdentity|EntityIdentityShape,
 *   entityTaxIdentifier: null|EntityTaxIdentifier|EntityTaxIdentifierShape,
 * }
 */
final class Issue implements BaseModel
{
    /** @use SdkModel<IssueShape> */
    use SdkModel;

    /**
     * Details when the issue is with a beneficial owner's address.
     */
    #[Required('beneficial_owner_address')]
    public ?BeneficialOwnerAddress $beneficialOwnerAddress;

    /**
     * Details when the issue is with a beneficial owner's identity verification.
     */
    #[Required('beneficial_owner_identity')]
    public ?BeneficialOwnerIdentity $beneficialOwnerIdentity;

    /**
     * The type of issue. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * Details when the issue is with the entity's address.
     */
    #[Required('entity_address')]
    public ?EntityAddress $entityAddress;

    /**
     * Details when the issue is with the entity's identity verification.
     */
    #[Required('entity_identity')]
    public ?EntityIdentity $entityIdentity;

    /**
     * Details when the issue is with the entity's tax ID.
     */
    #[Required('entity_tax_identifier')]
    public ?EntityTaxIdentifier $entityTaxIdentifier;

    /**
     * `new Issue()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Issue::with(
     *   beneficialOwnerAddress: ...,
     *   beneficialOwnerIdentity: ...,
     *   category: ...,
     *   entityAddress: ...,
     *   entityIdentity: ...,
     *   entityTaxIdentifier: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Issue)
     *   ->withBeneficialOwnerAddress(...)
     *   ->withBeneficialOwnerIdentity(...)
     *   ->withCategory(...)
     *   ->withEntityAddress(...)
     *   ->withEntityIdentity(...)
     *   ->withEntityTaxIdentifier(...)
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
     * @param BeneficialOwnerAddress|BeneficialOwnerAddressShape|null $beneficialOwnerAddress
     * @param BeneficialOwnerIdentity|BeneficialOwnerIdentityShape|null $beneficialOwnerIdentity
     * @param Category|value-of<Category> $category
     * @param EntityAddress|EntityAddressShape|null $entityAddress
     * @param EntityIdentity|EntityIdentityShape|null $entityIdentity
     * @param EntityTaxIdentifier|EntityTaxIdentifierShape|null $entityTaxIdentifier
     */
    public static function with(
        BeneficialOwnerAddress|array|null $beneficialOwnerAddress,
        BeneficialOwnerIdentity|array|null $beneficialOwnerIdentity,
        Category|string $category,
        EntityAddress|array|null $entityAddress,
        EntityIdentity|array|null $entityIdentity,
        EntityTaxIdentifier|array|null $entityTaxIdentifier,
    ): self {
        $self = new self;

        $self['beneficialOwnerAddress'] = $beneficialOwnerAddress;
        $self['beneficialOwnerIdentity'] = $beneficialOwnerIdentity;
        $self['category'] = $category;
        $self['entityAddress'] = $entityAddress;
        $self['entityIdentity'] = $entityIdentity;
        $self['entityTaxIdentifier'] = $entityTaxIdentifier;

        return $self;
    }

    /**
     * Details when the issue is with a beneficial owner's address.
     *
     * @param BeneficialOwnerAddress|BeneficialOwnerAddressShape|null $beneficialOwnerAddress
     */
    public function withBeneficialOwnerAddress(
        BeneficialOwnerAddress|array|null $beneficialOwnerAddress
    ): self {
        $self = clone $this;
        $self['beneficialOwnerAddress'] = $beneficialOwnerAddress;

        return $self;
    }

    /**
     * Details when the issue is with a beneficial owner's identity verification.
     *
     * @param BeneficialOwnerIdentity|BeneficialOwnerIdentityShape|null $beneficialOwnerIdentity
     */
    public function withBeneficialOwnerIdentity(
        BeneficialOwnerIdentity|array|null $beneficialOwnerIdentity
    ): self {
        $self = clone $this;
        $self['beneficialOwnerIdentity'] = $beneficialOwnerIdentity;

        return $self;
    }

    /**
     * The type of issue. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
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
     * Details when the issue is with the entity's address.
     *
     * @param EntityAddress|EntityAddressShape|null $entityAddress
     */
    public function withEntityAddress(
        EntityAddress|array|null $entityAddress
    ): self {
        $self = clone $this;
        $self['entityAddress'] = $entityAddress;

        return $self;
    }

    /**
     * Details when the issue is with the entity's identity verification.
     *
     * @param EntityIdentity|EntityIdentityShape|null $entityIdentity
     */
    public function withEntityIdentity(
        EntityIdentity|array|null $entityIdentity
    ): self {
        $self = clone $this;
        $self['entityIdentity'] = $entityIdentity;

        return $self;
    }

    /**
     * Details when the issue is with the entity's tax ID.
     *
     * @param EntityTaxIdentifier|EntityTaxIdentifierShape|null $entityTaxIdentifier
     */
    public function withEntityTaxIdentifier(
        EntityTaxIdentifier|array|null $entityTaxIdentifier
    ): self {
        $self = clone $this;
        $self['entityTaxIdentifier'] = $entityTaxIdentifier;

        return $self;
    }
}
