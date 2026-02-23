<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment;

use Increase\CardPayments\CardPayment\SchemeFee\Currency;
use Increase\CardPayments\CardPayment\SchemeFee\FeeType;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type SchemeFeeShape = array{
 *   amount: string,
 *   createdAt: \DateTimeInterface,
 *   currency: Currency|value-of<Currency>,
 *   feeType: FeeType|value-of<FeeType>,
 *   fixedComponent: string|null,
 *   variableRate: string|null,
 * }
 */
final class SchemeFee implements BaseModel
{
    /** @use SdkModel<SchemeFeeShape> */
    use SdkModel;

    /**
     * The fee amount given as a string containing a decimal number.
     */
    #[Required]
    public string $amount;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the fee was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the fee reimbursement.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The type of fee being assessed.
     *
     * @var value-of<FeeType> $feeType
     */
    #[Required('fee_type', enum: FeeType::class)]
    public string $feeType;

    /**
     * The fixed component of the fee, if applicable, given in major units of the fee amount.
     */
    #[Required('fixed_component')]
    public ?string $fixedComponent;

    /**
     * The variable rate component of the fee, if applicable, given as a decimal (e.g., 0.015 for 1.5%).
     */
    #[Required('variable_rate')]
    public ?string $variableRate;

    /**
     * `new SchemeFee()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SchemeFee::with(
     *   amount: ...,
     *   createdAt: ...,
     *   currency: ...,
     *   feeType: ...,
     *   fixedComponent: ...,
     *   variableRate: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SchemeFee)
     *   ->withAmount(...)
     *   ->withCreatedAt(...)
     *   ->withCurrency(...)
     *   ->withFeeType(...)
     *   ->withFixedComponent(...)
     *   ->withVariableRate(...)
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
     * @param Currency|value-of<Currency> $currency
     * @param FeeType|value-of<FeeType> $feeType
     */
    public static function with(
        string $amount,
        \DateTimeInterface $createdAt,
        Currency|string $currency,
        FeeType|string $feeType,
        ?string $fixedComponent,
        ?string $variableRate,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['createdAt'] = $createdAt;
        $self['currency'] = $currency;
        $self['feeType'] = $feeType;
        $self['fixedComponent'] = $fixedComponent;
        $self['variableRate'] = $variableRate;

        return $self;
    }

    /**
     * The fee amount given as a string containing a decimal number.
     */
    public function withAmount(string $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the fee was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the fee reimbursement.
     *
     * @param Currency|value-of<Currency> $currency
     */
    public function withCurrency(Currency|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * The type of fee being assessed.
     *
     * @param FeeType|value-of<FeeType> $feeType
     */
    public function withFeeType(FeeType|string $feeType): self
    {
        $self = clone $this;
        $self['feeType'] = $feeType;

        return $self;
    }

    /**
     * The fixed component of the fee, if applicable, given in major units of the fee amount.
     */
    public function withFixedComponent(?string $fixedComponent): self
    {
        $self = clone $this;
        $self['fixedComponent'] = $fixedComponent;

        return $self;
    }

    /**
     * The variable rate component of the fee, if applicable, given as a decimal (e.g., 0.015 for 1.5%).
     */
    public function withVariableRate(?string $variableRate): self
    {
        $self = clone $this;
        $self['variableRate'] = $variableRate;

        return $self;
    }
}
