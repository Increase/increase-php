<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\UserPrearbitration;

use Increase\CardDisputes\CardDisputeSubmitUserSubmissionParams\Visa\UserPrearbitration\CategoryChange\Category;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Category change details for the pre-arbitration request. Should only be populated if the category of the dispute is being changed as part of the pre-arbitration request.
 *
 * @phpstan-type CategoryChangeShape = array{
 *   category: Category|value-of<Category>, reason: string
 * }
 */
final class CategoryChange implements BaseModel
{
    /** @use SdkModel<CategoryChangeShape> */
    use SdkModel;

    /** @var value-of<Category> $category */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * The reason for the category change.
     */
    #[Required]
    public string $reason;

    /**
     * `new CategoryChange()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CategoryChange::with(category: ..., reason: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CategoryChange)->withCategory(...)->withReason(...)
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
    public static function with(Category|string $category, string $reason): self
    {
        $self = new self;

        $self['category'] = $category;
        $self['reason'] = $reason;

        return $self;
    }

    /**
     * @param Category|value-of<Category> $category
     */
    public function withCategory(Category|string $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * The reason for the category change.
     */
    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
