<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Validation\Issue;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details when the issue is with a beneficial owner's tax identifier.
 *
 * @phpstan-type BeneficialOwnerTaxIdentifierShape = array{
 *   beneficialOwnerID: string
 * }
 */
final class BeneficialOwnerTaxIdentifier implements BaseModel
{
    /** @use SdkModel<BeneficialOwnerTaxIdentifierShape> */
    use SdkModel;

    /**
     * The ID of the beneficial owner.
     */
    #[Required('beneficial_owner_id')]
    public string $beneficialOwnerID;

    /**
     * `new BeneficialOwnerTaxIdentifier()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BeneficialOwnerTaxIdentifier::with(beneficialOwnerID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BeneficialOwnerTaxIdentifier)->withBeneficialOwnerID(...)
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
    public static function with(string $beneficialOwnerID): self
    {
        $self = new self;

        $self['beneficialOwnerID'] = $beneficialOwnerID;

        return $self;
    }

    /**
     * The ID of the beneficial owner.
     */
    public function withBeneficialOwnerID(string $beneficialOwnerID): self
    {
        $self = clone $this;
        $self['beneficialOwnerID'] = $beneficialOwnerID;

        return $self;
    }
}
