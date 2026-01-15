<?php

declare(strict_types=1);

namespace Increase\Lockboxes;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create a Lockbox.
 *
 * @see Increase\Services\LockboxesService::create()
 *
 * @phpstan-type LockboxCreateParamsShape = array{
 *   accountID: string, description?: string|null, recipientName?: string|null
 * }
 */
final class LockboxCreateParams implements BaseModel
{
    /** @use SdkModel<LockboxCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The Account checks sent to this Lockbox should be deposited into.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The description you choose for the Lockbox, for display purposes.
     */
    #[Optional]
    public ?string $description;

    /**
     * The name of the recipient that will receive mail at this location.
     */
    #[Optional('recipient_name')]
    public ?string $recipientName;

    /**
     * `new LockboxCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LockboxCreateParams::with(accountID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LockboxCreateParams)->withAccountID(...)
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
        ?string $description = null,
        ?string $recipientName = null
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;

        null !== $description && $self['description'] = $description;
        null !== $recipientName && $self['recipientName'] = $recipientName;

        return $self;
    }

    /**
     * The Account checks sent to this Lockbox should be deposited into.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The description you choose for the Lockbox, for display purposes.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The name of the recipient that will receive mail at this location.
     */
    public function withRecipientName(string $recipientName): self
    {
        $self = clone $this;
        $self['recipientName'] = $recipientName;

        return $self;
    }
}
