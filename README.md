Mail Service
==================

Mail service is small Symfony application / service  which uses **swift mailer** bundle for sending mails.

##Usage
  - route: https://mail-service.devrise.rs/email/send
  - method: **POST**
  - schema: **https**
  - payload: 
    - **name** - Sender full name
    - **email** - Sender email address
    - **subject** - Email subject
    - **sendTo** - Receiver email address
    - **sendfrom** - Sender email address
    - **message** - Body message
    
##implementation
**html**
```html
  <div class="contact">
    <form id="contactForm" action="https://contact-controller.bet.org.rs/email/send" method="POST">
      <div class="row">
        <div class="col-md-4">
          <input type="text" id="name" name="name" placeholder="Full Name">
        </div>
        <div class="col-md-4">
          <input type="text" id="subject" name="subject" placeholder="Subject">
        </div>
        <div class="col-md-4">
          <input type="text" id="email" name="email" placeholder="E-mail">
          <input type="hidden" id="sendto" name="sendto" value="your@email.com">
          <input type="hidden" id="sendfrom" name="sendfrom" value="contact@somedomain.rs">
        </div>
      </div>
      <textarea placeholder="Message" id="message" name="message" rows="8"></textarea>
      <button class="btn-ghost pull-right" type="submit">Send</button>
    </form>
  </div>
```
**JavaScript**
```js
$('#contactForm').on('submit',function(e){
    e.preventDefault();

    var $action = $(this).prop('action');
    var $data = $(this).serialize();
    var $this = $(this);

    $this.prevAll('.alert').remove();

    $.post( $action, $data, function( response ) {

        if( response === 'error' ){

            $this.before( '<div class="alert  alert-warning">Došlo je do greške. <br />Molimo pokušajte ponovo kasnije!</div>' );
        }

        if( response === 'success' ){

            $this.before( '<div class="alert alert-success">Hvala Vam na poslatoj poruci. <br />Odgovorićemo Vam u najkraćem mogućem roku!</div>' );
            $this.find('input, textarea').val('');
        }

    }, "json");

});
```
    
##Useful links
- Symfony - [https://symfony.com/doc/current/setup.html](https://symfony.com/doc/current/setup.html)
- SwiftMailer - [https://swiftmailer.symfony.com/docs/introduction.html](https://swiftmailer.symfony.com/docs/introduction.html)