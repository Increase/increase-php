<?php

declare(strict_types=1);

namespace Increase\Simulations\CardDisputes\CardDisputeActionParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\AcceptChargeback;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\AcceptUserSubmission;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\Action;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\DeclineUserPrearbitration;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\ReceiveMerchantPrearbitration;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\Represent;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\RequestFurtherInformation;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\TimeOutChargeback;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\TimeOutMerchantPrearbitration;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\TimeOutRepresentment;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\TimeOutUserPrearbitration;

/**
 * The Visa-specific parameters for the taking action on the dispute. Required if and only if `network` is `visa`.
 *
 * @phpstan-import-type AcceptChargebackShape from \Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\AcceptChargeback
 * @phpstan-import-type AcceptUserSubmissionShape from \Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\AcceptUserSubmission
 * @phpstan-import-type DeclineUserPrearbitrationShape from \Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\DeclineUserPrearbitration
 * @phpstan-import-type ReceiveMerchantPrearbitrationShape from \Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\ReceiveMerchantPrearbitration
 * @phpstan-import-type RepresentShape from \Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\Represent
 * @phpstan-import-type RequestFurtherInformationShape from \Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\RequestFurtherInformation
 * @phpstan-import-type TimeOutChargebackShape from \Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\TimeOutChargeback
 * @phpstan-import-type TimeOutMerchantPrearbitrationShape from \Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\TimeOutMerchantPrearbitration
 * @phpstan-import-type TimeOutRepresentmentShape from \Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\TimeOutRepresentment
 * @phpstan-import-type TimeOutUserPrearbitrationShape from \Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa\TimeOutUserPrearbitration
 *
 * @phpstan-type VisaShape = array{
 *   action: Action|value-of<Action>,
 *   acceptChargeback?: null|AcceptChargeback|AcceptChargebackShape,
 *   acceptUserSubmission?: null|AcceptUserSubmission|AcceptUserSubmissionShape,
 *   declineUserPrearbitration?: null|DeclineUserPrearbitration|DeclineUserPrearbitrationShape,
 *   receiveMerchantPrearbitration?: null|ReceiveMerchantPrearbitration|ReceiveMerchantPrearbitrationShape,
 *   represent?: null|Represent|RepresentShape,
 *   requestFurtherInformation?: null|RequestFurtherInformation|RequestFurtherInformationShape,
 *   timeOutChargeback?: null|TimeOutChargeback|TimeOutChargebackShape,
 *   timeOutMerchantPrearbitration?: null|TimeOutMerchantPrearbitration|TimeOutMerchantPrearbitrationShape,
 *   timeOutRepresentment?: null|TimeOutRepresentment|TimeOutRepresentmentShape,
 *   timeOutUserPrearbitration?: null|TimeOutUserPrearbitration|TimeOutUserPrearbitrationShape,
 * }
 */
final class Visa implements BaseModel
{
    /** @use SdkModel<VisaShape> */
    use SdkModel;

    /**
     * The action to take. Details specific to the action are required under the sub-object with the same identifier as the action.
     *
     * @var value-of<Action> $action
     */
    #[Required(enum: Action::class)]
    public string $action;

    /**
     * The parameters for accepting the chargeback. Required if and only if `action` is `accept_chargeback`.
     */
    #[Optional('accept_chargeback')]
    public ?AcceptChargeback $acceptChargeback;

    /**
     * The parameters for accepting the user submission. Required if and only if `action` is `accept_user_submission`.
     */
    #[Optional('accept_user_submission')]
    public ?AcceptUserSubmission $acceptUserSubmission;

    /**
     * The parameters for declining the prearbitration. Required if and only if `action` is `decline_user_prearbitration`.
     */
    #[Optional('decline_user_prearbitration')]
    public ?DeclineUserPrearbitration $declineUserPrearbitration;

    /**
     * The parameters for receiving the prearbitration. Required if and only if `action` is `receive_merchant_prearbitration`.
     */
    #[Optional('receive_merchant_prearbitration')]
    public ?ReceiveMerchantPrearbitration $receiveMerchantPrearbitration;

    /**
     * The parameters for re-presenting the dispute. Required if and only if `action` is `represent`.
     */
    #[Optional]
    public ?Represent $represent;

    /**
     * The parameters for requesting further information from the user. Required if and only if `action` is `request_further_information`.
     */
    #[Optional('request_further_information')]
    public ?RequestFurtherInformation $requestFurtherInformation;

