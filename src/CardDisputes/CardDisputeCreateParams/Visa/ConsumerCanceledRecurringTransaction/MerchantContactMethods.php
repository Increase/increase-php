<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledRecurringTransaction;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Merchant contact methods.
 *
 * @phpstan-type MerchantContactMethodsShape = array{
 *   applicationName?: string|null,
 *   callCenterPhoneNumber?: string|null,
 *   emailAddress?: string|null,
 *   inPersonAddress?: string|null,
 *   mailingAddress?: string|null,
 *   textPhoneNumber?: string|null,
 * }
 */
final class MerchantContactMethods implements BaseModel
{
    /** @use SdkModel<MerchantContactMethodsShape> */
    use SdkModel;

    /**
     * Application name.
     */
    #[Optional('application_name')]
    public ?string $applicationName;

    /**
     * Call center phone number.
     */
    #[Optional('call_center_phone_number')]
    public ?string $callCenterPhoneNumber;

    /**
     * Email address.
     */
    #[Optional('email_address')]
    public ?string $emailAddress;

    /**
     * In person address.
     */
    #[Optional('in_person_address')]
    public ?string $inPersonAddress;

    /**
     * Mailing address.
     */
    #[Optional('mailing_address')]
    public ?string $mailingAddress;

    /**
     * Text phone number.
     */
    #[Optional('text_phone_number')]
    public ?string $textPhoneNumber;

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
        ?string $applicationName = null,
        ?string $callCenterPhoneNumber = null,
        ?string $emailAddress = null,
        ?string $inPersonAddress = null,
        ?string $mailingAddress = null,
        ?string $textPhoneNumber = null,
    ): self {
        $self = new self;

        null !== $applicationName && $self['applicationName'] = $applicationName;
        null !== $callCenterPhoneNumber && $self['callCenterPhoneNumber'] = $callCenterPhoneNumber;
        null !== $emailAddress && $self['emailAddress'] = $emailAddress;
        null !== $inPersonAddress && $self['inPersonAddress'] = $inPersonAddress;
        null !== $mailingAddress && $self['mailingAddress'] = $mailingAddress;
        null !== $textPhoneNumber && $self['textPhoneNumber'] = $textPhoneNumber;

        return $self;
    }

    /**
     * Application name.
     */
    public function withApplicationName(string $applicationName): self
    {
        $self = clone $this;
        $self['applicationName'] = $applicationName;

        return $self;
    }

    /**
     * Call center phone number.
     */
    public function withCallCenterPhoneNumber(
        string $callCenterPhoneNumber
    ): self {
        $self = clone $this;
        $self['callCenterPhoneNumber'] = $callCenterPhoneNumber;

        return $self;
    }

    /**
     * Email address.
     */
    public function withEmailAddress(string $emailAddress): self
    {
        $self = clone $this;
        $self['emailAddress'] = $emailAddress;

        return $self;
    }

    /**
     * In person address.
     */
    public function withInPersonAddress(string $inPersonAddress): self
    {
        $self = clone $this;
        $self['inPersonAddress'] = $inPersonAddress;

        return $self;
    }

    /**
     * Mailing address.
     */
    public function withMailingAddress(string $mailingAddress): self
    {
        $self = clone $this;
        $self['mailingAddress'] = $mailingAddress;

        return $self;
    }

    /**
     * Text phone number.
     */
    public function withTextPhoneNumber(string $textPhoneNumber): self
    {
        $self = clone $this;
        $self['textPhoneNumber'] = $textPhoneNumber;

        return $self;
    }
}
