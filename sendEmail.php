<?php
use PHPmailer\PHPmailer\PHPMailer;

if(isset($_POST['name'])) && isset($_POST['email']){
  $name=$_POST['name'];
  $email=$_POST['email'];
  $subject=$_POST['subject'];
  $body=$_POST['body'];

  require_once 'PHPMailer/PHPMailer.php';
  require_once 'PHPMailer/SMTP.php';
  require_once 'PHPMailer/Exception.php';

  $mail=new PHPMailer();

//smtp settings
$mail->isSMTP();
$mail->Host="smtp.gmail.com"
$mail->SMTPAuth=true;
$mail->Username="manasgarg123@gmail.com";
$mail->Password="Scurry@30";
$mail->Port=465;
$mail->SMTPSecure="ssl";


//email settings
$mail->isHTML(true);
$mail->setForm($email,$name);
$mail->addAddress("manasgarg123@gmail.com");
$mail->Subject=("$email($subject)");
$mail->Body=$body;


if($mail->send()){
  $status="success";
  $response="Email is sent";

}
else{
  $status="failed";
  $response"something is wrong:<br>".$mail->ErrorInfo;

}
exit(json_encode(array("status"=> $status,"response"=> $response)));



 ?>

<!-- script-->

<script type="text/javascript">
function sendEmail() {
  var name=$("name");
  var email=$("email");
  var subject=$("subject");
  var body=$("body");

  if(isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(body)){
    $.ajax({
      url:'sendEmail.php',
      method:'POST',
      dataType:'json',
      data:{
        name:name.val(),
        email:email.val(),
        subject:subject.val(),
        body:body.val(),
      },success:function(response){
        $('#myForm')[0].reset();
        $('sent-notification').text("Message sent sucessfully,");

      }

    })
  }

}
function isNotEmpty(caller){
  if(caller.val()==""){
    caller.css('border','1px solid red' );

  }
  else{
    caller.css('border','');
    return true;
  }
}

</script>
