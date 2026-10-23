<?php

declare(strict_types=1);

namespace Increase\DigitalCardProfiles\DigitalCardProfile;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DigitalCardProfiles\DigitalCardProfile\ApplePay\AssociatedApplicationIdentifier;
use Increase\DigitalCardProfiles\DigitalCardProfile\ApplePay\AssociatedStoreIdentifier;

/**
 * Apple Pay specific settings for the Card Profile.
 *
 * @phpstan-import-type AssociatedApplicationIdentifierShape from \Increase\DigitalCardProfiles\DigitalCardProfile\ApplePay\AssociatedApplicationIdentifier
 * @phpstan-import-type AssociatedStoreIdentifierShape from \Increase\DigitalCardProfiles\DigitalCardProfile\ApplePay\AssociatedStoreIdentifier
 *
 * @phpstan-type ApplePayShape = array{
 *   associatedApplicationIdentifiers: list<AssociatedApplicationIdentifier|AssociatedApplicationIdentifierShape>,
 *   associatedStoreIdentifiers: list<AssociatedStoreIdentifier|AssociatedStoreIdentifierShape>,
 * }
 */
final class ApplePay implements BaseModel
{
    /** @use SdkModel<ApplePayShape> */
    use SdkModel;

    /**
     * The applications associated with cards using this Card Profile.
     *
     * @var list<AssociatedApplicationIdentifier> $associatedApplicationIdentifiers
     */
    #[Required(
        'associated_application_identifiers',
        list: AssociatedApplicationIdentifier::class,
    )]
    public array $associatedApplicationIdentifiers;

    /**
     * The App Store listings of the applications associated with cards using this Card Profile.
     *
     * @var list<AssociatedStoreIdentifier> $associatedStoreIdentifiers
     */
    #[Required(
        'associated_store_identifiers',
        list: AssociatedStoreIdentifier::class
    )]
    public array $associatedStoreIdentifiers;

    /**
     * `new ApplePay()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ApplePay::with(
     *   associatedApplicationIdentifiers: ..., associatedStoreIdentifiers: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ApplePay)
     *   ->withAssociatedApplicationIdentifiers(...)
     *   ->withAssociatedStoreIdentifiers(...)
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
     * @param list<AssociatedApplicationIdentifier|AssociatedApplicationIdentifierShape> $associatedApplicationIdentifiers
     * @param list<AssociatedStoreIdentifier|AssociatedStoreIdentifierShape> $associatedStoreIdentifiers
     */
    public static function with(
        array $associatedApplicationIdentifiers,
        array $associatedStoreIdentifiers
    ): self {
        $self = new self;

        $self['associatedApplicationIdentifiers'] = $associatedApplicationIdentifiers;
        $self['associatedStoreIdentifiers'] = $associatedStoreIdentifiers;

        return $self;
    }

    /**
     * The applications associated with cards using this Card Profile.
     *
     * @param list<AssociatedApplicationIdentifier|AssociatedApplicationIdentifierShape> $associatedApplicationIdentifiers
     */
    public function withAssociatedApplicationIdentifiers(
        array $associatedApplicationIdentifiers
    ): self {
        $self = clone $this;
        $self['associatedApplicationIdentifiers'] = $associatedApplicationIdentifiers;

        return $self;
    }

    /**
     * The App Store listings of the applications associated with cards using this Card Profile.
     *
     * @param list<AssociatedStoreIdentifier|AssociatedStoreIdentifierShape> $associatedStoreIdentifiers
     */
    public function withAssociatedStoreIdentifiers(
        array $associatedStoreIdentifiers
    ): self {
        $self = clone $this;
        $self['associatedStoreIdentifiers'] = $associatedStoreIdentifiers;

        return $self;
    }
}
