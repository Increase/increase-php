<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Validation\Issue;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\Entity\Validation\Issue\BeneficialOwnerAddress\Reason;

/**
 * Details when the issue is with a beneficial owner's address.
 *
 * @phpstan-type BeneficialOwnerAddressShape = array{
 *   beneficialOwnerID: string, reason: Reason|value-of<Reason>
 * }
 */
final class BeneficialOwnerAddress implements BaseModel
{
    /** @use SdkModel<BeneficialOwnerAddressShape> */
    use SdkModel;

    /**
     * The ID of the beneficial owner.
     */
    #[Required('beneficial_owner_id')]
    public string $beneficialOwnerID;

    /**
     * The reason the address is invalid.
     *
     * @var value-of<Reason> $reason
     */
    #[Required(enum: Reason::class)]
    public string $reason;

    /**
     * `new BeneficialOwnerAddress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BeneficialOwnerAddress::with(beneficialOwnerID: ..., reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BeneficialOwnerAddress)->withBeneficialOwnerID(...)->withReason(...)
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
     * @param Reason|value-of<Reason> $reason
     */
    public static function with(
        string $beneficialOwnerID,
        Reason|string $reason
    ): self {
        $self = new self;

        $self['beneficialOwnerID'] = $beneficialOwnerID;
        $self['reason'] = $reason;

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

    /**
     * The reason the address is invalid.
     *
     * @param Reason|value-of<Reason> $reason
     */
    public function withReason(Reason|string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
