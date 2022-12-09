<?php

function encrypt_string($input)
{
    $inputlen = strlen($input);
    $randkey = rand(1, 9);
    $i = 0;
    while ($i < $inputlen) {
        $inputchr[$i] = (ord($input[$i]) - $randkey);
        $i++;
    }
    $encrypted = implode('.', $inputchr) . '.' . (ord($randkey) + 50);

    return $encrypted;
}

function decrypt_string($input)
{
    $input_count = strlen($input);
    $dec = explode('.', $input);
    $x = count($dec);
    $y = $x - 1;
    $calc = $dec[$y] - 50;
    $randkey = chr($calc);
    $i = 0;
    $real = '';
    while ($i < $y) {
        $array[$i] = $dec[$i] + $randkey;
        $real .= chr($array[$i]);
        $i++;
    };

    $input = $real;

    return $input;
}

add_action('wp_ajax_tp_process_form', 'tp_process_contact_form');
add_action('wp_ajax_nopriv_tp_process_form', 'tp_process_contact_form');

function tp_process_contact_form()
{
    $data_mess = [];
    $msg_error = $body_msg = '';

    foreach ($_POST['data'] as $item) {
        $required = $item['required'] && empty($item['value']) ? 'yes' : '';

        if ($item['type'] == 'email') {
            $msg_error .= filter_var($item['value'], FILTER_VALIDATE_EMAIL) ? '' : 'yes';
        //$required = 'yes';
        } else {
            $msg_error .= $item['required'] && empty($item['value']) ? 'yes' : '';
        }

        $data_mess[] = [

            'id' => $item['id'],
            'required' => $required,
            'type' => $item['type'],
            'placeholder' => $item['placeholder'],
            'value' => $item['value'],

        ];

        $body_msg .= '<p><b>' . $item['placeholder'] . '</b>:' . $item['value'] . '</p>';

        $to_email = $item['to'];
        $subject_mail = $item['subject'];
        $success_msg = $item['success_msg'];
        $error_msg = $item['error_msg'];
        $fail_msg = $item['fail_msg'];
    }

    if ($msg_error) {
        $data_mess['error'] = $error_msg;
    } else {
        $toemails = decrypt_string($to_email);
        $to = explode(',', $toemails);
        $subject = $subject_mail;
        $body = $body_msg;
        $headers[] = 'Content-Type: text/html; charset=UTF-8';

        if (wp_mail($to, $subject, $body, $headers)) {
            $data_mess['success'] = $success_msg;
        } else {
            $data_mess['fail'] = $fail_msg;
        }
    }

    //echo '<pre>' . var_export($data_mess, true) . '</pre>';
    header('Content-type: application/json');
    echo json_encode($data_mess);
    exit();
}
