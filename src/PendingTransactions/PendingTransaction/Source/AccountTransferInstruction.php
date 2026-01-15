<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\PendingTransactions\PendingTransaction\Source\AccountTransferInstruction\Currency;

/**
 * An Account Transfer Instruction object. This field will be present in the JSON response if and only if `category` is equal to `account_transfer_instruction`.
 *
 * @phpstan-type AccountTransferInstructionShape = array{
 *   amount: int, currency: Currency|value-of<Currency>, transferID: string
 * }
 */
final class AccountTransferInstruction implements BaseModel
{
    /** @use SdkModel<AccountTransferInstructionShape> */
    use SdkModel;

    /**
     * The pending amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the destination account currency.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The identifier of the Account Transfer that led to this Pending Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new AccountTransferInstruction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountTransferInstruction::with(amount: ..., currency: ..., transferID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountTransferInstruction)
     *   ->withAmount(...)
     *   ->withCurrency(...)
     *   ->withTransferID(...)
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
        int $amount,
        Currency|string $currency,
        string $transferID
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['currency'] = $currency;
        $self['transferID'] = $transferID;

        return $self;
    }

    /**
     * The pending amount in the minor unit of the transaction's currency. For dollars, for example, this is cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the destination account currency.
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
     * The identifier of the Account Transfer that led to this Pending Transaction.
     */
    public function withTransferID(string $transferID): self
    {
        $self = clone $this;
        $self['transferID'] = $transferID;

        return $self;
    }
}
