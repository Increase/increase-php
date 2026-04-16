<?php

declare(strict_types=1);

namespace Increase\Events\EventListParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Events\EventListParams\OrderBy\Direction;
use Increase\Events\EventListParams\OrderBy\Field;

/**
 * @phpstan-type OrderByShape = array{
 *   direction?: null|Direction|value-of<Direction>,
 *   field?: null|Field|value-of<Field>,
 * }
 */
final class OrderBy implements BaseModel
{
    /** @use SdkModel<OrderByShape> */
    use SdkModel;

    /**
     * The direction to order in.
     *
     * @var value-of<Direction>|null $direction
     */
    #[Optional(enum: Direction::class)]
    public ?string $direction;

    /**
     * The field to order by.
     *
     * @var value-of<Field>|null $field
     */
    #[Optional(enum: Field::class)]
    public ?string $field;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Direction|value-of<Direction>|null $direction
     * @param Field|value-of<Field>|null $field
     */
    public static function with(
        Direction|string|null $direction = null,
        Field|string|null $field = null
    ): self {
        $self = new self;

        null !== $direction && $self['direction'] = $direction;
        null !== $field && $self['field'] = $field;

        return $self;
    }

    /**
     * The direction to order in.
     *
     * @param Direction|value-of<Direction> $direction
     */
    public function withDirection(Direction|string $direction): self
    {
        $self = clone $this;
        $self['direction'] = $direction;

        return $self;
    }

    /**
     * The field to order by.
     *
     * @param Field|value-of<Field> $field
     */
    public function withField(Field|string $field): self
    {
        $self = clone $this;
        $self['field'] = $field;

        return $self;
    }
}
