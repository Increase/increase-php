<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization\Approval;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization\Decision;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization\Decline;

/**
 * If the Real-Time Decision relates to a card authorization attempt, this object contains your response to the authorization.
 *
 * @phpstan-import-type ApprovalShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization\Approval
 * @phpstan-import-type DeclineShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\CardAuthorization\Decline
 *
 * @phpstan-type CardAuthorizationShape = array{
 *   decision: Decision|value-of<Decision>,
 *   approval?: null|Approval|ApprovalShape,
 *   decline?: null|Decline|DeclineShape,
 * }
 */
final class CardAuthorization implements BaseModel
{
    /** @use SdkModel<CardAuthorizationShape> */
    use SdkModel;

    /**
     * Whether the card authorization should be approved or declined.
     *
     * @var value-of<Decision> $decision
     */
    #[Required(enum: Decision::class)]
    public string $decision;

    /**
     * If your application approves the authorization, this contains metadata about your decision to approve. Your response here is advisory to the acquiring bank. The bank may choose to reverse the authorization if you approve the transaction but indicate the address does not match.
     */
    #[Optional]
    public ?Approval $approval;

    /**
     * If your application declines the authorization, this contains details about the decline.
     */
    #[Optional]
    public ?Decline $decline;

    /**
     * `new CardAuthorization()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardAuthorization::with(decision: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardAuthorization)->withDecision(...)
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
     * @param Decline|DeclineShape|null $decline
     */
    public static function with(
        Decision|string $decision,
        Approval|array|null $approval = null,
        Decline|array|null $decline = null,
    ): self {
        $self = new self;

        $self['decision'] = $decision;

        null !== $approval && $self['approval'] = $approval;
        null !== $decline && $self['decline'] = $decline;

        return $self;
    }

    /**
     * Whether the card authorization should be approved or declined.
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
     * If your application approves the authorization, this contains metadata about your decision to approve. Your response here is advisory to the acquiring bank. The bank may choose to reverse the authorization if you approve the transaction but indicate the address does not match.
     *
     * @param Approval|ApprovalShape $approval
     */
    public function withApproval(Approval|array $approval): self
    {
        $self = clone $this;
        $self['approval'] = $approval;

        return $self;
    }

    /**
     * If your application declines the authorization, this contains details about the decline.
     *
     * @param Decline|DeclineShape $decline
     */
    public function withDecline(Decline|array $decline): self
    {
        $self = clone $this;
        $self['decline'] = $decline;

        return $self;
    }
}
