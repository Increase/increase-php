<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardBalanceInquiry\Approval;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardBalanceInquiry\Decision;

/**
 * If the Real-Time Decision relates to a card balance inquiry attempt, this object contains your response to the inquiry.
 *
 * @phpstan-import-type ApprovalShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardBalanceInquiry\Approval
 *
 * @phpstan-type CardBalanceInquiryShape = array{
 *   decision: Decision|value-of<Decision>, approval?: null|Approval|ApprovalShape
 * }
 */
final class CardBalanceInquiry implements BaseModel
{
    /** @use SdkModel<CardBalanceInquiryShape> */
    use SdkModel;

    /**
     * Whether the card balance inquiry should be approved or declined.
     *
     * @var value-of<Decision> $decision
     */
    #[Required(enum: Decision::class)]
    public string $decision;

    /**
     * If your application approves the balance inquiry, this contains metadata about your decision to approve.
     */
    #[Optional]
    public ?Approval $approval;

    /**
     * `new CardBalanceInquiry()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardBalanceInquiry::with(decision: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardBalanceInquiry)->withDecision(...)
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
     * @param Decision|value-of<Decision> $decision
     * @param Approval|ApprovalShape|null $approval
     */
    public static function with(
        Decision|string $decision,
        Approval|array|null $approval = null
    ): self {
        $self = new self;

        $self['decision'] = $decision;

        null !== $approval && $self['approval'] = $approval;

        return $self;
    }

    /**
     * Whether the card balance inquiry should be approved or declined.
     *
     * @param Decision|value-of<Decision> $decision
     */
    public function withDecision(Decision|string $decision): self
    {
        $self = clone $this;
        $self['decision'] = $decision;

        return $self;
    }

    /**
     * If your application approves the balance inquiry, this contains metadata about your decision to approve.
     *
     * @param Approval|ApprovalShape $approval
     */
    public function withApproval(Approval|array $approval): self
    {
        $self = clone $this;
        $self['approval'] = $approval;

        return $self;
    }
}
