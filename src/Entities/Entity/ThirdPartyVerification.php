<?php

declare(strict_types=1);

namespace Increase\Entities\Entity;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\Entity\ThirdPartyVerification\Vendor;

/**
 * If you are using a third-party service for identity verification, you can use this field to associate this Entity with the identifier that represents them in that service.
 *
 * @phpstan-type ThirdPartyVerificationShape = array{
 *   reference: string, vendor: Vendor|value-of<Vendor>
 * }
 */
final class ThirdPartyVerification implements BaseModel
{
    /** @use SdkModel<ThirdPartyVerificationShape> */
    use SdkModel;

    /**
     * The reference identifier for the third party verification.
     */
    #[Required]
    public string $reference;

    /**
     * The vendor that was used to perform the verification.
     *
     * @var value-of<Vendor> $vendor
     */
    #[Required(enum: Vendor::class)]
    public string $vendor;

    /**
     * `new ThirdPartyVerification()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ThirdPartyVerification::with(reference: ..., vendor: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ThirdPartyVerification)->withReference(...)->withVendor(...)
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
     * @param Vendor|value-of<Vendor> $vendor
     */
    public static function with(string $reference, Vendor|string $vendor): self
    {
        $self = new self;

        $self['reference'] = $reference;
        $self['vendor'] = $vendor;

        return $self;
    }

    /**
     * The reference identifier for the third party verification.
     */
    public function withReference(string $reference): self
    {
        $self = clone $this;
        $self['reference'] = $reference;

        return $self;
    }

    /**
     * The vendor that was used to perform the verification.
     *
     * @param Vendor|value-of<Vendor> $vendor
     */
    public function withVendor(Vendor|string $vendor): self
    {
        $self = clone $this;
        $self['vendor'] = $vendor;

        return $self;
    }
}
