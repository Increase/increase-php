<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\AccountTransferIntention\Currency;

/**
 * An Account Transfer Intention object. This field will be present in the JSON response if and only if `category` is equal to `account_transfer_intention`. Two Account Transfer Intentions are created from each Account Transfer. One decrements the source account, and the other increments the destination account.
 *
 * @phpstan-type AccountTransferIntentionShape = array{
 *   amount: int,
 *   currency: Currency|value-of<Currency>,
 *   description: string,
 *   destinationAccountID: string,
 *   sourceAccountID: string,
 *   transferID: string,
 * }
 */
final class AccountTransferIntention implements BaseModel
{
    /** @use SdkModel<AccountTransferIntentionShape> */
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
     * The description you chose to give the transfer.
     */
    #[Required]
    public string $description;

    /**
     * The identifier of the Account to where the Account Transfer was sent.
     */
    #[Required('destination_account_id')]
    public string $destinationAccountID;

    /**
     * The identifier of the Account from where the Account Transfer was sent.
     */
    #[Required('source_account_id')]
    public string $sourceAccountID;

    /**
     * The identifier of the Account Transfer that led to this Pending Transaction.
     */
    #[Required('transfer_id')]
    public string $transferID;

    /**
     * `new AccountTransferIntention()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountTransferIntention::with(
     *   amount: ...,
     *   currency: ...,
     *   description: ...,
     *   destinationAccountID: ...,
     *   sourceAccountID: ...,
     *   transferID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountTransferIntention)
     *   ->withAmount(...)
     *   ->withCurrency(...)
     *   ->withDescription(...)
     *   ->withDestinationAccountID(...)
     *   ->withSourceAccountID(...)
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
        string $description,
        string $destinationAccountID,
        string $sourceAccountID,
        string $transferID,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['currency'] = $currency;
        $self['description'] = $description;
        $self['destinationAccountID'] = $destinationAccountID;
        $self['sourceAccountID'] = $sourceAccountID;
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
     * The description you chose to give the transfer.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The identifier of the Account to where the Account Transfer was sent.
     */
    public function withDestinationAccountID(string $destinationAccountID): self
    {
        $self = clone $this;
        $self['destinationAccountID'] = $destinationAccountID;

        return $self;
    }

    /**
     * The identifier of the Account from where the Account Transfer was sent.
     */
    public function withSourceAccountID(string $sourceAccountID): self
    {
        $self = clone $this;
        $self['sourceAccountID'] = $sourceAccountID;

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
