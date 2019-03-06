<?php

require 'vendor/autoload.php';

$hash = '9fcadfd59b054c6d440a4199c59e1df7';

$doc = file_get_contents('https://stock.bwg.net/');

if ($hash != md5($doc)) {
    send(['xxxx@qq.com'], '搬瓦工补货通知', '页面变化地址： stock*bwg*net');
} else {
    echo '无变化';
}


/**
 * 发送邮件
 * @param  array  $toAddr 接收邮件
 * @param  string $subject  邮件标题
 * @param  string $body  接收内容
 * @return bool
 */
function send($toAddr = [], $subject = '标题', $body = '内容')
{
    if (!is_array($toAddr)) {
        return false;
    }

    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    try {

        // 发送邮件配置
        $config = [
            'SMTPDebug' => 0,
            'Host' => 'smtp.126.com',
            'SMTPAuth' => true,
            'Username' => 'xxxx@126.com',
            'Password' => 'xxxx',
            'SMTPSecure' => 'ssl',
            'Port' => 465,
            'CharSet' => 'UTF-8'
        ];

        //Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = $config['Host'];
        $mail->SMTPAuth = $config['SMTPAuth'];
        $mail->Username = $config['Username'];
        $mail->Password = $config['Password'];
        $mail->SMTPSecure = $config['SMTPSecure'];
        $mail->Port = $config['Port'];
        $mail->CharSet = $config['CharSet'];

        //Recipients
        $mail->setFrom($config['Username'], '邮件提醒');

        foreach ($toAddr as $v) {
            $mail->addAddress($v);
        }

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        return true;
    } catch (\PHPMailer\PHPMailer\Exception $e) {
        echo $mail->ErrorInfo;
    }
}