WDWD Project Library
====================

> Useful tools I will be using and modifying in projects.

# wdwd_fileup
A utility tool for uploading files without replacing current ones.
## Usage
    class fileup extends wdwd_fileup {
      function __construct(){
        $this->base_dir = 'files/';
      }
    }
    $upload_file = new fileup();
    $upload_file->file = $_FILES['uploaded_files'];
    $upload_file->dir = 'uploads/';
    $upload_file->upload();
# wdwd_mailout
A rich text email system.
## Usage
### Configure the mailout class
    class mailout extends wdwd_mailout {
      function __construct(){
        $this->default_from = 'mywebsite@example.com';
        $this->default_subject = 'New message from mailout!';
        $this->footer = 'This email was automatically sent out by mailout!';
        $this->logo = 'http://www.example.com/images/mailout/logo.png';
        $this->tagline = 'Example, the company you can trust.';
      }
    }
### Send out a mailout
    $message = '<p>Thank you for subscribing to our mail service. You can exect an email from us once per never.</p>';
    $mailout = new mailout();
    $mailout->to = 'me@example.com';
    $mailout->body = $message;
    $mailout->send();
## Future implementations
- Batch email
- Customise fonts and styles