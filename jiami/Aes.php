<?php
//Aes加密
namespace app\lib\encrypt;
class Aes
{
    /**
     * method 为AES-128-CBC时
     * @var string传入要加密的明文
     * 传入一个16字节的key
     * 传入一个16字节的初始偏移向量IV
     */
    private static $method = 'AES-128-CBC';
    private static $key = '2j8s2jjug!$^Yu*@Yjmwy36b7n8kmf8p';
    private static $options = OPENSSL_RAW_DATA;
    private static $iv = '5d4ceac35490a*@!';

    public static function getKey()
    {
        return self::$key;
    }
    public function __construct($key,$iv,$method)
    {
          self::$key = substr(md5($key),0,16);;
          self::$iv = substr(md5($iv),0,16);
          self::$method = $method;
    }

    public function _encrypt($input){
        $data = base64_encode(openssl_encrypt($input,self::$method,self::$key,self::$options,self::$iv));
        return $data;
    }

    /**
     * @param $input
     * @return bool|string
     * todo rtrim
     */
    public function _decrypt($input){
        $data = openssl_decrypt(base64_decode($input),self::$method,self::$key,self::$options,self::$iv);
        return $data;
    }

}
/**
<script type="text/javascript" >
    var key_base = 'contentWindowHig';
    var iv_base = 'contentDocuments'
    var key_hash = CryptoJS.MD5(key_base).toString();
    var iv_hash = CryptoJS.MD5(iv_base).toString();
    var key = CryptoJS.enc.Utf8.parse(key_hash.substr(0,16));
    var iv = CryptoJS.enc.Utf8.parse(iv_hash.substr(0,16));
    function _decrypt(string) {
        var data = CryptoJS.AES.decrypt(string, key, {iv: iv, padding: CryptoJS.pad.Pkcs7}).toString(CryptoJS.enc.Utf8);
        return data;
    }
    function _encrypt(string) {
        var data = CryptoJS.AES.encrypt(string, key, {
            iv: iv,
            mode: CryptoJS.mode.CBC,
            padding: CryptoJS.pad.Pkcs7
        }).toString();
        return data;
    }

    var a = _encrypt('msgg');
    var b = _decrypt(a);
    var c= _decrypt('evD5EE8QGSWpuqzhDFaamw==')
    console.log(a);
    console.log(b);
    console.log(c);
</script>
**/