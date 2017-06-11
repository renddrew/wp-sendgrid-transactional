<?php

class ThaSendGridSettings
{
    
    private static $_instance = null;
    public $parent = null;
    public $api_key;
    public $send_endpoint;
    public $from_email;
    public $from_name;
    
    public function __construct($parent)
    {
        $this->parent        = $parent;
        $this->api_key       = ''; // Your SendGrid API key
        $this->send_endpoint = 'https://api.sendgrid.com/v3/mail/send'; // SendGrid send endpoint 
        $this->from_email    = ''; // Email from address
        $this->from_name     = ''; // Email from name
    }
    
    public static function instance($parent)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self($parent);
        }
        return self::$_instance;
    } // End instance()
    
}