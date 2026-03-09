<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\MessageCategory;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\MessageCategory\Payment\TransactionType;

/**
 * Fields specific to payment authentication attempts.
 *
 * @phpstan-type PaymentShape = array{
 *   purchaseAmount: int,
 *   purchaseAmountCardholderEstimated: int|null,
 *   purchaseCurrency: string,
 *   transactionType: null|TransactionType|value-of<TransactionType>,
 * }
 */
final class Payment implements BaseModel
{
    /** @use SdkModel<PaymentShape> */
    use SdkModel;

    /**
     * The purchase amount in minor units.
     */
    #[Required('purchase_amount')]
    public int $purchaseAmount;

    /**
     * The purchase amount in the cardholder's currency (i.e., USD) estimated using daily conversion rates from the card network.
     */
    #[Required('purchase_amount_cardholder_estimated')]
    public ?int $purchaseAmountCardholderEstimated;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the authentication attempt's purchase currency.
     */
    #[Required('purchase_currency')]
    public string $purchaseCurrency;

    /**
     * The type of transaction being authenticated.
     *
     * @var value-of<TransactionType>|null $transactionType
     */
    #[Required('transaction_type', enum: TransactionType::class)]
    public ?string $transactionType;

    /**
     * `new Payment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Payment::with(
     *   purchaseAmount: ...,
     *   purchaseAmountCardholderEstimated: ...,
     *   purchaseCurrency: ...,
     *   transactionType: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Payment)
     *   ->withPurchaseAmount(...)
     *   ->withPurchaseAmountCardholderEstimated(...)
     *   ->withPurchaseCurrency(...)
     *   ->withTransactionType(...)
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
     * @param TransactionType|value-of<TransactionType>|null $transactionType
     */
    public static function with(
        int $purchaseAmount,
        ?int $purchaseAmountCardholderEstimated,
        string $purchaseCurrency,
        TransactionType|string|null $transactionType,
    ): self {
        $self = new self;

        $self['purchaseAmount'] = $purchaseAmount;
        $self['purchaseAmountCardholderEstimated'] = $purchaseAmountCardholderEstimated;
        $self['purchaseCurrency'] = $purchaseCurrency;
        $self['transactionType'] = $transactionType;

        return $self;
    }

    /**
     * The purchase amount in minor units.
     */
    public function withPurchaseAmount(int $purchaseAmount): self
    {
        $self = clone $this;
        $self['purchaseAmount'] = $purchaseAmount;

        return $self;
    }

    /**
     * The purchase amount in the cardholder's currency (i.e., USD) estimated using daily conversion rates from the card network.
     */
    public function withPurchaseAmountCardholderEstimated(
        ?int $purchaseAmountCardholderEstimated
    ): self {
        $self = clone $this;
        $self['purchaseAmountCardholderEstimated'] = $purchaseAmountCardholderEstimated;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the authentication attempt's purchase currency.
     */
    public function withPurchaseCurrency(string $purchaseCurrency): self
    {
        $self = clone $this;
        $self['purchaseCurrency'] = $purchaseCurrency;

        return $self;
    }

    /**
     * The type of transaction being authenticated.
     *
     * @param TransactionType|value-of<TransactionType>|null $transactionType
     */
    public function withTransactionType(
        TransactionType|string|null $transactionType
    ): self {
        $self = clone $this;
        $self['transactionType'] = $transactionType;

        return $self;
    }
}
