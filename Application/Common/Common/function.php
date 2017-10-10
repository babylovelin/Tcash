<?php
    function show($status,$message,$data=array()){
        $result=array(
            'status'=>$status,
            'message'=>$message,
            'data'=>$data
        );
        
        exit(json_encode($result));
    }
    function getMd5Password($password){
        return md5($password . C('MD5_PRE'));
    }
    function sendMail($to,$username,$emailtitle,$body) {
        date_default_timezone_set('Asia/Shanghai');//设定时区东八区
        Vendor('PHPMailer.PHPMailerAutoload');
        Vendor('PHPMailer.class.phpmailer.php');
        Vendor('PHPMailer.class.smtp.php');
        Vendor('PHPMailer.class.pop3.php');
        $mail = new PHPMailer;

        $mail->SMTPDebug = 2;                               // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.qq.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '956866674@qq.com';                 // SMTP username
        $mail->Password = 'ixnyxhlkihbzbdgf';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;
    //    echo $mail->Host;                                  // TCP port to connect to
        $mail->setFrom('956866674@qq.com', 'Tcash');
        $mail->addAddress($to);               // Name is optional 填写接收者的邮箱地址
        $mail->addReplyTo('956866674@qq.com', 'Information');
        // $mail->addCC('714034323@qq.com');
        // $mail->addBCC('714034323@qq.com');
    
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(false);                                  // Set email format to HTML

        $mail->Subject = '来自Tcash的邮箱验证信息';
        $mail->Body    = $body;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo ucwords('Message has been sent');
        }
    }
?>