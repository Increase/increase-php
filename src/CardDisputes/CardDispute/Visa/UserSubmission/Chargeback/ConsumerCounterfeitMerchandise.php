<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Counterfeit merchandise. Present if and only if `category` is `consumer_counterfeit_merchandise`.
 *
 * @phpstan-type ConsumerCounterfeitMerchandiseShape = array{
 *   counterfeitExplanation: string,
 *   dispositionExplanation: string,
 *   orderExplanation: string,
 *   receivedAt: string,
 * }
 */
final class ConsumerCounterfeitMerchandise implements BaseModel
{
    /** @use SdkModel<ConsumerCounterfeitMerchandiseShape> */
    use SdkModel;

    /**
     * Counterfeit explanation.
     */
    #[Required('counterfeit_explanation')]
    public string $counterfeitExplanation;

    /**
     * Disposition explanation.
     */
    #[Required('disposition_explanation')]
    public string $dispositionExplanation;

    /**
     * Order explanation.
     */
    #[Required('order_explanation')]
    public string $orderExplanation;

    /**
     * Received at.
     */
    #[Required('received_at')]
    public string $receivedAt;

    /**
     * `new ConsumerCounterfeitMerchandise()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerCounterfeitMerchandise::with(
     *   counterfeitExplanation: ...,
     *   dispositionExplanation: ...,
     *   orderExplanation: ...,
     *   receivedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConsumerCounterfeitMerchandise)
     *   ->withCounterfeitExplanation(...)
     *   ->withDispositionExplanation(...)
     *   ->withOrderExplanation(...)
     *   ->withReceivedAt(...)
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
     */
    public static function with(
        string $counterfeitExplanation,
        string $dispositionExplanation,
        string $orderExplanation,
        string $receivedAt,
    ): self {
        $self = new self;

        $self['counterfeitExplanation'] = $counterfeitExplanation;
        $self['dispositionExplanation'] = $dispositionExplanation;
        $self['orderExplanation'] = $orderExplanation;
        $self['receivedAt'] = $receivedAt;

        return $self;
    }

    /**
     * Counterfeit explanation.
     */
    public function withCounterfeitExplanation(
        string $counterfeitExplanation
    ): self {
        $self = clone $this;
        $self['counterfeitExplanation'] = $counterfeitExplanation;

        return $self;
    }

    /**
     * Disposition explanation.
     */
    public function withDispositionExplanation(
        string $dispositionExplanation
    ): self {
        $self = clone $this;
        $self['dispositionExplanation'] = $dispositionExplanation;

        return $self;
    }

    /**
     * Order explanation.
     */
    public function withOrderExplanation(string $orderExplanation): self
    {
        $self = clone $this;
        $self['orderExplanation'] = $orderExplanation;

        return $self;
    }

    /**
     * Received at.
     */
    public function withReceivedAt(string $receivedAt): self
    {
        $self = clone $this;
        $self['receivedAt'] = $receivedAt;

        return $self;
    }
}
