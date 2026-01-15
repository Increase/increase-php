<?php

declare(strict_types=1);

namespace Increase\CheckTransfers;

use Increase\CheckTransfers\CheckTransferCreateParams\BalanceCheck;
use Increase\CheckTransfers\CheckTransferCreateParams\FulfillmentMethod;
use Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck;
use Increase\CheckTransfers\CheckTransferCreateParams\ThirdParty;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create a Check Transfer.
 *
 * @see Increase\Services\CheckTransfersService::create()
 *
 * @phpstan-import-type PhysicalCheckShape from \Increase\CheckTransfers\CheckTransferCreateParams\PhysicalCheck
 * @phpstan-import-type ThirdPartyShape from \Increase\CheckTransfers\CheckTransferCreateParams\ThirdParty
 *
 * @phpstan-type CheckTransferCreateParamsShape = array{
 *   accountID: string,
 *   amount: int,
 *   fulfillmentMethod: FulfillmentMethod|value-of<FulfillmentMethod>,
 *   sourceAccountNumberID: string,
 *   balanceCheck?: null|BalanceCheck|value-of<BalanceCheck>,
 *   checkNumber?: string|null,
 *   physicalCheck?: null|PhysicalCheck|PhysicalCheckShape,
 *   requireApproval?: bool|null,
 *   thirdParty?: null|ThirdParty|ThirdPartyShape,
 *   validUntilDate?: string|null,
 * }
 */
final class CheckTransferCreateParams implements BaseModel
{
    /** @use SdkModel<CheckTransferCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier for the account that will send the transfer.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The transfer amount in USD cents.
     */
    #[Required]
    public int $amount;

    /**
     * Whether Increase will print and mail the check or if you will do it yourself.
     *
     * @var value-of<FulfillmentMethod> $fulfillmentMethod
     */
    #[Required('fulfillment_method', enum: FulfillmentMethod::class)]
    public string $fulfillmentMethod;

    /**
     * The identifier of the Account Number from which to send the transfer and print on the check.
     */
    #[Required('source_account_number_id')]
    public string $sourceAccountNumberID;

    /**
     * How the account's available balance should be checked. If omitted, the default behavior is `balance_check: full`.
     *
     * @var value-of<BalanceCheck>|null $balanceCheck
     */
    #[Optional('balance_check', enum: BalanceCheck::class)]
    public ?string $balanceCheck;

    /**
     * The check number Increase should use for the check. This should not contain leading zeroes and must be unique across the `source_account_number`. If this is omitted, Increase will generate a check number for you.
     */
    #[Optional('check_number')]
    public ?string $checkNumber;

    /**
     * Details relating to the physical check that Increase will print and mail. This is required if `fulfillment_method` is equal to `physical_check`. It must not be included if any other `fulfillment_method` is provided.
     */
    #[Optional('physical_check')]
    public ?PhysicalCheck $physicalCheck;

    /**
     * Whether the transfer requires explicit approval via the dashboard or API.
     */
    #[Optional('require_approval')]
    public ?bool $requireApproval;

    /**
     * Details relating to the custom fulfillment you will perform. This is required if `fulfillment_method` is equal to `third_party`. It must not be included if any other `fulfillment_method` is provided.
     */
    #[Optional('third_party')]
    public ?ThirdParty $thirdParty;

    /**
     * If provided, the check will be valid on or before this date. After this date, the check transfer will be automatically stopped and deposits will not be accepted. For checks printed by Increase, this date is included on the check as its expiry.
     */
    #[Optional('valid_until_date')]
    public ?string $validUntilDate;

