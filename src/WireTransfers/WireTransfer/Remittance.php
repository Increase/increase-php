<?php

declare(strict_types=1);

namespace Increase\WireTransfers\WireTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\WireTransfers\WireTransfer\Remittance\Category;
use Increase\WireTransfers\WireTransfer\Remittance\Tax;
use Increase\WireTransfers\WireTransfer\Remittance\Unstructured;

/**
 * Remittance information sent with the wire transfer.
 *
 * @phpstan-import-type TaxShape from \Increase\WireTransfers\WireTransfer\Remittance\Tax
 * @phpstan-import-type UnstructuredShape from \Increase\WireTransfers\WireTransfer\Remittance\Unstructured
 *
 * @phpstan-type RemittanceShape = array{
 *   category: Category|value-of<Category>,
 *   tax: null|Tax|TaxShape,
 *   unstructured: null|Unstructured|UnstructuredShape,
 * }
 */
final class Remittance implements BaseModel
{
    /** @use SdkModel<RemittanceShape> */
    use SdkModel;

    /**
     * The type of remittance information being passed.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * Internal Revenue Service (IRS) tax repayment information. Required if `category` is equal to `tax`.
     */
    #[Required]
    public ?Tax $tax;

    /**
     * Unstructured remittance information. Required if `category` is equal to `unstructured`.
     */
    #[Required]
    public ?Unstructured $unstructured;

    /**
     * `new Remittance()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Remittance::with(category: ..., tax: ..., unstructured: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Remittance)->withCategory(...)->withTax(...)->withUnstructured(...)
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
     * @param Tax|TaxShape|null $tax
     * @param Unstructured|UnstructuredShape|null $unstructured
     */
    public static function with(
        Category|string $category,
        Tax|array|null $tax,
        Unstructured|array|null $unstructured,
    ): self {
        $self = new self;

        $self['category'] = $category;
        $self['tax'] = $tax;
        $self['unstructured'] = $unstructured;

        return $self;
    }

    /**
     * The type of remittance information being passed.
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
     * Internal Revenue Service (IRS) tax repayment information. Required if `category` is equal to `tax`.
     *
     * @param Tax|TaxShape|null $tax
     */
    public function withTax(Tax|array|null $tax): self
    {
        $self = clone $this;
        $self['tax'] = $tax;

        return $self;
    }

    /**
     * Unstructured remittance information. Required if `category` is equal to `unstructured`.
     *
     * @param Unstructured|UnstructuredShape|null $unstructured
     */
    public function withUnstructured(
        Unstructured|array|null $unstructured
    ): self {
        $self = clone $this;
        $self['unstructured'] = $unstructured;

        return $self;
    }
}
