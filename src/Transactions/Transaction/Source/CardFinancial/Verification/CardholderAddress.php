<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source\CardFinancial\Verification;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\CardFinancial\Verification\CardholderAddress\Result;

/**
 * Cardholder address provided in the authorization request and the address on file we verified it against.
 *
 * @phpstan-type CardholderAddressShape = array{
 *   actualLine1: string|null,
 *   actualPostalCode: string|null,
 *   providedLine1: string|null,
 *   providedPostalCode: string|null,
 *   result: Result|value-of<Result>,
 * }
 */
final class CardholderAddress implements BaseModel
{
    /** @use SdkModel<CardholderAddressShape> */
    use SdkModel;

    /**
     * Line 1 of the address on file for the cardholder.
     */
    #[Required('actual_line1')]
    public ?string $actualLine1;

    /**
     * The postal code of the address on file for the cardholder.
     */
    #[Required('actual_postal_code')]
    public ?string $actualPostalCode;

    /**
     * The cardholder address line 1 provided for verification in the authorization request.
     */
    #[Required('provided_line1')]
    public ?string $providedLine1;

    /**
     * The postal code provided for verification in the authorization request.
     */
    #[Required('provided_postal_code')]
    public ?string $providedPostalCode;

    /**
     * The address verification result returned to the card network.
     *
     * @var value-of<Result> $result
     */
    #[Required(enum: Result::class)]
    public string $result;

    /**
     * `new CardholderAddress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardholderAddress::with(
     *   actualLine1: ...,
     *   actualPostalCode: ...,
     *   providedLine1: ...,
     *   providedPostalCode: ...,
     *   result: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardholderAddress)
     *   ->withActualLine1(...)
     *   ->withActualPostalCode(...)
     *   ->withProvidedLine1(...)
     *   ->withProvidedPostalCode(...)
     *   ->withResult(...)
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
     * @param Result|value-of<Result> $result
     */
    public static function with(
        ?string $actualLine1,
        ?string $actualPostalCode,
        ?string $providedLine1,
        ?string $providedPostalCode,
        Result|string $result,
    ): self {
        $self = new self;

        $self['actualLine1'] = $actualLine1;
        $self['actualPostalCode'] = $actualPostalCode;
        $self['providedLine1'] = $providedLine1;
        $self['providedPostalCode'] = $providedPostalCode;
        $self['result'] = $result;

        return $self;
    }

    /**
     * Line 1 of the address on file for the cardholder.
     */
    public function withActualLine1(?string $actualLine1): self
    {
        $self = clone $this;
        $self['actualLine1'] = $actualLine1;

        return $self;
    }

    /**
     * The postal code of the address on file for the cardholder.
     */
    public function withActualPostalCode(?string $actualPostalCode): self
    {
        $self = clone $this;
        $self['actualPostalCode'] = $actualPostalCode;

        return $self;
    }

    /**
     * The cardholder address line 1 provided for verification in the authorization request.
     */
    public function withProvidedLine1(?string $providedLine1): self
    {
        $self = clone $this;
        $self['providedLine1'] = $providedLine1;

        return $self;
    }

    /**
     * The postal code provided for verification in the authorization request.
     */
    public function withProvidedPostalCode(?string $providedPostalCode): self
    {
        $self = clone $this;
        $self['providedPostalCode'] = $providedPostalCode;

        return $self;
    }

    /**
     * The address verification result returned to the card network.
     *
     * @param Result|value-of<Result> $result
     */
    public function withResult(Result|string $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }
}
