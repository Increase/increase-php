<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecisionActionParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletToken\Approval;
use Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletToken\Decline;

/**
 * If the Real-Time Decision relates to a digital wallet token provisioning attempt, this object contains your response to the attempt.
 *
 * @phpstan-import-type ApprovalShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletToken\Approval
 * @phpstan-import-type DeclineShape from \Increase\RealTimeDecisions\RealTimeDecisionActionParams\DigitalWalletToken\Decline
 *
 * @phpstan-type DigitalWalletTokenShape = array{
 *   approval?: null|Approval|ApprovalShape, decline?: null|Decline|DeclineShape
 * }
 */
final class DigitalWalletToken implements BaseModel
{
    /** @use SdkModel<DigitalWalletTokenShape> */
    use SdkModel;

    /**
     * If your application approves the provisioning attempt, this contains metadata about the digital wallet token that will be generated.
     */
    #[Optional]
    public ?Approval $approval;

    /**
     * If your application declines the provisioning attempt, this contains details about the decline.
     */
    #[Optional]
    public ?Decline $decline;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Approval|ApprovalShape|null $approval
     * @param Decline|DeclineShape|null $decline
     */
    public static function with(
        Approval|array|null $approval = null,
        Decline|array|null $decline = null
    ): self {
        $self = new self;

        null !== $approval && $self['approval'] = $approval;
        null !== $decline && $self['decline'] = $decline;

        return $self;
    }

    /**
     * If your application approves the provisioning attempt, this contains metadata about the digital wallet token that will be generated.
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
     * If your application declines the provisioning attempt, this contains details about the decline.
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
