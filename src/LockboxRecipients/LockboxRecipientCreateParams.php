<?php

declare(strict_types=1);

namespace Increase\LockboxRecipients;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create a Lockbox Recipient.
 *
 * @see Increase\Services\LockboxRecipientsService::create()
 *
 * @phpstan-type LockboxRecipientCreateParamsShape = array{
 *   accountID: string,
 *   lockboxAddressID: string,
 *   description?: string|null,
 *   recipientName?: string|null,
 * }
 */
final class LockboxRecipientCreateParams implements BaseModel
{
    /** @use SdkModel<LockboxRecipientCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The Account that checks sent to this Lockbox Recipient should be deposited into.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The Lockbox Address where this Lockbox Recipient may receive mail.
     */
    #[Required('lockbox_address_id')]
    public string $lockboxAddressID;

    /**
     * The description you choose for the Lockbox Recipient.
     */
    #[Optional]
    public ?string $description;

    /**
     * The name of the Lockbox Recipient.
     */
    #[Optional('recipient_name')]
    public ?string $recipientName;

    /**
     * `new LockboxRecipientCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LockboxRecipientCreateParams::with(accountID: ..., lockboxAddressID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LockboxRecipientCreateParams)
     *   ->withAccountID(...)
     *   ->withLockboxAddressID(...)
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
        string $lockboxAddressID,
        ?string $description = null,
        ?string $recipientName = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['lockboxAddressID'] = $lockboxAddressID;

        null !== $description && $self['description'] = $description;
        null !== $recipientName && $self['recipientName'] = $recipientName;

        return $self;
    }

    /**
     * The Account that checks sent to this Lockbox Recipient should be deposited into.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The Lockbox Address where this Lockbox Recipient may receive mail.
     */
    public function withLockboxAddressID(string $lockboxAddressID): self
    {
        $self = clone $this;
        $self['lockboxAddressID'] = $lockboxAddressID;

        return $self;
    }

    /**
     * The description you choose for the Lockbox Recipient.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The name of the Lockbox Recipient.
     */
    public function withRecipientName(string $recipientName): self
    {
        $self = clone $this;
        $self['recipientName'] = $recipientName;

        return $self;
    }
}
