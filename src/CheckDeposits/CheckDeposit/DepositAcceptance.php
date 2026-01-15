<?php

declare(strict_types=1);

namespace Increase\CheckDeposits\CheckDeposit;

use Increase\CheckDeposits\CheckDeposit\DepositAcceptance\Currency;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Once your deposit is successfully parsed and accepted by Increase, this will contain details of the parsed check.
 *
 * @phpstan-type DepositAcceptanceShape = array{
 *   accountNumber: string,
 *   amount: int,
 *   auxiliaryOnUs: string|null,
 *   checkDepositID: string,
 *   currency: Currency|value-of<Currency>,
 *   routingNumber: string,
 *   serialNumber: string|null,
 * }
 */
final class DepositAcceptance implements BaseModel
{
    /** @use SdkModel<DepositAcceptanceShape> */
    use SdkModel;

    /**
     * The account number printed on the check. This is an account at the bank that issued the check.
     */
    #[Required('account_number')]
    public string $accountNumber;

    /**
     * The amount to be deposited in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * An additional line of metadata printed on the check. This typically includes the check number for business checks.
     */
    #[Required('auxiliary_on_us')]
    public ?string $auxiliaryOnUs;

    /**
     * The ID of the Check Deposit that was accepted.
     */
    #[Required('check_deposit_id')]
    public string $checkDepositID;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transaction's currency.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The routing number printed on the check. This is a routing number for the bank that issued the check.
     */
    #[Required('routing_number')]
    public string $routingNumber;

    /**
     * The check serial number, if present, for consumer checks. For business checks, the serial number is usually in the `auxiliary_on_us` field.
     */
    #[Required('serial_number')]
    public ?string $serialNumber;

    /**
     * `new DepositAcceptance()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DepositAcceptance::with(
     *   accountNumber: ...,
     *   amount: ...,
     *   auxiliaryOnUs: ...,
     *   checkDepositID: ...,
     *   currency: ...,
     *   routingNumber: ...,
     *   serialNumber: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DepositAcceptance)
     *   ->withAccountNumber(...)
     *   ->withAmount(...)
     *   ->withAuxiliaryOnUs(...)
     *   ->withCheckDepositID(...)
     *   ->withCurrency(...)
     *   ->withRoutingNumber(...)
     *   ->withSerialNumber(...)
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
     */
    public static function with(
        string $accountNumber,
        int $amount,
        ?string $auxiliaryOnUs,
        string $checkDepositID,
        Currency|string $currency,
        string $routingNumber,
        ?string $serialNumber,
    ): self {
        $self = new self;

        $self['accountNumber'] = $accountNumber;
        $self['amount'] = $amount;
        $self['auxiliaryOnUs'] = $auxiliaryOnUs;
        $self['checkDepositID'] = $checkDepositID;
        $self['currency'] = $currency;
        $self['routingNumber'] = $routingNumber;
        $self['serialNumber'] = $serialNumber;

        return $self;
    }

    /**
     * The account number printed on the check. This is an account at the bank that issued the check.
     */
    public function withAccountNumber(string $accountNumber): self
    {
        $self = clone $this;
        $self['accountNumber'] = $accountNumber;

        return $self;
    }

    /**
     * The amount to be deposited in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * An additional line of metadata printed on the check. This typically includes the check number for business checks.
     */
    public function withAuxiliaryOnUs(?string $auxiliaryOnUs): self
    {
        $self = clone $this;
        $self['auxiliaryOnUs'] = $auxiliaryOnUs;

        return $self;
    }

    /**
     * The ID of the Check Deposit that was accepted.
     */
    public function withCheckDepositID(string $checkDepositID): self
    {
        $self = clone $this;
        $self['checkDepositID'] = $checkDepositID;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transaction's currency.
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
     * The routing number printed on the check. This is a routing number for the bank that issued the check.
     */
    public function withRoutingNumber(string $routingNumber): self
    {
        $self = clone $this;
        $self['routingNumber'] = $routingNumber;

        return $self;
    }

    /**
     * The check serial number, if present, for consumer checks. For business checks, the serial number is usually in the `auxiliary_on_us` field.
     */
    public function withSerialNumber(?string $serialNumber): self
    {
        $self = clone $this;
        $self['serialNumber'] = $serialNumber;

        return $self;
    }
}
