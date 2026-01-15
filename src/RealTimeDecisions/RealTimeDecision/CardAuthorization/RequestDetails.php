<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\RequestDetails\Category;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\RequestDetails\IncrementalAuthorization;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\RequestDetails\InitialAuthorization;

/**
 * Fields specific to the type of request, such as an incremental authorization.
 *
 * @phpstan-import-type IncrementalAuthorizationShape from \Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\RequestDetails\IncrementalAuthorization
 * @phpstan-import-type InitialAuthorizationShape from \Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\RequestDetails\InitialAuthorization
 *
 * @phpstan-type RequestDetailsShape = array{
 *   category: Category|value-of<Category>,
 *   incrementalAuthorization: null|IncrementalAuthorization|IncrementalAuthorizationShape,
 *   initialAuthorization: null|InitialAuthorization|InitialAuthorizationShape,
 * }
 */
final class RequestDetails implements BaseModel
{
    /** @use SdkModel<RequestDetailsShape> */
    use SdkModel;

    /**
     * The type of this request (e.g., an initial authorization or an incremental authorization).
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * Fields specific to the category `incremental_authorization`.
     */
    #[Required('incremental_authorization')]
    public ?IncrementalAuthorization $incrementalAuthorization;

    /**
     * Fields specific to the category `initial_authorization`.
     */
    #[Required('initial_authorization')]
    public ?InitialAuthorization $initialAuthorization;

    /**
     * `new RequestDetails()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RequestDetails::with(
     *   category: ..., incrementalAuthorization: ..., initialAuthorization: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RequestDetails)
     *   ->withCategory(...)
     *   ->withIncrementalAuthorization(...)
     *   ->withInitialAuthorization(...)
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
     * @param IncrementalAuthorization|IncrementalAuthorizationShape|null $incrementalAuthorization
     * @param InitialAuthorization|InitialAuthorizationShape|null $initialAuthorization
     */
    public static function with(
        Category|string $category,
        IncrementalAuthorization|array|null $incrementalAuthorization,
        InitialAuthorization|array|null $initialAuthorization,
    ): self {
        $self = new self;

        $self['category'] = $category;
        $self['incrementalAuthorization'] = $incrementalAuthorization;
        $self['initialAuthorization'] = $initialAuthorization;

        return $self;
    }

    /**
     * The type of this request (e.g., an initial authorization or an incremental authorization).
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
     * Fields specific to the category `incremental_authorization`.
     *
     * @param IncrementalAuthorization|IncrementalAuthorizationShape|null $incrementalAuthorization
     */
    public function withIncrementalAuthorization(
        IncrementalAuthorization|array|null $incrementalAuthorization
    ): self {
        $self = clone $this;
        $self['incrementalAuthorization'] = $incrementalAuthorization;

        return $self;
    }

    /**
     * Fields specific to the category `initial_authorization`.
     *
     * @param InitialAuthorization|InitialAuthorizationShape|null $initialAuthorization
     */
    public function withInitialAuthorization(
        InitialAuthorization|array|null $initialAuthorization
    ): self {
        $self = clone $this;
        $self['initialAuthorization'] = $initialAuthorization;

        return $self;
    }
}
