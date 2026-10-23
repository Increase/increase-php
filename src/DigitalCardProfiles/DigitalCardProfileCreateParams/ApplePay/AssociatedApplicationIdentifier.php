<?php

declare(strict_types=1);

namespace Increase\DigitalCardProfiles\DigitalCardProfileCreateParams\ApplePay;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type AssociatedApplicationIdentifierShape = array{identifier: string}
 */
final class AssociatedApplicationIdentifier implements BaseModel
{
    /** @use SdkModel<AssociatedApplicationIdentifierShape> */
    use SdkModel;

    /**
     * The application identifier, composed of your Apple Developer Team ID and the application's bundle identifier, like `ABCDE12345.com.example.app`.
     */
    #[Required]
    public string $identifier;

    /**
     * `new AssociatedApplicationIdentifier()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssociatedApplicationIdentifier::with(identifier: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssociatedApplicationIdentifier)->withIdentifier(...)
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
     * The application identifier, composed of your Apple Developer Team ID and the application's bundle identifier, like `ABCDE12345.com.example.app`.
     */
    public function withIdentifier(string $identifier): self
    {
        $self = clone $this;
        $self['identifier'] = $identifier;

        return $self;
    }
}
