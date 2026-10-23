<?php

declare(strict_types=1);

namespace Increase\DigitalCardProfiles\DigitalCardProfileCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DigitalCardProfiles\DigitalCardProfileCreateParams\ApplePay\AssociatedApplicationIdentifier;
use Increase\DigitalCardProfiles\DigitalCardProfileCreateParams\ApplePay\AssociatedStoreIdentifier;

/**
 * Apple Pay specific settings for the Card Profile.
 *
 * @phpstan-import-type AssociatedApplicationIdentifierShape from \Increase\DigitalCardProfiles\DigitalCardProfileCreateParams\ApplePay\AssociatedApplicationIdentifier
 * @phpstan-import-type AssociatedStoreIdentifierShape from \Increase\DigitalCardProfiles\DigitalCardProfileCreateParams\ApplePay\AssociatedStoreIdentifier
 *
 * @phpstan-type ApplePayShape = array{
 *   associatedApplicationIdentifiers?: list<AssociatedApplicationIdentifier|AssociatedApplicationIdentifierShape>|null,
 *   associatedStoreIdentifiers?: list<AssociatedStoreIdentifier|AssociatedStoreIdentifierShape>|null,
 * }
 */
final class ApplePay implements BaseModel
{
    /** @use SdkModel<ApplePayShape> */
    use SdkModel;

    /**
     * The applications to associate with cards using this Card Profile.
     *
     * @var list<AssociatedApplicationIdentifier>|null $associatedApplicationIdentifiers
     */
    #[Optional(
        'associated_application_identifiers',
        list: AssociatedApplicationIdentifier::class,
    )]
    public ?array $associatedApplicationIdentifiers;

    /**
     * The App Store listings of the applications to associate with cards using this Card Profile.
     *
     * @var list<AssociatedStoreIdentifier>|null $associatedStoreIdentifiers
     */
    #[Optional(
        'associated_store_identifiers',
        list: AssociatedStoreIdentifier::class
    )]
    public ?array $associatedStoreIdentifiers;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<AssociatedApplicationIdentifier|AssociatedApplicationIdentifierShape>|null $associatedApplicationIdentifiers
     * @param list<AssociatedStoreIdentifier|AssociatedStoreIdentifierShape>|null $associatedStoreIdentifiers
     */
    public static function with(
        ?array $associatedApplicationIdentifiers = null,
        ?array $associatedStoreIdentifiers = null,
    ): self {
        $self = new self;

        null !== $associatedApplicationIdentifiers && $self['associatedApplicationIdentifiers'] = $associatedApplicationIdentifiers;
        null !== $associatedStoreIdentifiers && $self['associatedStoreIdentifiers'] = $associatedStoreIdentifiers;

        return $self;
    }

    /**
     * The applications to associate with cards using this Card Profile.
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
     * The App Store listings of the applications to associate with cards using this Card Profile.
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
