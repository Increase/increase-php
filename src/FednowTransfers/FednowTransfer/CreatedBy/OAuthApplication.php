<?php

declare(strict_types=1);

namespace Increase\FednowTransfers\FednowTransfer\CreatedBy;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If present, details about the OAuth Application that created the transfer.
 *
 * @phpstan-type OAuthApplicationShape = array{name: string}
 */
final class OAuthApplication implements BaseModel
{
    /** @use SdkModel<OAuthApplicationShape> */
    use SdkModel;

    /**
     * The name of the OAuth Application.
     */
    #[Required]
    public string $name;

    /**
     * `new OAuthApplication()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OAuthApplication::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OAuthApplication)->withName(...)
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
     * The name of the OAuth Application.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
