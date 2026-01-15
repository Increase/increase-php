<?php

declare(strict_types=1);

namespace Increase\BookkeepingAccounts;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Update a Bookkeeping Account.
 *
 * @see Increase\Services\BookkeepingAccountsService::update()
 *
 * @phpstan-type BookkeepingAccountUpdateParamsShape = array{name: string}
 */
final class BookkeepingAccountUpdateParams implements BaseModel
{
    /** @use SdkModel<BookkeepingAccountUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The name you choose for the account.
     */
    #[Required]
    public string $name;

    /**
     * `new BookkeepingAccountUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BookkeepingAccountUpdateParams::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BookkeepingAccountUpdateParams)->withName(...)
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
    public static function with(string $name): self
    {
        $self = new self;

        $self['name'] = $name;

        return $self;
    }

    /**
     * The name you choose for the account.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
