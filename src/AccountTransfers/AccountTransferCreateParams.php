<?php

declare(strict_types=1);

namespace Increase\AccountTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create an Account Transfer.
 *
 * @see Increase\Services\AccountTransfersService::create()
 *
 * @phpstan-type AccountTransferCreateParamsShape = array{
 *   accountID: string,
 *   amount: int,
 *   description: string,
 *   destinationAccountID: string,
 *   requireApproval?: bool|null,
 * }
 */
final class AccountTransferCreateParams implements BaseModel
{
    /** @use SdkModel<AccountTransferCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier for the originating Account that will send the transfer.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The transfer amount in the minor unit of the account currency. For dollars, for example, this is cents.
     */
    #[Required]
    public int $amount;

    /**
     * An internal-facing description for the transfer for display in the API and dashboard. This will also show in the description of the created Transactions.
     */
    #[Required]
    public string $description;

    /**
     * The identifier for the destination Account that will receive the transfer.
     */
    #[Required('destination_account_id')]
    public string $destinationAccountID;

    /**
     * Whether the transfer should require explicit approval via the dashboard or API. For more information, see [Transfer Approvals](/documentation/transfer-approvals).
     */
    #[Optional('require_approval')]
    public ?bool $requireApproval;

    /**
     * `new AccountTransferCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountTransferCreateParams::with(
     *   accountID: ..., amount: ..., description: ..., destinationAccountID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountTransferCreateParams)
     *   ->withAccountID(...)
     *   ->withAmount(...)
     *   ->withDescription(...)
     *   ->withDestinationAccountID(...)
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
        string $description,
        string $destinationAccountID,
        ?bool $requireApproval = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['amount'] = $amount;
        $self['description'] = $description;
        $self['destinationAccountID'] = $destinationAccountID;

        null !== $requireApproval && $self['requireApproval'] = $requireApproval;

        return $self;
    }

    /**
     * The identifier for the originating Account that will send the transfer.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The transfer amount in the minor unit of the account currency. For dollars, for example, this is cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * An internal-facing description for the transfer for display in the API and dashboard. This will also show in the description of the created Transactions.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The identifier for the destination Account that will receive the transfer.
     */
    public function withDestinationAccountID(string $destinationAccountID): self
    {
        $self = clone $this;
        $self['destinationAccountID'] = $destinationAccountID;

        return $self;
    }

    /**
     * Whether the transfer should require explicit approval via the dashboard or API. For more information, see [Transfer Approvals](/documentation/transfer-approvals).
     */
    public function withRequireApproval(bool $requireApproval): self
    {
        $self = clone $this;
        $self['requireApproval'] = $requireApproval;

        return $self;
    }
}
