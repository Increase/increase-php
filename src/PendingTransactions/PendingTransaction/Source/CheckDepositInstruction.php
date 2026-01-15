<?php

declare(strict_types=1);

namespace Increase\PendingTransactions\PendingTransaction\Source;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\PendingTransactions\PendingTransaction\Source\CheckDepositInstruction\Currency;

/**
 * A Check Deposit Instruction object. This field will be present in the JSON response if and only if `category` is equal to `check_deposit_instruction`.
 *
 * @phpstan-type CheckDepositInstructionShape = array{
 *   amount: int,
 *   backImageFileID: string|null,
 *   checkDepositID: string|null,
 *   currency: Currency|value-of<Currency>,
 *   frontImageFileID: string,
 * }
 */
final class CheckDepositInstruction implements BaseModel
{
    /** @use SdkModel<CheckDepositInstructionShape> */
    use SdkModel;

    /**
     * The pending amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * The identifier of the File containing the image of the back of the check that was deposited.
     */
    #[Required('back_image_file_id')]
    public ?string $backImageFileID;

    /**
     * The identifier of the Check Deposit.
     */
    #[Required('check_deposit_id')]
    public ?string $checkDepositID;

    /**
     * The [ISO 4217](https://en.wikipedia.org/wiki/ISO_4217) code for the transaction's currency.
     *
     * @var value-of<Currency> $currency
     */
    #[Required(enum: Currency::class)]
    public string $currency;

    /**
     * The identifier of the File containing the image of the front of the check that was deposited.
     */
    #[Required('front_image_file_id')]
    public string $frontImageFileID;

    /**
     * `new CheckDepositInstruction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckDepositInstruction::with(
     *   amount: ...,
     *   backImageFileID: ...,
     *   checkDepositID: ...,
     *   currency: ...,
     *   frontImageFileID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CheckDepositInstruction)
     *   ->withAmount(...)
     *   ->withBackImageFileID(...)
     *   ->withCheckDepositID(...)
     *   ->withCurrency(...)
     *   ->withFrontImageFileID(...)
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
        ?string $backImageFileID,
        ?string $checkDepositID,
        Currency|string $currency,
        string $frontImageFileID,
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['backImageFileID'] = $backImageFileID;
        $self['checkDepositID'] = $checkDepositID;
        $self['currency'] = $currency;
        $self['frontImageFileID'] = $frontImageFileID;

        return $self;
    }

    /**
     * The pending amount in USD cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The identifier of the File containing the image of the back of the check that was deposited.
     */
    public function withBackImageFileID(?string $backImageFileID): self
    {
        $self = clone $this;
        $self['backImageFileID'] = $backImageFileID;

        return $self;
    }

    /**
     * The identifier of the Check Deposit.
     */
    public function withCheckDepositID(?string $checkDepositID): self
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
     * The identifier of the File containing the image of the front of the check that was deposited.
     */
    public function withFrontImageFileID(string $frontImageFileID): self
    {
        $self = clone $this;
        $self['frontImageFileID'] = $frontImageFileID;

        return $self;
    }
}
