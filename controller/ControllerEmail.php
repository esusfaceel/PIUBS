<?php
use PHPMailer\PHPMailer\PHPMailer;

if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('mailer/PHPMailerAutoload');
Import::library('mailer/src/PHPMailer');
Import::library('mailer/src/Exception');
Import::library('mailer/src/SMTP');
Import::config('Configuracao');

class ControllerEmail
{

    public function sendEmailRecoveryPassword($destinatario, $nome, $link)
    {
        $assunto = "Recuperação de senha";
        $corpo = "Olá " . $nome . ",<br>
        Você solicitou recuperação de senha? Acesse o link para recuperar sua senha.<br/>
        O link possui validade de três (3) horas.<br/>
        <a href='" . $link . "'>Recuperação de senha, click aqui!</a>
        <br/><br/>
        Caso não tenha conhecimento desta atividade, por favor altere seus dados de acesso!</div>
        <hr><small>Este comunicado de serviço foi enviado por e-mail para informar sobre alterações importantes na sua conta.</small>";
        return $this->montaEmail($destinatario, utf8_decode($nome), utf8_decode($assunto), utf8_decode($this->cabecalhoEmail($assunto, $corpo)));
    }

    private function cabecalhoEmail($titulo, $corpo)
    {
        return "<div style='padding: 15px 10% 0px 18%;' align='justify'>
<div align='center'><img src='" . Configuracao::HOST_SERVER . "/model/img/loginlogo.png' alt='logo_saude' style='max-width: 150px;' /></div>
<div style='background: #3B5D75; color: white; padding: 10px 20px 0px 20px;'>
<h2>" . $titulo . "<h2></div>
<div style='padding: 10px 20px 0px 20px;'>" . $corpo . "</div>";
    }

    private function montaEmail($destinatario, $nome, $assunto, $msg, $caminhoAnexo = null, $altAnexo = null)
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Username = Configuracao::EMAIL;
        $mail->Password = "412135xde";
        $mail->Port = 587;

        $mail->setFrom(Configuracao::EMAIL, "Sistema de gerenciamento de UBS");
        $mail->addReplyTo(Configuracao::EMAIL, "Sistema de gerenciamento de UBS");
        $mail->addAddress($destinatario, $nome);
        $mail->isHTML(TRUE);

        $mail->Subject = $assunto;
        $mail->msgHTML(nl2br($msg));
        $mail->AltBody = nl2br(strip_tags($msg, '<a><div>'));
        // $mail->addAttachment($caminhoAnexo, $altAnexo);

        if ($mail->send())
            return TRUE;
        else
            return $mail->ErrorInfo;
    }
}
