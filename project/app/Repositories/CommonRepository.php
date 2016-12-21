<?php namespace App\Repositories;

use Crypt;

class CommonRepository implements CommonRepositoryInterface
{
    /**
      * Encrypt ID in url.
      * @param int $id      
      * @return Response
      * Created on: 28/11/2016
      * Updated on: 28/11/2016
    **/
    public static function encryptId($id)
    {
            $encrypted = Crypt::encrypt($id);
            return $encrypted;
    }

    /**
      * Decrypt ID in url.
      * @param int $id      
      * @return Response
      * Created on: 28/11/2016
      * Updated on: 28/11/2016
    **/
    public static function decryptId($id)
    {
            $decrypted = Crypt::decrypt($id);
            return $decrypted;
    }	
}

?>
