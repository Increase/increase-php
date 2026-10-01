<?php

declare(strict_types=1);

namespace Increase\RealTimePaymentsRequestsForPayment\RealTimePaymentsRequestForPayment;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * After the request for payment is submitted to Real-Time Payments, this will contain supplemental details.
 *
 * @phpstan-type SubmissionShape = array{paymentInformationIdentification: string}
 */
final class Submission implements BaseModel
{
    /** @use SdkModel<SubmissionShape> */
    use SdkModel;

    /**
     * The Real-Time Payments payment information identification of the request.
     */
    #[Required('payment_information_identification')]
    public string $paymentInformationIdentification;

    /**
     * `new Submission()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Submission::with(paymentInformationIdentification: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Submission)->withPaymentInformationIdentification(...)
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
    public static function with(string $paymentInformationIdentification): self
    {
        $self = new self;

        $self['paymentInformationIdentification'] = $paymentInformationIdentification;

        return $self;
    }

    /**
     * The Real-Time Payments payment information identification of the request.
     */
    public function withPaymentInformationIdentification(
        string $paymentInformationIdentification
    ): self {
        $self = clone $this;
        $self['paymentInformationIdentification'] = $paymentInformationIdentification;

        return $self;
    }
}
