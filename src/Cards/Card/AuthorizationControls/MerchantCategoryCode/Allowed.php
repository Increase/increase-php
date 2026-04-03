<?php

declare(strict_types=1);

namespace Increase\Cards\Card\AuthorizationControls\MerchantCategoryCode;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type AllowedShape = array{code: string}
 */
final class Allowed implements BaseModel
{
    /** @use SdkModel<AllowedShape> */
    use SdkModel;

    /**
     * The Merchant Category Code (MCC).
     */
    #[Required]
    public string $code;

    /**
     * `new Allowed()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Allowed::with(code: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Allowed)->withCode(...)
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
     * The Merchant Category Code (MCC).
     */
    public function withCode(string $code): self
    {
        $self = clone $this;
        $self['code'] = $code;

        return $self;
    }
}
