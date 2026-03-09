<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\MessageCategory\Category;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\MessageCategory\NonPayment;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\MessageCategory\Payment;

/**
 * The message category of the card authentication attempt.
 *
 * @phpstan-import-type NonPaymentShape from \Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\MessageCategory\NonPayment
 * @phpstan-import-type PaymentShape from \Increase\RealTimeDecisions\RealTimeDecision\CardAuthentication\MessageCategory\Payment
 *
 * @phpstan-type MessageCategoryShape = array{
 *   category: Category|value-of<Category>,
 *   nonPayment: null|NonPayment|NonPaymentShape,
 *   payment: null|Payment|PaymentShape,
 * }
 */
final class MessageCategory implements BaseModel
{
    /** @use SdkModel<MessageCategoryShape> */
    use SdkModel;

    /**
     * The category of the card authentication attempt.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * Fields specific to non-payment authentication attempts.
     */
    #[Required('non_payment')]
    public ?NonPayment $nonPayment;

    /**
     * Fields specific to payment authentication attempts.
     */
    #[Required]
    public ?Payment $payment;

    /**
     * `new MessageCategory()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MessageCategory::with(category: ..., nonPayment: ..., payment: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MessageCategory)->withCategory(...)->withNonPayment(...)->withPayment(...)
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
     * @param NonPayment|NonPaymentShape|null $nonPayment
     * @param Payment|PaymentShape|null $payment
     */
    public static function with(
        Category|string $category,
        NonPayment|array|null $nonPayment,
        Payment|array|null $payment,
    ): self {
        $self = new self;

        $self['category'] = $category;
        $self['nonPayment'] = $nonPayment;
        $self['payment'] = $payment;

        return $self;
    }

    /**
     * The category of the card authentication attempt.
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
     * Fields specific to non-payment authentication attempts.
     *
     * @param NonPayment|NonPaymentShape|null $nonPayment
     */
    public function withNonPayment(NonPayment|array|null $nonPayment): self
    {
        $self = clone $this;
        $self['nonPayment'] = $nonPayment;

        return $self;
    }

    /**
     * Fields specific to payment authentication attempts.
     *
     * @param Payment|PaymentShape|null $payment
     */
    public function withPayment(Payment|array|null $payment): self
    {
        $self = clone $this;
        $self['payment'] = $payment;

        return $self;
    }
}
