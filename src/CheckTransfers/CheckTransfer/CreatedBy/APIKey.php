<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer\CreatedBy;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If present, details about the API key that created the transfer.
 *
 * @phpstan-type APIKeyShape = array{description: string|null}
 */
final class APIKey implements BaseModel
{
    /** @use SdkModel<APIKeyShape> */
    use SdkModel;

    /**
     * The description set for the API key when it was created.
     */
    #[Required]
    public ?string $description;

    /**
     * `new APIKey()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * APIKey::with(description: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new APIKey)->withDescription(...)
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
    public static function with(?string $description): self
    {
        $self = new self;

        $self['description'] = $description;

        return $self;
    }

    /**
     * The description set for the API key when it was created.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }
}
