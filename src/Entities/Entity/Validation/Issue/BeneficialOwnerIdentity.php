<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Validation\Issue;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details when the issue is with a beneficial owner's identity verification.
 *
 * @phpstan-type BeneficialOwnerIdentityShape = array{beneficialOwnerID: string}
 */
final class BeneficialOwnerIdentity implements BaseModel
{
    /** @use SdkModel<BeneficialOwnerIdentityShape> */
    use SdkModel;

    /**
     * The ID of the beneficial owner.
     */
    #[Required('beneficial_owner_id')]
    public string $beneficialOwnerID;

    /**
     * `new BeneficialOwnerIdentity()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BeneficialOwnerIdentity::with(beneficialOwnerID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BeneficialOwnerIdentity)->withBeneficialOwnerID(...)
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
