<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransfer;

use Increase\ACHTransfers\ACHTransfer\Addenda\Category;
use Increase\ACHTransfers\ACHTransfer\Addenda\Freeform;
use Increase\ACHTransfers\ACHTransfer\Addenda\PaymentOrderRemittanceAdvice;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Additional information that will be sent to the recipient.
 *
 * @phpstan-import-type FreeformShape from \Increase\ACHTransfers\ACHTransfer\Addenda\Freeform
 * @phpstan-import-type PaymentOrderRemittanceAdviceShape from \Increase\ACHTransfers\ACHTransfer\Addenda\PaymentOrderRemittanceAdvice
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
     * The type of the resource. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * Unstructured `payment_related_information` passed through with the transfer.
     */
    #[Optional(nullable: true)]
    public ?Freeform $freeform;

    /**
     * Structured ASC X12 820 remittance advice records. Please reach out to [support@increase.com](mailto:support@increase.com) for more information.
     */
    #[Optional('payment_order_remittance_advice', nullable: true)]
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
     * The type of the resource. We may add additional possible values for this enum over time; your application should be able to handle such additions gracefully.
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
     * Unstructured `payment_related_information` passed through with the transfer.
     *
     * @param Freeform|FreeformShape|null $freeform
     */
    public function withFreeform(Freeform|array|null $freeform): self
    {
        $self = clone $this;
        $self['freeform'] = $freeform;

        return $self;
    }

    /**
     * Structured ASC X12 820 remittance advice records. Please reach out to [support@increase.com](mailto:support@increase.com) for more information.
     *
     * @param PaymentOrderRemittanceAdvice|PaymentOrderRemittanceAdviceShape|null $paymentOrderRemittanceAdvice
     */
    public function withPaymentOrderRemittanceAdvice(
        PaymentOrderRemittanceAdvice|array|null $paymentOrderRemittanceAdvice
    ): self {
        $self = clone $this;
        $self['paymentOrderRemittanceAdvice'] = $paymentOrderRemittanceAdvice;

        return $self;
    }
}
