<?php

$theme      = get_template_directory();
$theme_uri  = get_template_directory_uri();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once $theme.'/includes-php/PHPMailer-master/src/Exception.php';
require_once $theme.'/includes-php/PHPMailer-master/src/SMTP.php';
require_once $theme.'/includes-php/PHPMailer-master/src/PHPMailer.php';
require_once $theme.'/includes-php/mail-line.php';

function strmail_in_array($strmail){
    $mails = str_replace(' ', '', $strmail);
    $mails = str_replace(';', ',', $strmail);
    $mailto = explode(",", $mails);
    return $mailto;
}

// Обратная связь
add_action("wp_ajax_feedback", "feedback");
add_action("wp_ajax_nopriv_feedback", "feedback");

function feedback(){
    $post       = $_POST;
    $request    = $_REQUEST;
    $files      = $_FILES;


    $find = array( 'http://', 'https://' );
    $replace = '';
    $site_name = str_replace( $find, $replace, get_site_url() );

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';


    switch ( $request['form'] ){
      case 'feedback':
          $subject        = 'Запись на прием. '.$request['name'];
          //$toExclusive    = get_field('g-form-feedback-mails','options');
          $toExclusive    = false;
          $toDefault      = get_field('gen-form-mails','options');
          if( $toExclusive ):
              $to = strmail_in_array( $toExclusive );
          elseif ( $toDefault ) :
              $to = strmail_in_array( $toDefault );
          endif;
          break;
      default:
          $subject = 'Письмо с сайта';
          $to = strmail_in_array(get_field('gen-form-mails','options'));
          break;
    }

    $message = '';
    $message .= "<p>";

    foreach ( $request as $key => $value ):
        switch ( $key ){
          case 'form':
          case 'action':
            $value = '';
            break;
          case 'name':
            $title = "Имя";
            break;
          case 'telephone':
            $title = "Телефон";
            break;
          case 'date':
            $title = "Дата визита";
            break;
          case 'comment':
            $title = "Комментарий";
            break;
          default:
            $title = $key;
            break;
        }

        if ( $value ):
            $message .= mail_line($title, $value);
        endif;

    endforeach;
    $message .= "</p>";

    $messageFoot = '';
    $messageFoot .= '<p>&nbsp;</p>';
    $messageFoot .= '<p>Сообщение сгенерировано роботом и отправлено с сайта http://'.$site_name.'</p>';


    $mail->setFrom('robot@'.$site_name, get_bloginfo('name'));
    foreach ( $to as $m ):
        $mail->addAddress( $m );
    endforeach;


//	$mail->SMTPDebug = 2;
//	$mail->isSMTP();
//	$mail->Host = 'smtp.yandex.ru';
//	$mail->SMTPAuth = true;
//	$mail->Username = '';
//	$mail->Password = '';
//	$mail->SMTPSecure = 'ssl';
//	$mail->Port = 465;

    //Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $message.$messageFoot;

    $mailed = '';
    $mailed = $mail->send();

    if( $mailed ) {
        $data = array(
            'success_msg' => 'Ваша заявка успешно отправлена',
        );

        send_ajax_response( 'success', $data );
    } else {
        $data = array(
            'field' => 'general',
            'text'  => 'При отправке формы произошла ошибка.<br />Попробуйте ещё раз или повторите попытку позднее.'
        );

        send_ajax_response( 'fail', $data );
    }

    die();
}

function send_ajax_response( $status, $data = array() ) {
    $response = json_encode(
        array(
            'status' => $status,
            'data'   => $data,
        ),
        256
    );

    echo $response;

    exit;
}
