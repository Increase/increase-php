<?php

declare(strict_types=1);

namespace Increase\Cards\CardUpdateParams\AuthorizationControls\MerchantCategoryCode;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type BlockedShape = array{code: string}
 */
final class Blocked implements BaseModel
{
    /** @use SdkModel<BlockedShape> */
    use SdkModel;

    /**
     * The Merchant Category Code.
     */
    #[Required]
    public string $code;

    /**
     * `new Blocked()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Blocked::with(code: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Blocked)->withCode(...)
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
    public static function with(string $code): self
    {
        $self = new self;

        $self['code'] = $code;

        return $self;
    }

    /**
     * The Merchant Category Code.
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }
}
