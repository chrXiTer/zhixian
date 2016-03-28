<?php
namespace Common\Common;
/** 
 * 利用mcrypt做AES加密解密 
 * @author ts24<tsxw24@gmail.com> 
 */  
  
abstract class AesTool{  
    const CIPHER = MCRYPT_RIJNDAEL_128;  //规定加密算法,另外还有192和256两种长度  
    const MODE = MCRYPT_MODE_ECB;  //规定加密模式  
     //$key   密钥 
     //$str   需加密的字符串 
    static public function encode( $key, $str ){  
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(self::CIPHER,self::MODE),MCRYPT_RAND);  
        return mcrypt_encrypt(self::CIPHER, $key, $str, self::MODE, $iv);  
    }  
      
     //$key   密钥 
     //$str   需解密的字符串 
    static public function decode( $key, $str ){  
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(self::CIPHER,self::MODE),MCRYPT_RAND);  
        return mcrypt_decrypt(self::CIPHER, $key, $str, self::MODE, $iv);  
    }  
}
?>