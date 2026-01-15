<?php

declare(strict_types=1);

namespace Increase\CheckDeposits;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create a Check Deposit.
 *
 * @see Increase\Services\CheckDepositsService::create()
 *
 * @phpstan-type CheckDepositCreateParamsShape = array{
 *   accountID: string,
 *   amount: int,
 *   backImageFileID: string,
 *   frontImageFileID: string,
 *   description?: string|null,
 * }
 */
final class CheckDepositCreateParams implements BaseModel
{
    /** @use SdkModel<CheckDepositCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier for the Account to deposit the check in.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The deposit amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * The File containing the check's back image.
     */
    #[Required('back_image_file_id')]
    public string $backImageFileID;

    /**
     * The File containing the check's front image.
     */
    #[Required('front_image_file_id')]
    public string $frontImageFileID;

    /**
     * The description you choose to give the Check Deposit, for display purposes only.
     */
    #[Optional]
    public ?string $description;

    /**
     * `new CheckDepositCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckDepositCreateParams::with(
     *   accountID: ..., amount: ..., backImageFileID: ..., frontImageFileID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CheckDepositCreateParams)
     *   ->withAccountID(...)
     *   ->withAmount(...)
     *   ->withBackImageFileID(...)
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
     */
    public static function with(
        string $accountID,
        int $amount,
        string $backImageFileID,
        string $frontImageFileID,
        ?string $description = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['amount'] = $amount;
        $self['backImageFileID'] = $backImageFileID;
        $self['frontImageFileID'] = $frontImageFileID;

        null !== $description && $self['description'] = $description;

        return $self;
    }

    /**
     * The identifier for the Account to deposit the check in.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The deposit amount in USD cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The File containing the check's back image.
     */
    public function withBackImageFileID(string $backImageFileID): self
    {
        $self = clone $this;
        $self['backImageFileID'] = $backImageFileID;

        return $self;
    }

    /**
     * The File containing the check's front image.
     */
    public function withFrontImageFileID(string $frontImageFileID): self
    {
        $self = clone $this;
        $self['frontImageFileID'] = $frontImageFileID;

        return $self;
    }

    /**
     * The description you choose to give the Check Deposit, for display purposes only.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
