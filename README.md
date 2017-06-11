# SendGrid Transactional Emails for WP 
This a developer friendly helper plugin for interacting with the SendGrid V3 Mail API to send templated transactional emails. 

## Usage:

- Enter your API key etc in the class-settings.php file

- Tie the PHP function below to your functions to trigger your email templates.  

- Add your SendGrid Substitution Tags to the function. 


### Example: 


```

// functions.php


//Hook somewhere in wp
add_action('wp_footer', 'send_sg_mail');

function send_sg_mail(){

  	// check if we are set to test - add ?send-test to a page url
	  if(isset($_GET['send-test'])){

        $to = 'youremail@example.com';
        $template_id = '9a9d3jj-fajk-447c-944c-b723432safbfwere52e';

        // Substitute tags - will have dashes automatically appended and prepended to sent params
        $subs = array(
            'name' => '', 
            'requester' => '',
            'connect_url' => '',
            'requester_email' => ''
        );

        // check that the function exists - plugin active etc
        if(function_exists('thaSendGrid')){
        	  //trigger the email  - will return a 'success' or error messages
            echo thaSendGrid()->mailer->sendgrid_transactional_email($to, $template_id, $subs);
        }
    }
}


```