    /**
     * The parameters for timing out the chargeback. Required if and only if `action` is `time_out_chargeback`.
     */
    #[Optional('time_out_chargeback')]
    public ?TimeOutChargeback $timeOutChargeback;

    /**
     * The parameters for timing out the merchant prearbitration. Required if and only if `action` is `time_out_merchant_prearbitration`.
     */
    #[Optional('time_out_merchant_prearbitration')]
    public ?TimeOutMerchantPrearbitration $timeOutMerchantPrearbitration;

    /**
     * The parameters for timing out the re-presentment. Required if and only if `action` is `time_out_representment`.
     */
    #[Optional('time_out_representment')]
    public ?TimeOutRepresentment $timeOutRepresentment;

    /**
     * The parameters for timing out the user prearbitration. Required if and only if `action` is `time_out_user_prearbitration`.
     */
    #[Optional('time_out_user_prearbitration')]
    public ?TimeOutUserPrearbitration $timeOutUserPrearbitration;

    /**
     * `new Visa()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Visa::with(action: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Visa)->withAction(...)
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
     * @param Action|value-of<Action> $action
     * @param AcceptChargeback|AcceptChargebackShape|null $acceptChargeback
     * @param AcceptUserSubmission|AcceptUserSubmissionShape|null $acceptUserSubmission
     * @param DeclineUserPrearbitration|DeclineUserPrearbitrationShape|null $declineUserPrearbitration
     * @param ReceiveMerchantPrearbitration|ReceiveMerchantPrearbitrationShape|null $receiveMerchantPrearbitration
     * @param Represent|RepresentShape|null $represent
     * @param RequestFurtherInformation|RequestFurtherInformationShape|null $requestFurtherInformation
     * @param TimeOutChargeback|TimeOutChargebackShape|null $timeOutChargeback
     * @param TimeOutMerchantPrearbitration|TimeOutMerchantPrearbitrationShape|null $timeOutMerchantPrearbitration
     * @param TimeOutRepresentment|TimeOutRepresentmentShape|null $timeOutRepresentment
     * @param TimeOutUserPrearbitration|TimeOutUserPrearbitrationShape|null $timeOutUserPrearbitration
     */
    public static function with(
        Action|string $action,
        AcceptChargeback|array|null $acceptChargeback = null,
        AcceptUserSubmission|array|null $acceptUserSubmission = null,
        DeclineUserPrearbitration|array|null $declineUserPrearbitration = null,
        ReceiveMerchantPrearbitration|array|null $receiveMerchantPrearbitration = null,
        Represent|array|null $represent = null,
        RequestFurtherInformation|array|null $requestFurtherInformation = null,
        TimeOutChargeback|array|null $timeOutChargeback = null,
        TimeOutMerchantPrearbitration|array|null $timeOutMerchantPrearbitration = null,
        TimeOutRepresentment|array|null $timeOutRepresentment = null,
        TimeOutUserPrearbitration|array|null $timeOutUserPrearbitration = null,
    ): self {
        $self = new self;

        $self['action'] = $action;

        null !== $acceptChargeback && $self['acceptChargeback'] = $acceptChargeback;
        null !== $acceptUserSubmission && $self['acceptUserSubmission'] = $acceptUserSubmission;
        null !== $declineUserPrearbitration && $self['declineUserPrearbitration'] = $declineUserPrearbitration;
        null !== $receiveMerchantPrearbitration && $self['receiveMerchantPrearbitration'] = $receiveMerchantPrearbitration;
        null !== $represent && $self['represent'] = $represent;
        null !== $requestFurtherInformation && $self['requestFurtherInformation'] = $requestFurtherInformation;
        null !== $timeOutChargeback && $self['timeOutChargeback'] = $timeOutChargeback;
        null !== $timeOutMerchantPrearbitration && $self['timeOutMerchantPrearbitration'] = $timeOutMerchantPrearbitration;
        null !== $timeOutRepresentment && $self['timeOutRepresentment'] = $timeOutRepresentment;
        null !== $timeOutUserPrearbitration && $self['timeOutUserPrearbitration'] = $timeOutUserPrearbitration;

        return $self;
    }

    /**
     * The action to take. Details specific to the action are required under the sub-object with the same identifier as the action.
     *
     * @param Action|value-of<Action> $action
     */
    public function withAction(Action|string $action): self
    {
        $self = clone $this;
        $self['action'] = $action;

        return $self;
    }

