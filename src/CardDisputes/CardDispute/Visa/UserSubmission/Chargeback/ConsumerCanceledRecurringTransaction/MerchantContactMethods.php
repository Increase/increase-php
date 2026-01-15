<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerCanceledRecurringTransaction;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Merchant contact methods.
 *
 * @phpstan-type MerchantContactMethodsShape = array{
 *   applicationName: string|null,
 *   callCenterPhoneNumber: string|null,
 *   emailAddress: string|null,
 *   inPersonAddress: string|null,
 *   mailingAddress: string|null,
 *   textPhoneNumber: string|null,
 * }
 */
final class MerchantContactMethods implements BaseModel
{
    /** @use SdkModel<MerchantContactMethodsShape> */
    use SdkModel;

    /**
     * Application name.
     */
    #[Required('application_name')]
    public ?string $applicationName;

    /**
     * Call center phone number.
     */
    #[Required('call_center_phone_number')]
    public ?string $callCenterPhoneNumber;

    /**
     * Email address.
     */
    #[Required('email_address')]
    public ?string $emailAddress;

    /**
     * In person address.
     */
    #[Required('in_person_address')]
    public ?string $inPersonAddress;

    /**
     * Mailing address.
     */
    #[Required('mailing_address')]
    public ?string $mailingAddress;

    /**
     * Text phone number.
     */
    #[Required('text_phone_number')]
    public ?string $textPhoneNumber;

    /**
     * `new MerchantContactMethods()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MerchantContactMethods::with(
     *   applicationName: ...,
     *   callCenterPhoneNumber: ...,
     *   emailAddress: ...,
     *   inPersonAddress: ...,
     *   mailingAddress: ...,
     *   textPhoneNumber: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MerchantContactMethods)
     *   ->withApplicationName(...)
     *   ->withCallCenterPhoneNumber(...)
     *   ->withEmailAddress(...)
     *   ->withInPersonAddress(...)
     *   ->withMailingAddress(...)
     *   ->withTextPhoneNumber(...)
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
        ?string $applicationName,
        ?string $callCenterPhoneNumber,
        ?string $emailAddress,
        ?string $inPersonAddress,
        ?string $mailingAddress,
        ?string $textPhoneNumber,
    ): self {
        $self = new self;

        $self['applicationName'] = $applicationName;
        $self['callCenterPhoneNumber'] = $callCenterPhoneNumber;
        $self['emailAddress'] = $emailAddress;
        $self['inPersonAddress'] = $inPersonAddress;
        $self['mailingAddress'] = $mailingAddress;
        $self['textPhoneNumber'] = $textPhoneNumber;

        return $self;
    }

    /**
     * Application name.
     */
    public function withApplicationName(?string $applicationName): self
    {
        $self = clone $this;
        $self['applicationName'] = $applicationName;

        return $self;
    }

    /**
     * Call center phone number.
     */
    public function withCallCenterPhoneNumber(
        ?string $callCenterPhoneNumber
    ): self {
        $self = clone $this;
        $self['callCenterPhoneNumber'] = $callCenterPhoneNumber;

        return $self;
    }

    /**
     * Email address.
     */
    public function withEmailAddress(?string $emailAddress): self
    {
        $self = clone $this;
        $self['emailAddress'] = $emailAddress;

        return $self;
    }

    /**
     * In person address.
     */
    public function withInPersonAddress(?string $inPersonAddress): self
    {
        $self = clone $this;
        $self['inPersonAddress'] = $inPersonAddress;

        return $self;
    }

    /**
     * Mailing address.
     */
    public function withMailingAddress(?string $mailingAddress): self
    {
        $self = clone $this;
        $self['mailingAddress'] = $mailingAddress;

        return $self;
    }

    /**
     * Text phone number.
     */
    public function withTextPhoneNumber(?string $textPhoneNumber): self
    {
        $self = clone $this;
        $self['textPhoneNumber'] = $textPhoneNumber;

        return $self;
    }
}
