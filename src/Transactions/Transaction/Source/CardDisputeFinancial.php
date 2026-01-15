<?php

declare(strict_types=1);

namespace Increase\Transactions\Transaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Transactions\Transaction\Source\CardDisputeFinancial\Network;
use Increase\Transactions\Transaction\Source\CardDisputeFinancial\Visa;

/**
 * A Card Dispute Financial object. This field will be present in the JSON response if and only if `category` is equal to `card_dispute_financial`. Financial event related to a Card Dispute.
 *
 * @phpstan-import-type VisaShape from \Increase\Transactions\Transaction\Source\CardDisputeFinancial\Visa
 *
 * @phpstan-type CardDisputeFinancialShape = array{
 *   amount: int,
 *   network: Network|value-of<Network>,
 *   transactionID: string,
 *   visa: null|Visa|VisaShape,
 * }
 */
final class CardDisputeFinancial implements BaseModel
{
    /** @use SdkModel<CardDisputeFinancialShape> */
    use SdkModel;

    /**
     * The amount of the financial event.
     */
    #[Required]
    public int $amount;

    /**
     * The network that the Card Dispute is associated with.
     *
     * @var value-of<Network> $network
     */
    #[Required(enum: Network::class)]
    public string $network;

    /**
     * The identifier of the Transaction that was created to credit or debit the disputed funds to or from your account.
     */
    #[Required('transaction_id')]
    public string $transactionID;

    /**
     * Information for events related to card dispute for card payments processed over Visa's network. This field will be present in the JSON response if and only if `network` is equal to `visa`.
     */
    #[Required]
    public ?Visa $visa;

    /**
     * `new CardDisputeFinancial()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardDisputeFinancial::with(
     *   amount: ..., network: ..., transactionID: ..., visa: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardDisputeFinancial)
     *   ->withAmount(...)
     *   ->withNetwork(...)
     *   ->withTransactionID(...)
     *   ->withVisa(...)
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
     * @param Network|value-of<Network> $network
     * @param Visa|VisaShape|null $visa
     */
    public static function with(
        int $amount,
        Network|string $network,
        string $transactionID,
        Visa|array|null $visa,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['network'] = $network;
        $self['transactionID'] = $transactionID;
        $self['visa'] = $visa;

        return $self;
    }

    /**
     * The amount of the financial event.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The network that the Card Dispute is associated with.
     *
     * @param Network|value-of<Network> $network
     */
    public function withNetwork(Network|string $network): self
    {
        $self = clone $this;
        $self['network'] = $network;

        return $self;
    }

    /**
     * The identifier of the Transaction that was created to credit or debit the disputed funds to or from your account.
     */
    public function withTransactionID(string $transactionID): self
    {
        $self = clone $this;
        $self['transactionID'] = $transactionID;

        return $self;
    }

    /**
     * Information for events related to card dispute for card payments processed over Visa's network. This field will be present in the JSON response if and only if `network` is equal to `visa`.
     *
     * @param Visa|VisaShape|null $visa
     */
    public function withVisa(Visa|array|null $visa): self
    {
        $self = clone $this;
        $self['visa'] = $visa;

        return $self;
    }
}