    /**
     * The parameters for accepting the chargeback. Required if and only if `action` is `accept_chargeback`.
     *
     * @param AcceptChargeback|AcceptChargebackShape $acceptChargeback
     */
    public function withAcceptChargeback(
        AcceptChargeback|array $acceptChargeback
    ): self {
        $self = clone $this;
        $self['acceptChargeback'] = $acceptChargeback;

        return $self;
    }

    /**
     * The parameters for accepting the user submission. Required if and only if `action` is `accept_user_submission`.
     *
     * @param AcceptUserSubmission|AcceptUserSubmissionShape $acceptUserSubmission
     */
    public function withAcceptUserSubmission(
        AcceptUserSubmission|array $acceptUserSubmission
    ): self {
        $self = clone $this;
        $self['acceptUserSubmission'] = $acceptUserSubmission;

        return $self;
    }

    /**
     * The parameters for declining the prearbitration. Required if and only if `action` is `decline_user_prearbitration`.
     *
     * @param DeclineUserPrearbitration|DeclineUserPrearbitrationShape $declineUserPrearbitration
     */
    public function withDeclineUserPrearbitration(
        DeclineUserPrearbitration|array $declineUserPrearbitration
    ): self {
        $self = clone $this;
        $self['declineUserPrearbitration'] = $declineUserPrearbitration;

        return $self;
    }

    /**
     * The parameters for receiving the prearbitration. Required if and only if `action` is `receive_merchant_prearbitration`.
     *
     * @param ReceiveMerchantPrearbitration|ReceiveMerchantPrearbitrationShape $receiveMerchantPrearbitration
     */
    public function withReceiveMerchantPrearbitration(
        ReceiveMerchantPrearbitration|array $receiveMerchantPrearbitration
    ): self {
        $self = clone $this;
        $self['receiveMerchantPrearbitration'] = $receiveMerchantPrearbitration;

        return $self;
    }

    /**
     * The parameters for re-presenting the dispute. Required if and only if `action` is `represent`.
     *
     * @param Represent|RepresentShape $represent
     */
    public function withRepresent(Represent|array $represent): self
    {
        $self = clone $this;
        $self['represent'] = $represent;

        return $self;
    }

    /**
     * The parameters for requesting further information from the user. Required if and only if `action` is `request_further_information`.
     *
     * @param RequestFurtherInformation|RequestFurtherInformationShape $requestFurtherInformation
     */
    public function withRequestFurtherInformation(
        RequestFurtherInformation|array $requestFurtherInformation
    ): self {
        $self = clone $this;
        $self['requestFurtherInformation'] = $requestFurtherInformation;

        return $self;
    }

    /**
     * The parameters for timing out the chargeback. Required if and only if `action` is `time_out_chargeback`.
     *
     * @param TimeOutChargeback|TimeOutChargebackShape $timeOutChargeback
     */
    public function withTimeOutChargeback(
        TimeOutChargeback|array $timeOutChargeback
    ): self {
        $self = clone $this;
        $self['timeOutChargeback'] = $timeOutChargeback;

        return $self;
    }

    /**
     * The parameters for timing out the merchant prearbitration. Required if and only if `action` is `time_out_merchant_prearbitration`.
     *
     * @param TimeOutMerchantPrearbitration|TimeOutMerchantPrearbitrationShape $timeOutMerchantPrearbitration
     */
    public function withTimeOutMerchantPrearbitration(
        TimeOutMerchantPrearbitration|array $timeOutMerchantPrearbitration
    ): self {
        $self = clone $this;
        $self['timeOutMerchantPrearbitration'] = $timeOutMerchantPrearbitration;

        return $self;
    }

    /**
     * The parameters for timing out the re-presentment. Required if and only if `action` is `time_out_representment`.
     *
     * @param TimeOutRepresentment|TimeOutRepresentmentShape $timeOutRepresentment
     */
    public function withTimeOutRepresentment(
        TimeOutRepresentment|array $timeOutRepresentment
    ): self {
        $self = clone $this;
        $self['timeOutRepresentment'] = $timeOutRepresentment;

        return $self;
    }

    /**
     * The parameters for timing out the user prearbitration. Required if and only if `action` is `time_out_user_prearbitration`.
     *
     * @param TimeOutUserPrearbitration|TimeOutUserPrearbitrationShape $timeOutUserPrearbitration
     */
    public function withTimeOutUserPrearbitration(
        TimeOutUserPrearbitration|array $timeOutUserPrearbitration
    ): self {
        $self = clone $this;
        $self['timeOutUserPrearbitration'] = $timeOutUserPrearbitration;

        return $self;
    }
}
