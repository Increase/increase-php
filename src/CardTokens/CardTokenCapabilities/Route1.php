<?php

declare(strict_types=1);

namespace Increase\CardTokens\CardTokenCapabilities;

use Increase\CardTokens\CardTokenCapabilities\Route1\CrossBorderPushTransfers;
use Increase\CardTokens\CardTokenCapabilities\Route1\DomesticPushTransfers;
use Increase\CardTokens\CardTokenCapabilities\Route1\Route;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type Route1Shape = array{
 *   crossBorderPushTransfers: CrossBorderPushTransfers|value-of<CrossBorderPushTransfers>,
 *   domesticPushTransfers: DomesticPushTransfers|value-of<DomesticPushTransfers>,
 *   route: Route|value-of<Route>,
 * }
 */
final class Route1 implements BaseModel
{
    /** @use SdkModel<Route1Shape> */
    use SdkModel;

    /**
     * Whether you can push funds to the card using cross-border Card Push Transfers.
     *
     * @var value-of<CrossBorderPushTransfers> $crossBorderPushTransfers
     */
    #[Required(
        'cross_border_push_transfers',
        enum: CrossBorderPushTransfers::class
    )]
    public string $crossBorderPushTransfers;

    /**
     * Whether you can push funds to the card using domestic Card Push Transfers.
     *
     * @var value-of<DomesticPushTransfers> $domesticPushTransfers
     */
    #[Required('domestic_push_transfers', enum: DomesticPushTransfers::class)]
    public string $domesticPushTransfers;

    /**
     * The card network route the capabilities apply to.
     *
     * @var value-of<Route> $route
     */
    #[Required(enum: Route::class)]
    public string $route;

    /**
     * `new Route1()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Route1::with(
     *   crossBorderPushTransfers: ..., domesticPushTransfers: ..., route: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Route1)
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
     * Whether you can push funds to the card using cross-border Card Push Transfers.
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
     * Whether you can push funds to the card using domestic Card Push Transfers.
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
     * The card network route the capabilities apply to.
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
