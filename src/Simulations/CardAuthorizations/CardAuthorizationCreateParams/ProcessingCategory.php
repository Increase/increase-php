<?php

declare(strict_types=1);

namespace Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams\ProcessingCategory\Category;
use Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams\ProcessingCategory\Refund;

/**
 * Fields specific to a specific type of authorization, such as Automatic Fuel Dispensers, Refund Authorizations, or Cash Disbursements.
 *
 * @phpstan-import-type RefundShape from \Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams\ProcessingCategory\Refund
 *
 * @phpstan-type ProcessingCategoryShape = array{
 *   category: Category|value-of<Category>, refund?: null|Refund|RefundShape
 * }
 */
final class ProcessingCategory implements BaseModel
{
    /** @use SdkModel<ProcessingCategoryShape> */
    use SdkModel;

    /**
     * The processing category describes the intent behind the authorization, such as whether it was used for bill payments or an automatic fuel dispenser.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * Details related to refund authorizations.
     */
    #[Optional]
    public ?Refund $refund;

    /**
     * `new ProcessingCategory()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ProcessingCategory::with(category: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ProcessingCategory)->withCategory(...)
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
     * @param Refund|RefundShape|null $refund
     */
    public static function with(
        Category|string $category,
        Refund|array|null $refund = null
    ): self {
        $self = new self;

        $self['category'] = $category;

        null !== $refund && $self['refund'] = $refund;

        return $self;
    }

    /**
     * The processing category describes the intent behind the authorization, such as whether it was used for bill payments or an automatic fuel dispenser.
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
     * Details related to refund authorizations.
     *
     * @param Refund|RefundShape $refund
     */
    public function withRefund(Refund|array $refund): self
    {
        $self = clone $this;
        $self['refund'] = $refund;

        return $self;
    }
}
