<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardRefund\PurchaseDetails\Travel\Ancillary;

use Increase\CardPayments\CardPayment\Element\CardRefund\PurchaseDetails\Travel\Ancillary\Service\Category;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type ServiceShape = array{
 *   category: null|Category|value-of<Category>, subCategory: string|null
 * }
 */
final class Service implements BaseModel
{
    /** @use SdkModel<ServiceShape> */
    use SdkModel;

    /**
     * Category of the ancillary service.
     *
     * @var value-of<Category>|null $category
     */
    #[Required(enum: Category::class)]
    public ?string $category;

    /**
     * Sub-category of the ancillary service, free-form.
     */
    #[Required('sub_category')]
    public ?string $subCategory;

    /**
     * `new Service()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Service::with(category: ..., subCategory: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Service)->withCategory(...)->withSubCategory(...)
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
     * @param Category|value-of<Category>|null $category
     */
    public static function with(
        Category|string|null $category,
        ?string $subCategory
    ): self {
        $self = new self;

        $self['category'] = $category;
        $self['subCategory'] = $subCategory;

        return $self;
    }

    /**
     * Category of the ancillary service.
     *
     * @param Category|value-of<Category>|null $category
     */
    public function withCategory(Category|string|null $category): self
    {
        $self = clone $this;
        $self['category'] = $category;

        return $self;
    }

    /**
     * Sub-category of the ancillary service, free-form.
     */
    public function withSubCategory(?string $subCategory): self
    {
        $self = clone $this;
        $self['subCategory'] = $subCategory;

        return $self;
    }
}
