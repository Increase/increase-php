<?php

declare(strict_types=1);

namespace Increase\Cards\CardCreateParams\AuthorizationControls;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Limits the number of authorizations that can be approved on this card.
 *
 * @phpstan-type MaximumAuthorizationCountShape = array{allTime: int}
 */
final class MaximumAuthorizationCount implements BaseModel
{
    /** @use SdkModel<MaximumAuthorizationCountShape> */
    use SdkModel;

    /**
     * The maximum number of authorizations that can be approved on this card over its lifetime.
     */
    #[Required('all_time')]
    public int $allTime;

    /**
     * `new MaximumAuthorizationCount()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MaximumAuthorizationCount::with(allTime: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MaximumAuthorizationCount)->withAllTime(...)
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
    public static function with(int $allTime): self
    {
        $self = new self;

        $self['allTime'] = $allTime;

        return $self;
    }

    /**
     * The maximum number of authorizations that can be approved on this card over its lifetime.
     */
    public function withAllTime(int $allTime): self
    {
        $self = clone $this;
        $self['allTime'] = $allTime;

        return $self;
    }
}
