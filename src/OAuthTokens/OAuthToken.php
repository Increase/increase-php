<?php

declare(strict_types=1);

namespace Increase\OAuthTokens;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\OAuthTokens\OAuthToken\TokenType;
use Increase\OAuthTokens\OAuthToken\Type;

/**
 * A token that is returned to your application when a user completes the OAuth flow and may be used to authenticate requests. Learn more about OAuth [here](/documentation/oauth).
 *
 * @phpstan-type OAuthTokenShape = array{
 *   accessToken: string,
 *   groupID: string,
 *   tokenType: TokenType|value-of<TokenType>,
 *   type: Type|value-of<Type>,
 * }
 */
final class OAuthToken implements BaseModel
{
    /** @use SdkModel<OAuthTokenShape> */
    use SdkModel;

    /**
     * You may use this token in place of an API key to make OAuth requests on a user's behalf.
     */
    #[Required('access_token')]
    public string $accessToken;

    /**
     * The Group's identifier. A Group is the top-level organization in Increase.
     */
    #[Required('group_id')]
    public string $groupID;

    /**
     * The type of OAuth token.
     *
     * @var value-of<TokenType> $tokenType
     */
    #[Required('token_type', enum: TokenType::class)]
    public string $tokenType;

    /**
     * A constant representing the object's type. For this resource it will always be `oauth_token`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new OAuthToken()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OAuthToken::with(accessToken: ..., groupID: ..., tokenType: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OAuthToken)
     *   ->withAccessToken(...)
     *   ->withGroupID(...)
     *   ->withTokenType(...)
     *   ->withType(...)
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
     * @param TokenType|value-of<TokenType> $tokenType
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $accessToken,
        string $groupID,
        TokenType|string $tokenType,
        Type|string $type,
    ): self {
        $self = new self;

        $self['accessToken'] = $accessToken;
        $self['groupID'] = $groupID;
        $self['tokenType'] = $tokenType;
        $self['type'] = $type;

        return $self;
    }

    /**
     * You may use this token in place of an API key to make OAuth requests on a user's behalf.
     */
    public function withAccessToken(string $accessToken): self
    {
        $self = clone $this;
        $self['accessToken'] = $accessToken;

        return $self;
    }

    /**
     * The Group's identifier. A Group is the top-level organization in Increase.
     */
    public function withGroupID(string $groupID): self
    {
        $self = clone $this;
        $self['groupID'] = $groupID;

        return $self;
    }

    /**
     * The type of OAuth token.
     *
     * @param TokenType|value-of<TokenType> $tokenType
     */
    public function withTokenType(TokenType|string $tokenType): self
    {
        $self = clone $this;
        $self['tokenType'] = $tokenType;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `oauth_token`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
