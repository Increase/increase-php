<?php

declare(strict_types=1);

namespace Increase\FednowTransfers\FednowTransfer;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\FednowTransfers\FednowTransfer\CreatedBy\APIKey;
use Increase\FednowTransfers\FednowTransfer\CreatedBy\Category;
use Increase\FednowTransfers\FednowTransfer\CreatedBy\OAuthApplication;
use Increase\FednowTransfers\FednowTransfer\CreatedBy\User;

/**
 * What object created the transfer, either via the API or the dashboard.
 *
 * @phpstan-import-type APIKeyShape from \Increase\FednowTransfers\FednowTransfer\CreatedBy\APIKey
 * @phpstan-import-type OAuthApplicationShape from \Increase\FednowTransfers\FednowTransfer\CreatedBy\OAuthApplication
 * @phpstan-import-type UserShape from \Increase\FednowTransfers\FednowTransfer\CreatedBy\User
 *
 * @phpstan-type CreatedByShape = array{
 *   category: Category|value-of<Category>,
 *   apiKey?: null|APIKey|APIKeyShape,
 *   oauthApplication?: null|OAuthApplication|OAuthApplicationShape,
 *   user?: null|User|UserShape,
 * }
 */
final class CreatedBy implements BaseModel
{
    /** @use SdkModel<CreatedByShape> */
    use SdkModel;

    /**
     * The type of object that created this transfer.
     *
     * @var value-of<Category> $category
     */
    #[Required(enum: Category::class)]
    public string $category;

    /**
     * If present, details about the API key that created the transfer.
     */
    #[Optional('api_key', nullable: true)]
    public ?APIKey $apiKey;

    /**
     * If present, details about the OAuth Application that created the transfer.
     */
    #[Optional('oauth_application', nullable: true)]
    public ?OAuthApplication $oauthApplication;

    /**
     * If present, details about the User that created the transfer.
     */
    #[Optional(nullable: true)]
    public ?User $user;

    /**
     * `new CreatedBy()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CreatedBy::with(category: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CreatedBy)->withCategory(...)
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
     * @param APIKey|APIKeyShape|null $apiKey
     * @param OAuthApplication|OAuthApplicationShape|null $oauthApplication
     * @param User|UserShape|null $user
     */
    public static function with(
        Category|string $category,
        APIKey|array|null $apiKey = null,
        OAuthApplication|array|null $oauthApplication = null,
        User|array|null $user = null,
    ): self {
        $self = new self;

        $self['category'] = $category;

        null !== $apiKey && $self['apiKey'] = $apiKey;
        null !== $oauthApplication && $self['oauthApplication'] = $oauthApplication;
        null !== $user && $self['user'] = $user;

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
