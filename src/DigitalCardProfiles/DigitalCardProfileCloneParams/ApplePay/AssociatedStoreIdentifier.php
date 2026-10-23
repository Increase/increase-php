<?php

declare(strict_types=1);

namespace Increase\DigitalCardProfiles\DigitalCardProfileCloneParams\ApplePay;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type AssociatedStoreIdentifierShape = array{identifier: string}
 */
final class AssociatedStoreIdentifier implements BaseModel
{
    /** @use SdkModel<AssociatedStoreIdentifierShape> */
    use SdkModel;

    /**
     * The numeric App Store identifier.
     */
    #[Required]
    public string $identifier;

    /**
     * `new AssociatedStoreIdentifier()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssociatedStoreIdentifier::with(identifier: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssociatedStoreIdentifier)->withIdentifier(...)
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
    public static function with(string $identifier): self
    {
        $self = new self;

        $self['identifier'] = $identifier;

        return $self;
    }

    /**
     * The numeric App Store identifier.
     */
    public function withIdentifier(string $identifier): self
    {
        $self = clone $this;
        $self['identifier'] = $identifier;

        return $self;
    }
}
