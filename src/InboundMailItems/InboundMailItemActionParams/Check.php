<?php

declare(strict_types=1);

namespace Increase\InboundMailItems\InboundMailItemActionParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundMailItems\InboundMailItemActionParams\Check\Action;

/**
 * @phpstan-type CheckShape = array{
 *   action: Action|value-of<Action>, account?: string|null
 * }
 */
final class Check implements BaseModel
{
    /** @use SdkModel<CheckShape> */
    use SdkModel;

    /**
     * The action to perform on the Inbound Mail Item.
     *
     * @var value-of<Action> $action
     */
    #[Required(enum: Action::class)]
    public string $action;

    /**
     * The identifier of the Account to deposit the check into. If not provided, the check will be deposited into the Account associated with the Lockbox.
     */
    #[Optional]
    public ?string $account;

    /**
     * `new Check()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Check::with(action: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Check)->withAction(...)
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
     * @param Action|value-of<Action> $action
     */
    public static function with(
        Action|string $action,
        ?string $account = null
    ): self {
        $self = new self;

        $self['action'] = $action;

        null !== $account && $self['account'] = $account;

        return $self;
    }

    /**
     * The action to perform on the Inbound Mail Item.
     *
     * @param Action|value-of<Action> $action
     */
    public function withAction(Action|string $action): self
    {
        $self = clone $this;
        $self['action'] = $action;

        return $self;
    }

    /**
     * The identifier of the Account to deposit the check into. If not provided, the check will be deposited into the Account associated with the Lockbox.
     */
    public function withAccount(string $account): self
    {
        $self = clone $this;
        $self['account'] = $account;

        return $self;
    }
}
