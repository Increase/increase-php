<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa;

use Increase\CardDisputes\CardDisputeCreateParams\Visa\Authorization\AccountStatus;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Authorization. Required if and only if `category` is `authorization`.
 *
 * @phpstan-type AuthorizationShape = array{
 *   accountStatus: AccountStatus|value-of<AccountStatus>
 * }
 */
final class Authorization implements BaseModel
{
    /** @use SdkModel<AuthorizationShape> */
    use SdkModel;

    /**
     * Account status.
     *
     * @var value-of<AccountStatus> $accountStatus
     */
    #[Required('account_status', enum: AccountStatus::class)]
    public string $accountStatus;

    /**
     * `new Authorization()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Authorization::with(accountStatus: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Authorization)->withAccountStatus(...)
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
     * @param AccountStatus|value-of<AccountStatus> $accountStatus
     */
    public static function with(AccountStatus|string $accountStatus): self
    {
        $self = new self;

        $self['accountStatus'] = $accountStatus;

        return $self;
    }

    /**
     * Account status.
     *
     * @param AccountStatus|value-of<AccountStatus> $accountStatus
     */
    public function withAccountStatus(AccountStatus|string $accountStatus): self
    {
        $self = clone $this;
        $self['accountStatus'] = $accountStatus;

        return $self;
    }
}
