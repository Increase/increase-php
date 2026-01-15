<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization\Approval;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization\Approval\CardholderAddressVerificationResult\Line1;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization\Approval\CardholderAddressVerificationResult\PostalCode;

/**
 * Your decisions on whether or not each provided address component is a match. Your response here is evaluated against the customer's provided `postal_code` and `line1`, and an appropriate network response is generated. For more information, see our [Address Verification System Codes and Overrides](https://increase.com/documentation/address-verification-system-codes-and-overrides) guide.
 *
 * @phpstan-type CardholderAddressVerificationResultShape = array{
 *   line1: Line1|value-of<Line1>, postalCode: PostalCode|value-of<PostalCode>
 * }
 */
final class CardholderAddressVerificationResult implements BaseModel
{
    /** @use SdkModel<CardholderAddressVerificationResultShape> */
    use SdkModel;

    /**
     * Your decision on the address line of the provided address.
     *
     * @var value-of<Line1> $line1
     */
    #[Required(enum: Line1::class)]
    public string $line1;

    /**
     * Your decision on the postal code of the provided address.
     *
     * @var value-of<PostalCode> $postalCode
     */
    #[Required('postal_code', enum: PostalCode::class)]
    public string $postalCode;

    /**
     * `new CardholderAddressVerificationResult()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardholderAddressVerificationResult::with(line1: ..., postalCode: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardholderAddressVerificationResult)->withLine1(...)->withPostalCode(...)
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
     * @param Line1|value-of<Line1> $line1
     * @param PostalCode|value-of<PostalCode> $postalCode
     */
    public static function with(
        Line1|string $line1,
        PostalCode|string $postalCode
    ): self {
        $self = new self;

        $self['line1'] = $line1;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * Your decision on the address line of the provided address.
     *
     * @param Line1|value-of<Line1> $line1
     */
    public function withLine1(Line1|string $line1): self
    {
        $self = clone $this;
        $self['line1'] = $line1;

        return $self;
    }

    /**
     * Your decision on the postal code of the provided address.
     *
     * @param PostalCode|value-of<PostalCode> $postalCode
     */
    public function withPostalCode(PostalCode|string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }
}
