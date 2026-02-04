<?php

declare(strict_types=1);

namespace Increase\Exports\ExportListParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type Form1099IntShape = array{accountID?: string|null}
 */
final class Form1099Int implements BaseModel
{
    /** @use SdkModel<Form1099IntShape> */
    use SdkModel;

    /**
     * Filter Form 1099-INT Exports to those for the specified Account.
     */
    #[Optional('account_id')]
    public ?string $accountID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $accountID = null): self
    {
        $self = new self;

        null !== $accountID && $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Filter Form 1099-INT Exports to those for the specified Account.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }
}
