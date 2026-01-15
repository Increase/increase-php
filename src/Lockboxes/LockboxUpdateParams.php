<?php

declare(strict_types=1);

namespace Increase\Lockboxes;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Lockboxes\LockboxUpdateParams\CheckDepositBehavior;

/**
 * Update a Lockbox.
 *
 * @see Increase\Services\LockboxesService::update()
 *
 * @phpstan-type LockboxUpdateParamsShape = array{
 *   checkDepositBehavior?: null|CheckDepositBehavior|value-of<CheckDepositBehavior>,
 *   description?: string|null,
 *   recipientName?: string|null,
 * }
 */
final class LockboxUpdateParams implements BaseModel
{
    /** @use SdkModel<LockboxUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * This indicates if checks mailed to this lockbox will be deposited.
     *
     * @var value-of<CheckDepositBehavior>|null $checkDepositBehavior
     */
    #[Optional('check_deposit_behavior', enum: CheckDepositBehavior::class)]
    public ?string $checkDepositBehavior;

    /**
     * The description you choose for the Lockbox.
     */
    #[Optional]
    public ?string $description;

    /**
     * The recipient name you choose for the Lockbox.
     */
    #[Optional('recipient_name')]
    public ?string $recipientName;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param CheckDepositBehavior|value-of<CheckDepositBehavior>|null $checkDepositBehavior
     */
    public static function with(
        CheckDepositBehavior|string|null $checkDepositBehavior = null,
        ?string $description = null,
        ?string $recipientName = null,
    ): self {
        $self = new self;

        null !== $checkDepositBehavior && $self['checkDepositBehavior'] = $checkDepositBehavior;
        null !== $description && $self['description'] = $description;
        null !== $recipientName && $self['recipientName'] = $recipientName;

        return $self;
    }

    /**
     * This indicates if checks mailed to this lockbox will be deposited.
     *
     * @param CheckDepositBehavior|value-of<CheckDepositBehavior> $checkDepositBehavior
     */
    public function withCheckDepositBehavior(
        CheckDepositBehavior|string $checkDepositBehavior
    ): self {
        $self = clone $this;
        $self['checkDepositBehavior'] = $checkDepositBehavior;

        return $self;
    }

    /**
     * The description you choose for the Lockbox.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * The recipient name you choose for the Lockbox.
     */
    public function withRecipientName(string $recipientName): self
    {
        $self = clone $this;
        $self['recipientName'] = $recipientName;

        return $self;
    }
}
