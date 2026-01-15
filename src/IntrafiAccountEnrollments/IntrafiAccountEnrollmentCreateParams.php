<?php

declare(strict_types=1);

namespace Increase\IntrafiAccountEnrollments;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Enroll an account in the IntraFi deposit sweep network.
 *
 * @see Increase\Services\IntrafiAccountEnrollmentsService::create()
 *
 * @phpstan-type IntrafiAccountEnrollmentCreateParamsShape = array{
 *   accountID: string, emailAddress: string
 * }
 */
final class IntrafiAccountEnrollmentCreateParams implements BaseModel
{
    /** @use SdkModel<IntrafiAccountEnrollmentCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier for the account to be added to IntraFi.
     */
    #[Required('account_id')]
    public string $accountID;

    /**
     * The contact email for the account owner, to be shared with IntraFi.
     */
    #[Required('email_address')]
    public string $emailAddress;

    /**
     * `new IntrafiAccountEnrollmentCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * IntrafiAccountEnrollmentCreateParams::with(accountID: ..., emailAddress: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new IntrafiAccountEnrollmentCreateParams)
     *   ->withAccountID(...)
     *   ->withEmailAddress(...)
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
    public static function with(string $accountID, string $emailAddress): self
    {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['emailAddress'] = $emailAddress;

        return $self;
    }

    /**
     * The identifier for the account to be added to IntraFi.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * The contact email for the account owner, to be shared with IntraFi.
     */
    public function withEmailAddress(string $emailAddress): self
    {
        $self = clone $this;
        $self['emailAddress'] = $emailAddress;

        return $self;
    }
}
