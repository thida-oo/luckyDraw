<?php

namespace App\Socialite;

use AlibabaCloud\SDK\Dingtalk\Vlink_1_0\Models\GetFollowerInfoResponseBody\result\user;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Arr;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\InvalidStateException;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User as TwoUser;
use PhpParser\Node\Expr\FuncCall;
use SocialiteProviders\Manager\OAuth2\User as OAuth2User;

class dingTalkProvider extends AbstractProvider implements ProviderInterface {

    protected string $authURL = "https://login.dingtalk.com/oauth2/auth";
    protected string $getUserInfobyCode = "https://oapi.dingtalk.com/sns/getuserinfo_bycode";
    //protected string $getUserInfoURL = "https://oapi.dingtalk.com/topapi/v2/user/get";
    protected string $getUserInfoURL = 'https:/api.dingtalk.com/v1.0/contact/users/me';

    //protected string $userAccessTokenURL = "https://oapi.dingtalk.com/v1.0/oauth2/userAccessToken";
    //protected string $userAccessTokenURL = 'https://api.dingtalk.com/v1.0/oauth2/userAccessToken';
    protected string $userAccessTokenURL = 'https://api.dingtalk.com/v1.0/oauth2/ssoAccessToken';

    protected $scopes = ['openid'];
    private $openId;
    protected $unionId;

    protected $withUnionId = false;

    public function withUnionId($value = true)
    {
        $this->withUnionId = $value;

        return $this;
    }



    public function getAuthUrl($state){
        //echo "auth URl <br>";
        //dd($this->buildAuthUrlFromBase($this->authURL, $state));
    //https://login.dingtalk.com/oauth2/auth?client_id=dingzqdssz4xawqpd6li&redirect_uri=http%3A%2F%2F127.0.0.1%3A8000%2Fauth%2Fdingtalk%2Fcallback&scope=openid&prompt=consent&response_type=code&state=Uh5UMPtW8PJcSSiX2p2QgmCjgsiLwayApHL7EPLM
        return $this->buildAuthUrlFromBase($this->authURL, $state);

    }

    public function getCodeFields($state=null){
        $fields = [
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUrl,
            'scope' => $this->formatScopes($this->getScopes(), $this->scopeSeparator),
            'prompt' => 'consent',
            'response_type' => 'code',
        ];

        //dd($fields);

        if ($this->usesState()) {
            $fields['state'] = $state;
        }

        if ($this->usesPKCE()) {
            $fields['code_challenge'] = $this->getCodeChallenge();
            $fields['code_challenge_method'] = $this->getCodeChallengeMethod();
        }

        return array_merge($fields, $this->parameters);

    }

    // for implement ProviderInterface
    /**
     * {@inheritdoc}
     */
    public function getTokenUrl(){
        return $this->userAccessTokenURL;
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenFields($code){

        $fields = [
            'clientId'      =>    $this->clientId,
            'clientSecret'  =>    $this->clientSecret,
            'grantType'     =>    'authorization_code',
            'code'          =>     $code,
            'refreshToken'  =>   'refresh_token,'
        ];
        // $fields = [
        //     'corpid' => $this->DINGTALK_CORP_ID
        //     'ssoSecret' => $this->ssoSecret,
        // ];
        
        return array_merge(parent::getTokenFields($code), $fields);
    }

      /**
     * Get the code from the request.
     *
     * @return string
     */
    protected function getCode()
    {  
        return $this->request->input('authCode');
    }

    /**
     * Determine if the current request / session has a mismatching "state".
     *
     * @return bool
     */
    protected function hasInvalidState()
    { 
        if ($this->isStateless()) {
            return false;
        }

        $state = $this->request->session()->pull('state');

        return empty($state) || $this->request->input('state') !== $state;
    }



    /**
     * {@inheritdoc}
     */
    public function user(){
    
    //echo "<pre>"; var_dump($this->request->all()); echo "</pre>";

        // if($this->user()){   dd("inside user");
        //     return $this->user(); 
        // }
        
        if($this->hasInvalidState()){    dd("after user");
            throw new InvalidStateException();
        }

        $code = $this->request->input('authCode');
        //dd($code);
        $response = $this->getAccessTokenResponse($code);

        $token = Arr::get($response, 'accessToken');
        
        $this->user = $this->mapUserToObject($this->getUserByToken($token));

        return $this->user->setToken($token)
                        ->setRefreshToken(Arr::get($response, 'refreshToken'))
                        ->setExpiresIn(Arr::get($response, 'expireIn'))
                        ->setApprovedScopes(Arr::get($response, 'scope', ''));
                        // explode($this->scopeSeparator, Arr::get($response, 'scope', ''))

    }

  


    public function getAccessTokenResponse($code)
    { 
        //dd($this->getTokenFields($code));
        echo "<pre> header <br>";var_dump($this->getTokenHeaders($code));  echo "</pre>";
        echo "<br>";
        echo "<pre>";var_dump($this->getTokenFields($code));  echo "</pre><br>"; 
        // dd($this->getTokenUrl(), [
        //     RequestOptions::HEADERS => $this->getTokenHeaders($code),
        //     RequestOptions::FORM_PARAMS => $this->getTokenFields($code),
        // ]);
        $response = $this->getHttpClient()->post($this->getTokenUrl(), [
            RequestOptions::HEADERS => $this->getTokenHeaders($code),
            RequestOptions::FORM_PARAMS => $this->getTokenFields($code),
        ]);
       
        return json_decode($response->getBody(), true);
    }

    public function changeBody($response): array
    {
        $result = \json_decode((string) $response->getBody(), true);
       
       // \is_array($result) || throw new InvalidArgumentException('Decoded the given response payload failed.');

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserByToken($token){
        $response =$this->getHttpClient()->get($this->getUserInfoURL, [
            RequestOptions::HEADERS => [
                'X-Acs-Dingtalk-Access-Token' => $token,
            ]
        ]);

        $me = json_decode($this->removeCallback($response->getBody()->getContents()), true);

        $this->openId = $me['openId'];
        $this->unionId = Arr::get($me, 'unionId', '');

        return $me;
    }

    public function mapUserToObject(array $user){
        dd($user);
        return (new OAuth2User())->setRaw($user)->map([
            'id'   => $this->openId, 
            'unionid' => $this->unionId, 
            'nickname' => $user['nick'] ?? null,
            'name' => $user['name'] ?? null,
            'email' => null, 
            'avatar' => $user['avatarUrl'] ?? null,
        ]);
    }

    /**
     * @param mixed $response
     *
     * @return string
     */
    protected function removeCallback($response)
    {
        if (strpos($response, 'callback') !== false) {
            $lpos = strpos($response, '(');
            $rpos = strrpos($response, ')');
            $response = substr($response, $lpos + 1, $rpos - $lpos - 1);
        }

        return $response;
    }


}

?>