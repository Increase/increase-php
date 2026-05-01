<?php

declare(strict_types=1);

namespace Increase\Simulations\Entities\EntityUpdateValidationParams;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\Entities\EntityUpdateValidationParams\Issue\Category;

/**
 * @phpstan-type IssueShape = array{category: Category|value-of<Category>}
 */
final class Issue implements BaseModel
{
    /** @use SdkModel<IssueShape> */
    use SdkModel;

    /**
     * The type of issue.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * `new Issue()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Issue::with(category: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Issue)->withCategory(...)
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
     */
    public static function with(Category|string $category): self
    {
        $self = new self;

        $self['category'] = $category;

        return $self;
    }

    /**
     * The type of issue.
     *
     * @param Category|value-of<Category> $category
     */
    public function withCategory(Category|string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }
}
