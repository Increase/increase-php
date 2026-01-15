<?php

declare(strict_types=1);

namespace Increase\Simulations\CardTokens\CardTokenCreateParams;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\CardTokens\CardTokenCreateParams\Capability\CrossBorderPushTransfers;
use Increase\Simulations\CardTokens\CardTokenCreateParams\Capability\DomesticPushTransfers;
use Increase\Simulations\CardTokens\CardTokenCreateParams\Capability\Route;

/**
 * @phpstan-type CapabilityShape = array{
 *   crossBorderPushTransfers: CrossBorderPushTransfers|value-of<CrossBorderPushTransfers>,
 *   domesticPushTransfers: DomesticPushTransfers|value-of<DomesticPushTransfers>,
 *   route: Route|value-of<Route>,
 * }
 */
final class Capability implements BaseModel
{
    /** @use SdkModel<CapabilityShape> */
    use SdkModel;

    /**
     * The cross-border push transfers capability.
     *
     * @var value-of<CrossBorderPushTransfers> $crossBorderPushTransfers
     */
    #[Required(
        'cross_border_push_transfers',
        enum: CrossBorderPushTransfers::class
    )]
    public string $crossBorderPushTransfers;

    /**
     * The domestic push transfers capability.
     *
     * @var value-of<DomesticPushTransfers> $domesticPushTransfers
     */
    #[Required('domestic_push_transfers', enum: DomesticPushTransfers::class)]
    public string $domesticPushTransfers;

    /**
     * The route of the capability.
     *
     * @var value-of<Route> $route
     */
    #[Required(enum: Route::class)]
    public string $route;

    /**
     * `new Capability()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Capability::with(
     *   crossBorderPushTransfers: ..., domesticPushTransfers: ..., route: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Capability)
     *   ->withCrossBorderPushTransfers(...)
     *   ->withDomesticPushTransfers(...)
     *   ->withRoute(...)
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
     * @param CrossBorderPushTransfers|value-of<CrossBorderPushTransfers> $crossBorderPushTransfers
     * @param DomesticPushTransfers|value-of<DomesticPushTransfers> $domesticPushTransfers
     * @param Route|value-of<Route> $route
     */
    public static function with(
        CrossBorderPushTransfers|string $crossBorderPushTransfers,
        DomesticPushTransfers|string $domesticPushTransfers,
        Route|string $route,
    ): self {
        $self = new self;

        $self['crossBorderPushTransfers'] = $crossBorderPushTransfers;
        $self['domesticPushTransfers'] = $domesticPushTransfers;
        $self['route'] = $route;

        return $self;
    }

    /**
     * The cross-border push transfers capability.
     *
     * @param CrossBorderPushTransfers|value-of<CrossBorderPushTransfers> $crossBorderPushTransfers
     */
    public function withCrossBorderPushTransfers(
        CrossBorderPushTransfers|string $crossBorderPushTransfers
    ): self {
        $self = clone $this;
        $self['crossBorderPushTransfers'] = $crossBorderPushTransfers;

        return $self;
    }

    /**
     * The domestic push transfers capability.
     *
     * @param DomesticPushTransfers|value-of<DomesticPushTransfers> $domesticPushTransfers
     */
    public function withDomesticPushTransfers(
        DomesticPushTransfers|string $domesticPushTransfers
    ): self {
        $self = clone $this;
        $self['domesticPushTransfers'] = $domesticPushTransfers;

        return $self;
    }

    /**
     * The route of the capability.
     *
     * @param Route|value-of<Route> $route
     */
    public function withRoute(Route|string $route): self
    {
        $self = clone $this;
        $self['route'] = $route;

        return $self;
    }
}
