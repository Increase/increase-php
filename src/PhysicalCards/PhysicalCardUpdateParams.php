<?php

declare(strict_types=1);

namespace Increase\PhysicalCards;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\PhysicalCards\PhysicalCardUpdateParams\Status;

/**
 * Update a Physical Card.
 *
 * @see Increase\Services\PhysicalCardsService::update()
 *
 * @phpstan-type PhysicalCardUpdateParamsShape = array{
 *   status: Status|value-of<Status>
 * }
 */
final class PhysicalCardUpdateParams implements BaseModel
{
    /** @use SdkModel<PhysicalCardUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The status to update the Physical Card to.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * `new PhysicalCardUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PhysicalCardUpdateParams::with(status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PhysicalCardUpdateParams)->withStatus(...)
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
     * @param Status|value-of<Status> $status
     */
    public static function with(Status|string $status): self
    {
        $self = new self;

        $self['status'] = $status;

        return $self;
    }

    /**
     * The status to update the Physical Card to.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
