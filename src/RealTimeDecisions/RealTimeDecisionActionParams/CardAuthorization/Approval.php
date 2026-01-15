<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization\Approval\CardholderAddressVerificationResult;

/**
 * If your application approves the authorization, this contains metadata about your decision to approve. Your response here is advisory to the acquiring bank. The bank may choose to reverse the authorization if you approve the transaction but indicate the address does not match.
 *
 * @phpstan-import-type CardholderAddressVerificationResultShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization\Approval\CardholderAddressVerificationResult
 *
 * @phpstan-type ApprovalShape = array{
 *   cardholderAddressVerificationResult?: null|CardholderAddressVerificationResult|CardholderAddressVerificationResultShape,
 *   partialAmount?: int|null,
 * }
 */
final class Approval implements BaseModel
{
    /** @use SdkModel<ApprovalShape> */
    use SdkModel;

    /**
     * Your decisions on whether or not each provided address component is a match. Your response here is evaluated against the customer's provided `postal_code` and `line1`, and an appropriate network response is generated. For more information, see our [Address Verification System Codes and Overrides](https://increase.com/documentation/address-verification-system-codes-and-overrides) guide.
     */
    #[Optional('cardholder_address_verification_result')]
    public ?CardholderAddressVerificationResult $cardholderAddressVerificationResult;

    /**
     * If the transaction supports partial approvals (`partial_approval_capability: supported`) the `partial_amount` can be provided in the transaction's settlement currency to approve a lower amount than was requested.
     */
    #[Optional('partial_amount')]
    public ?int $partialAmount;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param CardholderAddressVerificationResult|CardholderAddressVerificationResultShape|null $cardholderAddressVerificationResult
     */
    public static function with(
        CardholderAddressVerificationResult|array|null $cardholderAddressVerificationResult = null,
        ?int $partialAmount = null,
    ): self {
        $self = new self;

        null !== $cardholderAddressVerificationResult && $self['cardholderAddressVerificationResult'] = $cardholderAddressVerificationResult;
        null !== $partialAmount && $self['partialAmount'] = $partialAmount;

        return $self;
    }

    /**
     * Your decisions on whether or not each provided address component is a match. Your response here is evaluated against the customer's provided `postal_code` and `line1`, and an appropriate network response is generated. For more information, see our [Address Verification System Codes and Overrides](https://increase.com/documentation/address-verification-system-codes-and-overrides) guide.
     *
     * @param CardholderAddressVerificationResult|CardholderAddressVerificationResultShape $cardholderAddressVerificationResult
     */
    public function withCardholderAddressVerificationResult(
        CardholderAddressVerificationResult|array $cardholderAddressVerificationResult,
    ): self {
        $self = clone $this;
        $self['cardholderAddressVerificationResult'] = $cardholderAddressVerificationResult;

        return $self;
    }

    /**
     * If the transaction supports partial approvals (`partial_approval_capability: supported`) the `partial_amount` can be provided in the transaction's settlement currency to approve a lower amount than was requested.
     */
    public function withPartialAmount(int $partialAmount): self
    {
        $self = clone $this;
        $self['partialAmount'] = $partialAmount;

        return $self;
    }
}
