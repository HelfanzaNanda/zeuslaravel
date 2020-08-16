<?php

namespace Zeus\App\Controllers\Tools;

use Zeus\App\Controllers\ZeusController;
use Zeus\Libraries\ZeusMessage;
use Illuminate\Http\Request;

class SendEmailController extends ZeusController
{

    public function index()
    {
        return zeus_view('zeus::tools.send_email.index', ['title' => 'Send Email']);
    }

    public function send_email_do(Request $request)
    {
        if($request->ajax())
        {
            $validator = \Validator::make($request->all(), [
                'to'    =>  'required',
                'subject'    =>  'required',
                'message'    =>  'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => print_r($validator->errors())
                ]);
            }

            $send_to = $request->to;
            $subject = $request->subject;
            $message = $request->message;
            $base_key = 'file';
            $attachment = [];
            if ($request->hasFile($base_key)) {
                $images = $request->file($base_key);
                foreach ($images as $img) {
                    $real_path=$img->getRealPath();
                    $path = $img->getClientOriginalName();
                    $mime=$img->getClientMimeType();
                    $file_name = $base_key . uniqid() . rand(1, 1000) . '.' . $img->getClientOriginalExtension();
                    $attachment[$real_path] = [
                        'as' => $file_name,
                        'mime' => $mime
                    ];
                }
            }
            $email_lib = new ZeusMessage();
            $send = $email_lib->send_email($send_to, $subject, $message, 'default', [], $attachment);
            // dd($send);
            if ($send['code'] == 200) {
                return response()->json([
                    'status' => true
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => $send['message']
                ]);
            }
        }else{
            die('Not ajax request');
        }
    }

}