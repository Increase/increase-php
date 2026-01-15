<?php

declare(strict_types=1);

namespace Increase\WireTransfers\WireTransferCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\WireTransfers\WireTransferCreateParams\Remittance\Category;
use Increase\WireTransfers\WireTransferCreateParams\Remittance\Tax;
use Increase\WireTransfers\WireTransferCreateParams\Remittance\Unstructured;

/**
 * Additional remittance information related to the wire transfer.
 *
 * @phpstan-import-type TaxShape from \Increase\WireTransfers\WireTransferCreateParams\Remittance\Tax
 * @phpstan-import-type UnstructuredShape from \Increase\WireTransfers\WireTransferCreateParams\Remittance\Unstructured
 *
 * @phpstan-type RemittanceShape = array{
 *   category: Category|value-of<Category>,
 *   tax?: null|Tax|TaxShape,
 *   unstructured?: null|Unstructured|UnstructuredShape,
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
    #[Optional]
    public ?Tax $tax;

    /**
     * Unstructured remittance information. Required if `category` is equal to `unstructured`.
     */
    #[Optional]
    public ?Unstructured $unstructured;

    /**
     * `new Remittance()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Remittance::with(category: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Remittance)->withCategory(...)
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
        Tax|array|null $tax = null,
        Unstructured|array|null $unstructured = null,
    ): self {
        $self = new self;

        $self['category'] = $category;

        null !== $tax && $self['tax'] = $tax;
        null !== $unstructured && $self['unstructured'] = $unstructured;

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
     * @param Tax|TaxShape $tax
     */
    public function withTax(Tax|array $tax): self
    {
        $self = clone $this;
        $self['tax'] = $tax;

        return $self;
    }

    /**
     * Unstructured remittance information. Required if `category` is equal to `unstructured`.
     *
     * @param Unstructured|UnstructuredShape $unstructured
     */
    public function withUnstructured(Unstructured|array $unstructured): self
    {
        $self = clone $this;
        $self['unstructured'] = $unstructured;

        return $self;
    }
}
