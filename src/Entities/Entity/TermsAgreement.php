<?php

declare(strict_types=1);

namespace Increase\Entities\Entity;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type TermsAgreementShape = array{
 *   agreedAt: \DateTimeInterface, ipAddress: string, termsURL: string
 * }
 */
final class TermsAgreement implements BaseModel
{
    /** @use SdkModel<TermsAgreementShape> */
    use SdkModel;

    /**
     * The timestamp of when the Entity agreed to the terms.
     */
    #[Required('agreed_at')]
    public \DateTimeInterface $agreedAt;

    /**
     * The IP address the Entity accessed reviewed the terms from.
     */
    #[Required('ip_address')]
    public string $ipAddress;

    /**
     * The URL of the terms agreement. This link will be provided by your bank partner.
     */
    #[Required('terms_url')]
    public string $termsURL;

    /**
     * `new TermsAgreement()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TermsAgreement::with(agreedAt: ..., ipAddress: ..., termsURL: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TermsAgreement)->withAgreedAt(...)->withIPAddress(...)->withTermsURL(...)
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
        \DateTimeInterface $agreedAt,
        string $ipAddress,
        string $termsURL
    ): self {
        $self = new self;

        $self['agreedAt'] = $agreedAt;
        $self['ipAddress'] = $ipAddress;
        $self['termsURL'] = $termsURL;

        return $self;
    }

    /**
     * The timestamp of when the Entity agreed to the terms.
     */
    public function withAgreedAt(\DateTimeInterface $agreedAt): self
    {
        $self = clone $this;
        $self['agreedAt'] = $agreedAt;

        return $self;
    }

    /**
     * The IP address the Entity accessed reviewed the terms from.
     */
    public function withIPAddress(string $ipAddress): self
    {
        $self = clone $this;
        $self['ipAddress'] = $ipAddress;

        return $self;
    }

    /**
     * The URL of the terms agreement. This link will be provided by your bank partner.
     */
    public function withTermsURL(string $termsURL): self
    {
        $self = clone $this;
        $self['termsURL'] = $termsURL;

        return $self;
    }
}
