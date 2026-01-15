<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer;

use Increase\CheckTransfers\CheckTransfer\CreatedBy\APIKey;
use Increase\CheckTransfers\CheckTransfer\CreatedBy\Category;
use Increase\CheckTransfers\CheckTransfer\CreatedBy\OAuthApplication;
use Increase\CheckTransfers\CheckTransfer\CreatedBy\User;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * What object created the transfer, either via the API or the dashboard.
 *
 * @phpstan-import-type APIKeyShape from \Increase\CheckTransfers\CheckTransfer\CreatedBy\APIKey
 * @phpstan-import-type OAuthApplicationShape from \Increase\CheckTransfers\CheckTransfer\CreatedBy\OAuthApplication
 * @phpstan-import-type UserShape from \Increase\CheckTransfers\CheckTransfer\CreatedBy\User
 *
 * @phpstan-type CreatedByShape = array{
 *   apiKey: null|APIKey|APIKeyShape,
 *   category: Category|value-of<Category>,
 *   oauthApplication: null|OAuthApplication|OAuthApplicationShape,
 *   user: null|User|UserShape,
 * }
 */
final class CreatedBy implements BaseModel
{
    /** @use SdkModel<CreatedByShape> */
    use SdkModel;

    /**
     * If present, details about the API key that created the transfer.
     */
    #[Required('api_key')]
    public ?APIKey $apiKey;

    /**
     * The type of object that created this transfer.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * If present, details about the OAuth Application that created the transfer.
     */
    #[Required('oauth_application')]
    public ?OAuthApplication $oauthApplication;

    /**
     * If present, details about the User that created the transfer.
     */
    #[Required]
    public ?User $user;

    /**
     * `new CreatedBy()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreatedBy::with(apiKey: ..., category: ..., oauthApplication: ..., user: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreatedBy)
     *   ->withAPIKey(...)
     *   ->withCategory(...)
     *   ->withOAuthApplication(...)
     *   ->withUser(...)
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
     * @param APIKey|APIKeyShape|null $apiKey
     * @param Category|value-of<Category> $category
     * @param OAuthApplication|OAuthApplicationShape|null $oauthApplication
     * @param User|UserShape|null $user
     */
    public static function with(
        APIKey|array|null $apiKey,
        Category|string $category,
        OAuthApplication|array|null $oauthApplication,
        User|array|null $user,
    ): self {
        $self = new self;

        $self['apiKey'] = $apiKey;
        $self['category'] = $category;
        $self['oauthApplication'] = $oauthApplication;
        $self['user'] = $user;

        return $self;
    }

    /**
     * If present, details about the API key that created the transfer.
     *
     * @param APIKey|APIKeyShape|null $apiKey
     */
    public function withAPIKey(APIKey|array|null $apiKey): self
    {
        $self = clone $this;
        $self['apiKey'] = $apiKey;

        return $self;
    }

    /**
     * The type of object that created this transfer.
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
     * If present, details about the OAuth Application that created the transfer.
     *
     * @param OAuthApplication|OAuthApplicationShape|null $oauthApplication
     */
    public function withOAuthApplication(
        OAuthApplication|array|null $oauthApplication
    ): self {
        $self = clone $this;
        $self['oauthApplication'] = $oauthApplication;

        return $self;
    }

    /**
     * If present, details about the User that created the transfer.
     *
     * @param User|UserShape|null $user
     */
    public function withUser(User|array|null $user): self
    {
        $self = clone $this;
        $self['user'] = $user;

        return $self;
    }
}
