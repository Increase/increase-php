<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthorization\Verification;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Cardholder name provided in the authorization request.
 *
 * @phpstan-type CardholderNameShape = array{
 *   providedFirstName: string|null,
 *   providedLastName: string|null,
 *   providedMiddleName: string|null,
 * }
 */
final class CardholderName implements BaseModel
{
    /** @use SdkModel<CardholderNameShape> */
    use SdkModel;

    /**
     * The first name provided for verification in the authorization request.
     */
    #[Required('provided_first_name')]
    public ?string $providedFirstName;

    /**
     * The last name provided for verification in the authorization request.
     */
    #[Required('provided_last_name')]
    public ?string $providedLastName;

    /**
     * The middle name provided for verification in the authorization request.
     */
    #[Required('provided_middle_name')]
    public ?string $providedMiddleName;

    /**
     * `new CardholderName()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardholderName::with(
     *   providedFirstName: ..., providedLastName: ..., providedMiddleName: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardholderName)
     *   ->withProvidedFirstName(...)
     *   ->withProvidedLastName(...)
     *   ->withProvidedMiddleName(...)
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
        ?string $providedFirstName,
        ?string $providedLastName,
        ?string $providedMiddleName,
    ): self {
        $self = new self;

        $self['providedFirstName'] = $providedFirstName;
        $self['providedLastName'] = $providedLastName;
        $self['providedMiddleName'] = $providedMiddleName;

        return $self;
    }

    /**
     * The first name provided for verification in the authorization request.
     */
    public function withProvidedFirstName(?string $providedFirstName): self
    {
        $self = clone $this;
        $self['providedFirstName'] = $providedFirstName;

        return $self;
    }

    /**
     * The last name provided for verification in the authorization request.
     */
    public function withProvidedLastName(?string $providedLastName): self
    {
        $self = clone $this;
        $self['providedLastName'] = $providedLastName;

        return $self;
    }

    /**
     * The middle name provided for verification in the authorization request.
     */
    public function withProvidedMiddleName(?string $providedMiddleName): self
    {
        $self = clone $this;
        $self['providedMiddleName'] = $providedMiddleName;

        return $self;
    }
}
