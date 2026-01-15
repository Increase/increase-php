<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\NetworkEvent\MerchantPrearbitrationReceived;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Credit or reversal processed details. Present if and only if `reason` is `credit_or_reversal_processed`.
 *
 * @phpstan-type CreditOrReversalProcessedShape = array{
 *   amount: int, currency: string, explanation: string|null, processedAt: string
 * }
 */
final class CreditOrReversalProcessed implements BaseModel
{
    /** @use SdkModel<CreditOrReversalProcessedShape> */
    use SdkModel;

    /**
     * The amount of the credit or reversal in the minor unit of its currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the credit or reversal's currency.
     */
    #[Required]
    public string $currency;

    /**
     * Explanation for why the merchant believes the credit or reversal was processed.
     */
    #[Required]
    public ?string $explanation;

    /**
     * The date the credit or reversal was processed.
     */
    #[Required('processed_at')]
    public string $processedAt;

    /**
     * `new CreditOrReversalProcessed()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreditOrReversalProcessed::with(
     *   amount: ..., currency: ..., explanation: ..., processedAt: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreditOrReversalProcessed)
     *   ->withAmount(...)
     *   ->withCurrency(...)
     *   ->withExplanation(...)
     *   ->withProcessedAt(...)
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
        int $amount,
        string $currency,
        ?string $explanation,
        string $processedAt
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['currency'] = $currency;
        $self['explanation'] = $explanation;
        $self['processedAt'] = $processedAt;

        return $self;
    }

    /**
     * The amount of the credit or reversal in the minor unit of its currency. For dollars, for example, this is cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the credit or reversal's currency.
     */
    public function withCurrency(string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Explanation for why the merchant believes the credit or reversal was processed.
     */
    public function withExplanation(?string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

        return $self;
    }

    /**
     * The date the credit or reversal was processed.
     */
    public function withProcessedAt(string $processedAt): self
    {
        $self = clone $this;
        $self['processedAt'] = $processedAt;

        return $self;
    }
}
