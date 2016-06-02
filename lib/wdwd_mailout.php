<?php
class wdwd_mailout {
  public $from;
  public $body;
  function send(){
    $data = array();
    if (!isset($this->from) || $this->from == '') $this->from = $this->default_from; # If no from, fallback to default.
    if (!isset($this->subject) || $this->subject == '') $this->subject = $this->default_subject; # If no subject, fallback to default.
    
    // Create Mail Headers
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $headers .= "From: $this->from\r\n";
    if (isset($this->bcc) && $this->bcc != '') $headers .= "Bcc: ".$this->bcc."\r\n"; # If there's a Bcc, add it.
    $headers .= "Reply-To: $this->from\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion()."\r\n";

    // Start Creating Message
    $message = '<html><body style="background-color: #cccccc; font-family: Arial, Helvetica, sans-serif;">';
    $message .= '<div style="width:80%;margin:10px auto 10px auto;padding:40px 40px 10px 40px;background-color:#fff">';

    if (isset($this->logo) && $this->logo != '') $message .= '<img style="max-width: 450px;max-height: 100px;" src="'.$this->logo.'">'; # If there's a logo, add it.
    if (isset($this->tagline) && $this->tagline != '') $message .= '<p style="margin:5px auto;">'.$this->tagline.'</p>'; # If there's a tagline, add it.
    if (isset($this->header) && $this->header != '') $message .= $this->header; # If there's a header, add it.

    $message .= '<h1 style="margin: 70px auto 50px auto;">Someone has requested to join your account!</h1>';
    $message .= $this->body;
    if (isset($this->footer) && $this->footer != '') $message .= '<p style="margin: 40px auto 5px auto;color:#555;text-align:center;font-size:10px;">'.$this->footer.'</p>'; # If there's a footer, add it.
    $message .= '</div>';
    $message .= '</body></html>';
    if (mail($this->to, $this->subject, $message, $headers)) {
      $data['to'] = $this->to;
      $data['from'] = $this->from;
      $data['subject'] = $this->subject;
      $data['headers'] = $headers;
      $data['message'] = $message;
    };
    return $data;
  }
}

class mailout extends wdwd_mailout {
  function __construct(){
    $this->default_from = 'georgewoodward@hotmail.co.uk';
    $this->default_subject = 'This was sent out from mailout!';
    $this->footer = 'This email was automatically sent out by trakify!';
    $this->logo = 'http://www.underconsideration.com/brandnew/archives/facebook_2015_logo_detail.png';
    $this->tagline = 'The Ultimate Solution for Pubs, Clubs and Retail Shops.';
  }
}

// Let's test this
$mailout = new mailout();
$mailout->to = 'georgewoodward95@googlemail.com';
$mailout->body = '<p>A user has just requested a join your account. Please accept or deny this request in your control panel.</p>';

// See the Results
echo "<pre>";
print_r($mailout->send());
echo "</pre>";
?>