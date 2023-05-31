<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LinePayController extends Controller
{

    private $channel_id;
    private $channel_secret_key;

    public function __construct()
    {
<<<<<<< HEAD
        $this->channel_id = config('app.public_key');
=======
       // $this->channel_id = '1657931616';
        $this->channel_id = config('app.public_key');
       // $this->channel_secret_key = 'df4edbd305efbf8f09be3e041b5b73af';
>>>>>>> 663257e53048c0a2bcfa06cb733f4a1b44aebf06
        $this->channel_secret_key = config('app.secret_key');
    }

    public function index(){
    
        // LINE URL ※下記どちらでも可能
        $line_url = 'https://sandbox-api-pay.line.me';
        // $line_url = 'https://api-pay.line.me';

        // パス
        $path = '/v3/payments/request';
        
        // ノンス
        $nonce = $this->gen_uuid();

        // ボディ 
        $body = json_encode(array(
            "amount" => 1,
            "currency" => "JPY",
            "orderId" => "testOrderId",
            "packages" => array(array(
                "id" => "testPackages1",
                'name'   => "packages",
                "amount" => 1,
                "products" => array(array(
                    "id" => "testProducts1",
                    "name" => "products",
                    "quantity" => 1,
                    "price" => 1
                ))
            )),
            "redirectUrls" => array(
               // "confirmUrl" => "https://myPage",
                "confirmUrl" => "http://localhost/dashboard",
                
                "cancelUrl" => "https://myPage"
            )
        ));
        
    //    echo $body;
        
        // シグネチャ
        $signature = base64_encode(hash_hmac('sha256', $this->channel_secret_key . $path . $body . $nonce, $this->channel_secret_key, true));
        
        // ヘッダ情報
        $header = array(
            'Content-Type:'               . 'application/json',
            'X-LINE-ChannelId:'           . $this->channel_id,
            'X-LINE-Authorization-Nonce:' . $nonce,
            'X-LINE-Authorization:'       . $signature
        );
        
        /***********************************************************
         * API実行
         ***********************************************************/
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL,            $line_url . $path);
        curl_setopt($curl, CURLOPT_HTTPHEADER,     $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_POST,           true);
        curl_setopt($curl, CURLOPT_POSTFIELDS,     $body);

        $result = curl_exec($curl);

        curl_close($curl);

        /*
        echo '<br><br>';
        print_r($result) ;
        */

        $arr=json_decode($result,true);

        /*
        echo '<br><br>';
        print_r($arr['returnCode']) ;
        echo '<br><br>';
        print_r($arr['info']) ;
        echo '<br><br>';
        */

      //  print_r($arr['info']['paymentUrl']['web']) ;

      //  return redirect()->away('https://www.google.com');

        return Redirect()->away($arr['info']['paymentUrl']['web']);

    }

    /**
     * UUIDを生成する
     */
    public function gen_uuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }

}



