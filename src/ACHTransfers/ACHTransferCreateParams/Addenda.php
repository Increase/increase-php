<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransferCreateParams;

use Increase\ACHTransfers\ACHTransferCreateParams\Addenda\Category;
use Increase\ACHTransfers\ACHTransferCreateParams\Addenda\Freeform;
use Increase\ACHTransfers\ACHTransferCreateParams\Addenda\PaymentOrderRemittanceAdvice;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Additional information that will be sent to the recipient. This is included in the transfer data sent to the receiving bank.
 *
 * @phpstan-import-type FreeformShape from \Increase\ACHTransfers\ACHTransferCreateParams\Addenda\Freeform
 * @phpstan-import-type PaymentOrderRemittanceAdviceShape from \Increase\ACHTransfers\ACHTransferCreateParams\Addenda\PaymentOrderRemittanceAdvice
 *
 * @phpstan-type AddendaShape = array{
 *   category: Category|value-of<Category>,
 *   freeform?: null|Freeform|FreeformShape,
 *   paymentOrderRemittanceAdvice?: null|PaymentOrderRemittanceAdvice|PaymentOrderRemittanceAdviceShape,
 * }
 */
final class Addenda implements BaseModel
{
    /** @use SdkModel<AddendaShape> */
    use SdkModel;

    /**
     * The type of addenda to pass with the transfer.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * Unstructured `payment_related_information` passed through with the transfer. Required if and only if `category` is `freeform`.
     */
    #[Optional]
    public ?Freeform $freeform;

    /**
     * Structured ASC X12 820 remittance advice records. Please reach out to [support@increase.com](mailto:support@increase.com) for more information. Required if and only if `category` is `payment_order_remittance_advice`.
     */
    #[Optional('payment_order_remittance_advice')]
    public ?PaymentOrderRemittanceAdvice $paymentOrderRemittanceAdvice;

    /**
     * `new Addenda()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Addenda::with(category: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Addenda)->withCategory(...)
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
     * @param Freeform|FreeformShape|null $freeform
     * @param PaymentOrderRemittanceAdvice|PaymentOrderRemittanceAdviceShape|null $paymentOrderRemittanceAdvice
     */
    public static function with(
        Category|string $category,
        Freeform|array|null $freeform = null,
        PaymentOrderRemittanceAdvice|array|null $paymentOrderRemittanceAdvice = null,
    ): self {
        $self = new self;

        $self['category'] = $category;

        null !== $freeform && $self['freeform'] = $freeform;
        null !== $paymentOrderRemittanceAdvice && $self['paymentOrderRemittanceAdvice'] = $paymentOrderRemittanceAdvice;

        return $self;
    }

    /**
     * The type of addenda to pass with the transfer.
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
     * Unstructured `payment_related_information` passed through with the transfer. Required if and only if `category` is `freeform`.
     *
     * @param Freeform|FreeformShape $freeform
     */
    public function withFreeform(Freeform|array $freeform): self
    {
        $self = clone $this;
        $self['freeform'] = $freeform;

        return $self;
    }

    /**
     * Structured ASC X12 820 remittance advice records. Please reach out to [support@increase.com](mailto:support@increase.com) for more information. Required if and only if `category` is `payment_order_remittance_advice`.
     *
     * @param PaymentOrderRemittanceAdvice|PaymentOrderRemittanceAdviceShape $paymentOrderRemittanceAdvice
     */
    public function withPaymentOrderRemittanceAdvice(
        PaymentOrderRemittanceAdvice|array $paymentOrderRemittanceAdvice
    ): self {
        $self = clone $this;
        $self['paymentOrderRemittanceAdvice'] = $paymentOrderRemittanceAdvice;

        return $self;
    }
}