    /**
     * `new CheckTransferCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckTransferCreateParams::with(
     *   accountID: ...,
     *   amount: ...,
     *   fulfillmentMethod: ...,
     *   sourceAccountNumberID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CheckTransferCreateParams)
     *   ->withAccountID(...)
     *   ->withAmount(...)
     *   ->withFulfillmentMethod(...)
     *   ->withSourceAccountNumberID(...)
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
     * @param FulfillmentMethod|value-of<FulfillmentMethod> $fulfillmentMethod
     * @param BalanceCheck|value-of<BalanceCheck>|null $balanceCheck
     * @param PhysicalCheck|PhysicalCheckShape|null $physicalCheck
     * @param ThirdParty|ThirdPartyShape|null $thirdParty
     */
    public static function with(
        string $accountID,
        int $amount,
        FulfillmentMethod|string $fulfillmentMethod,
        string $sourceAccountNumberID,
        BalanceCheck|string|null $balanceCheck = null,
        ?string $checkNumber = null,
        PhysicalCheck|array|null $physicalCheck = null,
        ?bool $requireApproval = null,
        ThirdParty|array|null $thirdParty = null,
        ?string $validUntilDate = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['amount'] = $amount;
        $self['fulfillmentMethod'] = $fulfillmentMethod;
        $self['sourceAccountNumberID'] = $sourceAccountNumberID;

        null !== $balanceCheck && $self['balanceCheck'] = $balanceCheck;
        null !== $checkNumber && $self['checkNumber'] = $checkNumber;
        null !== $physicalCheck && $self['physicalCheck'] = $physicalCheck;
        null !== $requireApproval && $self['requireApproval'] = $requireApproval;
        null !== $thirdParty && $self['thirdParty'] = $thirdParty;
        null !== $validUntilDate && $self['validUntilDate'] = $validUntilDate;

        return $self;
    }

    /**
     * The identifier for the account that will send the transfer.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The transfer amount in USD cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * Whether Increase will print and mail the check or if you will do it yourself.
     *
     * @param FulfillmentMethod|value-of<FulfillmentMethod> $fulfillmentMethod
     */
    public function withFulfillmentMethod(
        FulfillmentMethod|string $fulfillmentMethod
    ): self {
        $self = clone $this;
        $self['fulfillmentMethod'] = $fulfillmentMethod;

        return $self;
    }

    /**
     * The identifier of the Account Number from which to send the transfer and print on the check.
     */
    public function withSourceAccountNumberID(
        string $sourceAccountNumberID
    ): self {
        $self = clone $this;
        $self['sourceAccountNumberID'] = $sourceAccountNumberID;

        return $self;
    }

    /**
     * How the account's available balance should be checked. If omitted, the default behavior is `balance_check: full`.
     *
     * @param BalanceCheck|value-of<BalanceCheck> $balanceCheck
     */
    public function withBalanceCheck(BalanceCheck|string $balanceCheck): self
    {
        $self = clone $this;
        $self['balanceCheck'] = $balanceCheck;

        return $self;
    }

    /**
     * The check number Increase should use for the check. This should not contain leading zeroes and must be unique across the `source_account_number`. If this is omitted, Increase will generate a check number for you.
     */
    public function withCheckNumber(string $checkNumber): self
    {
        $self = clone $this;
        $self['checkNumber'] = $checkNumber;

        return $self;
    }

    /**
     * Details relating to the physical check that Increase will print and mail. This is required if `fulfillment_method` is equal to `physical_check`. It must not be included if any other `fulfillment_method` is provided.
     *
     * @param PhysicalCheck|PhysicalCheckShape $physicalCheck
     */
    public function withPhysicalCheck(PhysicalCheck|array $physicalCheck): self
    {
        $self = clone $this;
        $self['physicalCheck'] = $physicalCheck;

        return $self;
    }

    /**
     * Whether the transfer requires explicit approval via the dashboard or API.
     */
    public function withRequireApproval(bool $requireApproval): self
    {
        $self = clone $this;
        $self['requireApproval'] = $requireApproval;

        return $self;
    }

    /**
     * Details relating to the custom fulfillment you will perform. This is required if `fulfillment_method` is equal to `third_party`. It must not be included if any other `fulfillment_method` is provided.
     *
     * @param ThirdParty|ThirdPartyShape $thirdParty
     */
    public function withThirdParty(ThirdParty|array $thirdParty): self
    {
        $self = clone $this;
        $self['thirdParty'] = $thirdParty;

        return $self;
    }

    /**
     * If provided, the check will be valid on or before this date. After this date, the check transfer will be automatically stopped and deposits will not be accepted. For checks printed by Increase, this date is included on the check as its expiry.
     */
    public function withValidUntilDate(string $validUntilDate): self
    {
        $self = clone $this;
        $self['validUntilDate'] = $validUntilDate;

        return $self;
    }
}
