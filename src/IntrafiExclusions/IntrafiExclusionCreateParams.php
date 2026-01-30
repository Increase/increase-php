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
 *   entityID: string, fdicCertificateNumber: string
 * }
 */
final class IntrafiExclusionCreateParams implements BaseModel
{
    /** @use SdkModel<IntrafiExclusionCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Entity whose deposits will be excluded.
     */
    #[Required('entity_id')]
    public string $entityID;

    /**
     * The FDIC certificate number of the financial institution to be excluded. An FDIC certificate number uniquely identifies a financial institution, and is different than a routing number. To find one, we recommend searching by Bank Name using the [FDIC's bankfind tool](https://banks.data.fdic.gov/bankfind-suite/bankfind).
     */
    #[Required('fdic_certificate_number')]
    public string $fdicCertificateNumber;

    /**
     * `new IntrafiExclusionCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * IntrafiExclusionCreateParams::with(entityID: ..., fdicCertificateNumber: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new IntrafiExclusionCreateParams)
     *   ->withEntityID(...)
     *   ->withFdicCertificateNumber(...)
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
    public static function with(
        string $entityID,
        string $fdicCertificateNumber
    ): self {
        $self = new self;

        $self['entityID'] = $entityID;
        $self['fdicCertificateNumber'] = $fdicCertificateNumber;

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

    /**
     * The FDIC certificate number of the financial institution to be excluded. An FDIC certificate number uniquely identifies a financial institution, and is different than a routing number. To find one, we recommend searching by Bank Name using the [FDIC's bankfind tool](https://banks.data.fdic.gov/bankfind-suite/bankfind).
     */
    public function withFdicCertificateNumber(
        string $fdicCertificateNumber
    ): self {
        $self = clone $this;
        $self['fdicCertificateNumber'] = $fdicCertificateNumber;

        return $self;
    }
}
