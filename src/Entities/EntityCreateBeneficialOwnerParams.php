<?php

declare(strict_types=1);

namespace Increase\Entities;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityCreateBeneficialOwnerParams\BeneficialOwner;

/**
 * Create a beneficial owner for a corporate Entity.
 *
 * @see Increase\Services\EntitiesService::createBeneficialOwner()
 *
 * @phpstan-import-type BeneficialOwnerShape from \Increase\Entities\EntityCreateBeneficialOwnerParams\BeneficialOwner
 *
 * @phpstan-type EntityCreateBeneficialOwnerParamsShape = array{
 *   beneficialOwner: BeneficialOwner|BeneficialOwnerShape
 * }
 */
final class EntityCreateBeneficialOwnerParams implements BaseModel
{
    /** @use SdkModel<EntityCreateBeneficialOwnerParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifying details of anyone controlling or owning 25% or more of the corporation.
     */
    #[Required('beneficial_owner')]
    public BeneficialOwner $beneficialOwner;

    /**
     * `new EntityCreateBeneficialOwnerParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntityCreateBeneficialOwnerParams::with(beneficialOwner: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntityCreateBeneficialOwnerParams)->withBeneficialOwner(...)
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
     * @param BeneficialOwner|BeneficialOwnerShape $beneficialOwner
     */
    public static function with(BeneficialOwner|array $beneficialOwner): self
    {
        $self = new self;

        $self['beneficialOwner'] = $beneficialOwner;

        return $self;
    }

    /**
     * The identifying details of anyone controlling or owning 25% or more of the corporation.
     *
     * @param BeneficialOwner|BeneficialOwnerShape $beneficialOwner
     */
    public function withBeneficialOwner(
        BeneficialOwner|array $beneficialOwner
    ): self {
        $self = clone $this;
        $self['beneficialOwner'] = $beneficialOwner;

        return $self;
    }
}
