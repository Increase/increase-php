<?php

declare(strict_types=1);

namespace Increase\Cards\CardUpdateParams\AuthorizationControls;

use Increase\Cards\CardUpdateParams\AuthorizationControls\Usage\Category;
use Increase\Cards\CardUpdateParams\AuthorizationControls\Usage\MultiUse;
use Increase\Cards\CardUpdateParams\AuthorizationControls\Usage\SingleUse;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Controls how many times this card can be used.
 *
 * @phpstan-import-type MultiUseShape from \Increase\Cards\CardUpdateParams\AuthorizationControls\Usage\MultiUse
 * @phpstan-import-type SingleUseShape from \Increase\Cards\CardUpdateParams\AuthorizationControls\Usage\SingleUse
 *
 * @phpstan-type UsageShape = array{
 *   category: Category|value-of<Category>,
 *   multiUse?: null|MultiUse|MultiUseShape,
 *   singleUse?: null|SingleUse|SingleUseShape,
 * }
 */
final class Usage implements BaseModel
{
    /** @use SdkModel<UsageShape> */
    use SdkModel;

    /**
     * Whether the card is for a single use or multiple uses.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * Controls for multi-use cards. Required if and only if `category` is `multi_use`.
     */
    #[Optional('multi_use')]
    public ?MultiUse $multiUse;

    /**
     * Controls for single-use cards. Required if and only if `category` is `single_use`.
     */
    #[Optional('single_use')]
    public ?SingleUse $singleUse;

    /**
     * `new Usage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Usage::with(category: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Usage)->withCategory(...)
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
     * @param Category|value-of<Category> $category
     * @param MultiUse|MultiUseShape|null $multiUse
     * @param SingleUse|SingleUseShape|null $singleUse
     */
    public static function with(
        Category|string $category,
        MultiUse|array|null $multiUse = null,
        SingleUse|array|null $singleUse = null,
    ): self {
        $self = new self;

        $self['category'] = $category;

        null !== $multiUse && $self['multiUse'] = $multiUse;
        null !== $singleUse && $self['singleUse'] = $singleUse;

        return $self;
    }

    /**
     * Whether the card is for a single use or multiple uses.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(Category|string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * Controls for multi-use cards. Required if and only if `category` is `multi_use`.
     *
     * @param MultiUse|MultiUseShape $multiUse
     */
    public function withMultiUse(MultiUse|array $multiUse): self
    {
        $self = clone $this;
        $self['multiUse'] = $multiUse;

        return $self;
    }

    /**
     * Controls for single-use cards. Required if and only if `category` is `single_use`.
     *
     * @param SingleUse|SingleUseShape $singleUse
     */
    public function withSingleUse(SingleUse|array $singleUse): self
    {
        $self = clone $this;
        $self['singleUse'] = $singleUse;

        return $self;
    }
}
