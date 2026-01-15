<?php

declare(strict_types=1);

namespace Increase\Entities;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Archive a beneficial owner for a corporate Entity.
 *
 * @see Increase\Services\EntitiesService::archiveBeneficialOwner()
 *
 * @phpstan-type EntityArchiveBeneficialOwnerParamsShape = array{
 *   beneficialOwnerID: string
 * }
 */
final class EntityArchiveBeneficialOwnerParams implements BaseModel
{
    /** @use SdkModel<EntityArchiveBeneficialOwnerParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifying details of anyone controlling or owning 25% or more of the corporation.
     */
    #[Required('beneficial_owner_id')]
    public string $beneficialOwnerID;

    /**
     * `new EntityArchiveBeneficialOwnerParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntityArchiveBeneficialOwnerParams::with(beneficialOwnerID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntityArchiveBeneficialOwnerParams)->withBeneficialOwnerID(...)
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
     * The identifying details of anyone controlling or owning 25% or more of the corporation.
     */
    public function withBeneficialOwnerID(string $beneficialOwnerID): self
    {
        $self = clone $this;
        $self['beneficialOwnerID'] = $beneficialOwnerID;

        return $self;
    }
}
