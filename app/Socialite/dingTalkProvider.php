<?php

namespace App\Socialite;

use GuzzleHttp\RequestOptions;
use Illuminate\Support\Arr;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\InvalidStateException;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;

class dingTalkProvider extends AbstractProvider implements ProviderInterface {

    protected string $authURL = "https://login.dingtalk.com/oauth2/auth";
    protected string $getUserInfobyCode = "https://oapi.dingtalk.com/sns/getuserinfo_bycode";

    protected string $getUserInfoURL = 'https:/api.dingtalk.com/v1.0/contact/users/me';

    protected string $userAccessTokenURL = 'https://api.dingtalk.com/v1.0/oauth2/userAccessToken';

    protected string $getUserDepartmentURL = "https://oapi.dingtalk.com/topapi/v2/department/listsub";

    
    private $openId;
    protected $unionId;

    protected $withUnionId = false;

    protected $scopes = ['openid'];

    public function withUnionId($value = true)
    {
        $this->withUnionId = $value;

        return $this;
    }



    public function getAuthUrl($state){

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
     * {@inheritdoc}
     */
    public function user(){

        // if($this->user()){   
        //     dd($this->user());
        //     return $this->user(); 
        // }

        if($this->hasInvalidState()){             
            throw new InvalidStateException();
        }

        $code = $this->request->input('authCode');
        
        $response = $this->getAccessTokenResponse($code);
dd($response);
        $token = Arr::get($response, 'accessToken');
        
        $this->user = $this->mapUserToObject($this->getUserByToken($token));

        return $this->user->setToken($token)
                        ->setRefreshToken(Arr::get($response, 'refreshToken'))
                        ->setExpiresIn(Arr::get($response, 'expireIn'))
                        ->setApprovedScopes(Arr::get($response, 'scope', ''));

    }

    public function getDeptData($token){
                //get Dept data
            
                $dept_response = $this->getHttpClient()->get($this->getUserDepartmentURL, [
                    RequestOptions::HEADERS => [
                        'X-Acs-Dingtalk-Access-Token' => $token,
                    ],
                    RequestOptions::JSON => [
                        'dept_id' => '1',
                        'language' => 'en_US'
                    ]
                ]);

               
                // echo "dept data .."; var_dump($token); echo "<br>";
        
                $dept_me = json_decode($this->removeCallback($dept_response->getBody()->getContents()), true);
        
                dd($dept_me);
    }


    public function getAccessTokenResponse($code)
    {  
        $response = $this->getHttpClient()->post($this->getTokenUrl(), [
            RequestOptions::JSON => $this->getTokenFields($code),
        ]);

        return $this->changeJSONBody($response);
    }

    public function changeJSONBody($response): array
    { 
        $result = \json_decode((string) $response->getBody(), true);

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

        return (new User())->setRaw($user)->map([
            'id'   => $this->openId, 
            'unionid' => $this->unionId, 
            'nickname' => $user['nick'] ?? null,
            'name' => $user['nick'] ?? null,
            'email' => $user['email'] ?? null, 
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