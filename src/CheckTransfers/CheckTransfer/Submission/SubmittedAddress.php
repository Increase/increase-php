<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer\Submission;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The address we submitted to the printer. This is what is physically printed on the check.
 *
 * @phpstan-type SubmittedAddressShape = array{
 *   city: string,
 *   line1: string,
 *   line2: string|null,
 *   recipientName: string,
 *   state: string,
 *   zip: string,
 * }
 */
final class SubmittedAddress implements BaseModel
{
    /** @use SdkModel<SubmittedAddressShape> */
    use SdkModel;

    /**
     * The submitted address city.
     */
    #[Required]
    public string $city;

    /**
     * The submitted address line 1.
     */
    #[Required]
    public string $line1;

    /**
     * The submitted address line 2.
     */
    #[Required]
    public ?string $line2;

    /**
     * The submitted recipient name.
     */
    #[Required('recipient_name')]
    public string $recipientName;

    /**
     * The submitted address state.
     */
    #[Required]
    public string $state;

    /**
     * The submitted address zip.
     */
    #[Required]
    public string $zip;

    /**
     * `new SubmittedAddress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubmittedAddress::with(
     *   city: ..., line1: ..., line2: ..., recipientName: ..., state: ..., zip: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubmittedAddress)
     *   ->withCity(...)
     *   ->withLine1(...)
     *   ->withLine2(...)
     *   ->withRecipientName(...)
     *   ->withState(...)
     *   ->withZip(...)
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
        string $city,
        string $line1,
        ?string $line2,
        string $recipientName,
        string $state,
        string $zip,
    ): self {
        $self = new self;

        $self['city'] = $city;
        $self['line1'] = $line1;
        $self['line2'] = $line2;
        $self['recipientName'] = $recipientName;
        $self['state'] = $state;
        $self['zip'] = $zip;

        return $self;
    }

    /**
     * The submitted address city.
     */
    public function withCity(string $city): self
    {
        $self = clone $this;
        $self['city'] = $city;

        return $self;
    }

    /**
     * The submitted address line 1.
     */
    public function withLine1(string $line1): self
    {
        $self = clone $this;
        $self['line1'] = $line1;

        return $self;
    }

    /**
     * The submitted address line 2.
     */
    public function withLine2(?string $line2): self
    {
        $self = clone $this;
        $self['line2'] = $line2;

        return $self;
    }

    /**
     * The submitted recipient name.
     */
    public function withRecipientName(string $recipientName): self
    {
        $self = clone $this;
        $self['recipientName'] = $recipientName;

        return $self;
    }

    /**
     * The submitted address state.
     */
    public function withState(string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * The submitted address zip.
     */
    public function withZip(string $zip): self
    {
        $self = clone $this;
        $self['zip'] = $zip;

        return $self;
    }
}
