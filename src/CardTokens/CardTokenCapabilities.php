<?php

declare(strict_types=1);

namespace Increase\CardTokens;

use Increase\CardTokens\CardTokenCapabilities\Route1 as Route;
use Increase\CardTokens\CardTokenCapabilities\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The capabilities of a Card Token describe whether the card can be used for specific operations, such as Card Push Transfers. The capabilities can change over time based on the issuing bank's configuration of the card range.
 *
 * @phpstan-import-type Route1Shape from \Increase\CardTokens\CardTokenCapabilities\Route1
 *
 * @phpstan-type CardTokenCapabilitiesShape = array{
 *   routes: list<Route|Route1Shape>, type: Type|value-of<Type>
 * }
 */
final class CardTokenCapabilities implements BaseModel
{
    /** @use SdkModel<CardTokenCapabilitiesShape> */
    use SdkModel;

    /**
     * Each route represent a path e.g., a push transfer can take.
     *
     * @var list<Route> $routes
     */
    #[Required(list: Route::class)]
    public array $routes;

    /**
     * A constant representing the object's type. For this resource it will always be `card_token_capabilities`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new CardTokenCapabilities()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardTokenCapabilities::with(routes: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardTokenCapabilities)->withRoutes(...)->withType(...)
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
     * @param list<Route|Route1Shape> $routes
     * @param Type|value-of<Type> $type
     */
    public static function with(array $routes, Type|string $type): self
    {
        $self = new self;

        $self['routes'] = $routes;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Each route represent a path e.g., a push transfer can take.
     *
     * @param list<Route|Route1Shape> $routes
     */
    public function withRoutes(array $routes): self
    {
        $self = clone $this;
        $self['routes'] = $routes;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `card_token_capabilities`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
