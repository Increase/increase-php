<?php

declare(strict_types=1);

namespace Increase\IntrafiExclusions;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create an IntraFi Exclusion.
 *
 * @see Increase\Services\IntrafiExclusionsService::create()
 *
 * @phpstan-type IntrafiExclusionCreateParamsShape = array{
 *   bankName: string, entityID: string
 * }
 */
final class IntrafiExclusionCreateParams implements BaseModel
{
    /** @use SdkModel<IntrafiExclusionCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The name of the financial institution to be excluded.
     */
    #[Required('bank_name')]
    public string $bankName;

    /**
     * The identifier of the Entity whose deposits will be excluded.
     */
    #[Required('entity_id')]
    public string $entityID;

    /**
     * `new IntrafiExclusionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * IntrafiExclusionCreateParams::with(bankName: ..., entityID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new IntrafiExclusionCreateParams)->withBankName(...)->withEntityID(...)
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
    public static function with(string $bankName, string $entityID): self
    {
        $self = new self;

        $self['bankName'] = $bankName;
        $self['entityID'] = $entityID;

        return $self;
    }

    /**
     * The name of the financial institution to be excluded.
     */
    public function withBankName(string $bankName): self
    {
        $self = clone $this;
        $self['bankName'] = $bankName;

        return $self;
    }

    /**
     * The identifier of the Entity whose deposits will be excluded.
     */
    public function withEntityID(string $entityID): self
    {
        $self = clone $this;
        $self['entityID'] = $entityID;

        return $self;
    }
}
