<?php

class ThaSendGridMailer
{
    
    private static $_instance = null;
    public $parent = null;
    
    
    public function __construct($parent)
    {
        $this->parent = $parent;
    }
    
    
    public function sendgrid_transactional_email($to, $template_id, $subs)
    {
        
        if (!is_array($subs)) {
            return 'Error: ThaSendGrid subs param not array';
        }
        
        // format substitutions as json
        $subs_json = '{';
        foreach ($subs as $key => $sub) {
            $subs_json .= '"-' . $key . '-":"' . $sub . '",';
        }
        $subs_json .= '}';
        
        $request_body = '{
          "personalizations": [
            {
              "to": [
                {
                  "email": "' . $to . '"
                }
              ],
              "substitutions": ' . $subs_json . '
            },
          ],
          "from": {
            "email": "' . thaSendGrid()->settings->from_email . '",
            "name": "' . thaSendGrid()->settings->from_name . '"
          },
          "template_id": "' . $template_id . '"
        }';
        
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => thaSendGrid()->settings->send_endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $request_body,
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . thaSendGrid()->settings->api_key,
                "content-type: application/json"
            )
        ));
        
        $response = curl_exec($curl);
        $err      = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            $out .= "cURL Error #:" . $err;
        } else {
            $out .= 'success';
        }
        echo $out;
        
    }
    
    public static function instance($parent)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self($parent);
        }
        return self::$_instance;
    } // End instance()
    
    
}