<?php

namespace Zeus\Libraries;

use Illuminate\Support\Facades\Mail;

class ZeusMessage
{

    public function send_email($send_to, $subject, $message, $template = 'email', $compact_data = null,$attachment=[])
    {
        try {
            $standard_param = [
                "email" => $send_to,
                "subject" => $subject,
                "message" => $message,
                "sender_email"  => env('MAIL_FROM_ADDRESS'),
                "sender_name"  => env('MAIL_FROM_NAME'),
            ];
            $data = [];
            if (!empty($compact_data)) {
                $data = array_merge($standard_param, $compact_data);
            } else {
                $data = $standard_param;
            }
            $template_view = "mail_template." . $template.".index";
            $sending = Mail::send($template_view, ['data' => $data], function ($message) use ($data,$attachment) {
                $message->subject($data['subject']);
                $message->from($data['sender_email'], $data['sender_name']);
                $message->to($data['email']);
                if(!empty($attachment))
                {
                    foreach ($attachment as $filePath => $fileParameters) {
                        $message->attach($filePath, $fileParameters);
                    }
                }
            });
            return array(
                'code' => 200,
                'message' => 'Email Sent'
            );  
        } catch (\Throwable $th) {
            return array(
                'code' => 500,
                'message' => $th->getMessage() . ' ' . $th->getFile() . ' ' . $th->getLine()
            );
        }
    }

}