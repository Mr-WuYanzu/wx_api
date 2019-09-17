<?php

namespace App\Http\Middleware;

use Closure;
use Emarref\Jwt\Claim;
class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $key='1810b';
        $access_token=$request->input('access_token');
        if(!$access_token){
            $response=[
                'errno'=>'1022',
                'msg'=>'access_token not null'
            ];
            die(json_encode($response));
        }
        $jwt = new \Emarref\Jwt\Jwt();
        //反序列化
        $token = $jwt->deserialize($access_token);
        //创建实力化
        $algorithm = new \Emarref\Jwt\Algorithm\Hs256($key);
        $encryption = \Emarref\Jwt\Encryption\Factory::create($algorithm);
        //验证
        $context = new \Emarref\Jwt\Verification\Context($encryption);
        $context->setAudience('audience_1');
        $context->setIssuer('wuyanzu');
        $context->setSubject('Hahaha');
        try {
            $jwt->verify($token, $context);
        } catch (\Emarref\Jwt\Exception\VerificationException $e) {
            $response=[
                'errno'=>'100012',
                'msg'=>$e->getMessage()
            ];
            die(json_encode($response));

        }

        return $next($request);
    }
}
