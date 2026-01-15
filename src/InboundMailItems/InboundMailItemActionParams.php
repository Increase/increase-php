<?php

declare(strict_types=1);

namespace Increase\InboundMailItems;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\InboundMailItems\InboundMailItemActionParams\Check;

/**
 * Action a Inbound Mail Item.
 *
 * @see Increase\Services\InboundMailItemsService::action()
 *
 * @phpstan-import-type CheckShape from \Increase\InboundMailItems\InboundMailItemActionParams\Check
 *
 * @phpstan-type InboundMailItemActionParamsShape = array{
 *   checks: list<Check|CheckShape>
 * }
 */
final class InboundMailItemActionParams implements BaseModel
{
    /** @use SdkModel<InboundMailItemActionParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The actions to perform on the Inbound Mail Item.
     *
     * @var list<Check> $checks
     */
    #[Required(list: Check::class)]
    public array $checks;

    /**
     * `new InboundMailItemActionParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundMailItemActionParams::with(checks: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundMailItemActionParams)->withChecks(...)
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
     * @param list<Check|CheckShape> $checks
     */
    public static function with(array $checks): self
    {
        $self = new self;

        $self['checks'] = $checks;

        return $self;
    }

    /**
     * The actions to perform on the Inbound Mail Item.
     *
     * @param list<Check|CheckShape> $checks
     */
    public function withChecks(array $checks): self
    {
        $self = clone $this;
        $self['checks'] = $checks;

        return $self;
    }
}
