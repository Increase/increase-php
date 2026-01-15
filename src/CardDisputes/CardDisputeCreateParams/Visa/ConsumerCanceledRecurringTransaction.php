<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa;

use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledRecurringTransaction\CancellationTarget;
use Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledRecurringTransaction\MerchantContactMethods;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Canceled recurring transaction. Required if and only if `category` is `consumer_canceled_recurring_transaction`.
 *
 * @phpstan-import-type MerchantContactMethodsShape from \Increase\CardDisputes\CardDisputeCreateParams\Visa\ConsumerCanceledRecurringTransaction\MerchantContactMethods
 *
 * @phpstan-type ConsumerCanceledRecurringTransactionShape = array{
 *   cancellationTarget: CancellationTarget|value-of<CancellationTarget>,
 *   merchantContactMethods: MerchantContactMethods|MerchantContactMethodsShape,
 *   transactionOrAccountCanceledAt: string,
 *   otherFormOfPaymentExplanation?: string|null,
 * }
 */
final class ConsumerCanceledRecurringTransaction implements BaseModel
{
    /** @use SdkModel<ConsumerCanceledRecurringTransactionShape> */
    use SdkModel;

    /**
     * Cancellation target.
     *
     * @var value-of<CancellationTarget> $cancellationTarget
     */
    #[Required('cancellation_target', enum: CancellationTarget::class)]
    public string $cancellationTarget;

    /**
     * Merchant contact methods.
     */
    #[Required('merchant_contact_methods')]
    public MerchantContactMethods $merchantContactMethods;

    /**
     * Transaction or account canceled at.
     */
    #[Required('transaction_or_account_canceled_at')]
    public string $transactionOrAccountCanceledAt;

    /**
     * Other form of payment explanation.
     */
    #[Optional('other_form_of_payment_explanation')]
    public ?string $otherFormOfPaymentExplanation;

    /**
     * `new ConsumerCanceledRecurringTransaction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerCanceledRecurringTransaction::with(
     *   cancellationTarget: ...,
     *   merchantContactMethods: ...,
     *   transactionOrAccountCanceledAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConsumerCanceledRecurringTransaction)
     *   ->withCancellationTarget(...)
     *   ->withMerchantContactMethods(...)
     *   ->withTransactionOrAccountCanceledAt(...)
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
     * @param CancellationTarget|value-of<CancellationTarget> $cancellationTarget
     * @param MerchantContactMethods|MerchantContactMethodsShape $merchantContactMethods
     */
    public static function with(
        CancellationTarget|string $cancellationTarget,
        MerchantContactMethods|array $merchantContactMethods,
        string $transactionOrAccountCanceledAt,
        ?string $otherFormOfPaymentExplanation = null,
    ): self {
        $self = new self;

        $self['cancellationTarget'] = $cancellationTarget;
        $self['merchantContactMethods'] = $merchantContactMethods;
        $self['transactionOrAccountCanceledAt'] = $transactionOrAccountCanceledAt;

        null !== $otherFormOfPaymentExplanation && $self['otherFormOfPaymentExplanation'] = $otherFormOfPaymentExplanation;

        return $self;
    }

    /**
     * Cancellation target.
     *
     * @param CancellationTarget|value-of<CancellationTarget> $cancellationTarget
     */
    public function withCancellationTarget(
        CancellationTarget|string $cancellationTarget
    ): self {
        $self = clone $this;
        $self['cancellationTarget'] = $cancellationTarget;

        return $self;
    }

    /**
     * Merchant contact methods.
     *
     * @param MerchantContactMethods|MerchantContactMethodsShape $merchantContactMethods
     */
    public function withMerchantContactMethods(
        MerchantContactMethods|array $merchantContactMethods
    ): self {
        $self = clone $this;
        $self['merchantContactMethods'] = $merchantContactMethods;

        return $self;
    }

    /**
     * Transaction or account canceled at.
     */
    public function withTransactionOrAccountCanceledAt(
        string $transactionOrAccountCanceledAt
    ): self {
        $self = clone $this;
        $self['transactionOrAccountCanceledAt'] = $transactionOrAccountCanceledAt;

        return $self;
    }

    /**
     * Other form of payment explanation.
     */
    public function withOtherFormOfPaymentExplanation(
        string $otherFormOfPaymentExplanation
    ): self {
        $self = clone $this;
        $self['otherFormOfPaymentExplanation'] = $otherFormOfPaymentExplanation;

        return $self;
    }
}
