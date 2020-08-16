<?php

namespace Zeus\Libraries;
use Zeus\Libraries\ZeusConfig;
use Zeus\Libraries\ZeusSecurity;
use Zeus\Libraries\ZeusUserGroup;
use Zeus\App\Models\User;
use Session;

class ZeusUser
{

    public function user_exists($username,$email)
    {
        $output=[];
        $check_username=User::whereRaw('LOWER(username) = ?',[strtolower($username)])->count();
        $check_email = User::whereRaw('LOWER(email) = ?', [strtolower($email)])->count();
        if($check_email > 0 && $check_username > 0)
        {
            $output=[
                'status'=>true,
                'username'=>true,
                'email'=>true
            ];
        }else{
            if($check_email > 0 && $check_username == 0)
            {
                $output = [
                    'status' => true,
                    'username' => false,
                    'email' => true
                ];  
            } elseif ($check_email == 0 && $check_username > 0) 
            {
                $output = [
                    'status' => true,
                    'username' => true,
                    'email' => false
                ];
            }elseif ($check_email == 0 && $check_username == 0)
            {
                $output = [
                    'status' => false,
                    'username' => false,
                    'email' => false
                ];
            }
        }
        return $output;
    }

    public function user_info_by_session()
    {
        $config = new ZeusConfig();
        $session_name = $config->config_read('general', 'session_name');
        $session_data=Session::get($session_name);
        $user_id=$session_data['id'];
        return $this->user_info_by_id($user_id);
    }

    public function user_role_info()
    {
        $config = new ZeusConfig();
        $session_name = $config->config_read('general', 'session_name');
        $session_data = Session::get($session_name);
        return [
            'group_id' => $session_data['group_id'],
            'group_name' => $session_data['group_name'],
            'group_value' => $session_data['group_value']
        ];
    }

    public function user_info_by_id($user_id)
    {
        $item = User::where('id', $user_id)->first();
        return $item;
    }

    public function user_info_by_username($username)
    {
        $item = User::whereRaw('LOWER(username) = ?', [strtolower($username)])->first();
        return $item;
    }

    public function user_info_by_email($email, $field)
    {
        $item = User::whereRaw('LOWER(email) = ?', [strtolower($email)])->first();
        return $item;
    }

    public function user_avatar($user_id, $size = '')
    {
        $config=new ZeusConfig();
        $path = $config->config_read('general', 'upload_path').'/avatar/';
        $url = $config->config_read('general', 'upload_url') . '/avatar/';
        $default = $config->config_read('general', 'avatar');        
        $user_info = $this->user_info_by_id($user_id);
        $avatar=$user_info->avatar;
        $file_path = $path . $avatar;
        $file_url = $url . $avatar;
        // if (!empty($size)) {
        //     $file_path = $path . '/thumbs/' . $size . '/' . $avatar;
        //     $file_url = $url . '/thumbs/' . $size . '/' . $avatar;
        // }
        // echo $file_path;
        if (file_exists($file_path) && is_file($file_path)) {
            $default = $file_url;
        }
        
        return $default;
    }

    public function login($user_text,$password)
    {
        $config=new ZeusConfig();
        $session_name=$config->config_read('general','session_name');
        $check_key=false;
        $type_key='';
        $result = filter_var($user_text, FILTER_VALIDATE_EMAIL);
        if($result)
        {
            $type_key='email';
            $check_email = User::whereRaw('LOWER(email) = ?', [strtolower($user_text)])->count();
            if($check_email == 1)
            {
                $check_key=true;                
            }
        }else{
            $type_key='username';
            $check_username = User::whereRaw('LOWER(username) = ?', [strtolower($user_text)])->count();
            if ($check_username == 1) 
            {
                $check_key = true;
            }
        }

        if($check_key == false)
        {
            return [
                'status'=>false,
                'message'=>ucwords($type_key).' not valid'
            ];
        }
        
        $user_info=[];
        if($type_key=='username')
        {
            $user_info=$this->user_info_by_username($user_text);
        }elseif($type_key == 'email')
        {
            $user_info = $this->user_info_by_username($user_text);
        }
        
        $hash_password=$user_info->password;

        $secure=new ZeusSecurity();
        $validate=$secure->password_verify($password,$hash_password);
        if($validate)
        {
            $user_group_id= $user_info->user_group_id;
            $group_info=$config->meta_global_find_by_id($user_group_id);
            $group_name=$group_info->meta_key;
            $group_value = $group_info->meta_value;
            $arr_session = array(
                'id' => $user_info->id,
                'name' => $user_info->name,
                'email' => $user_info->email,
                'group_id' => $user_group_id,
                'group_name' => $group_name,
                'group_value' => $group_value
            );
            Session::put($session_name, $arr_session);

            $edit=User::find($user_info->id);
            $edit->last_login       = date("Y-m-d H:i:s");
            $edit->token            = md5(sha1(time().rand(1,100).$user_info->id));
            $edit->save();

            return [
                'status'=>true,
                'message'=>'Login Valid'
            ];
        }else{
            return [
                'status' => false,
                'message' => 'Password invalid'
            ];
        }
    }

    public function has_login()
    {
        $config = new ZeusConfig();
        $session_name = $config->config_read('general', 'session_name');
        if (Session::get($session_name)) {
            return true;
        }
    }

    public function logout()
    {
        $config = new ZeusConfig();
        $session_name = $config->config_read('general', 'session_name');
        Session::forget($session_name);
    }

    public function user_avatar_update($user_id,$filename)
    {
        $edit=User::find($user_id);
        $edit->avatar   = $filename;
        $save=$edit->save();
        if($save)
        {
            return true;
        }else{
            return false;
        }
    }

    public function user_profile_update($user_id,$full_name,$email,$password_old="",$password_new="",$password_new_confirm="")
    {
        $user_info = $this->user_info_by_id($user_id);
        $username=$user_info->username;
        $last_email=$user_info->email;
        $hash_password = $user_info->password;
        $next=false;
        if($last_email == $email)
        {
            $next=true;
        }else{
            if($this->user_exists($username,$email)['status']==false)
            {
                $next=true;
            }
        }

        if(!empty($password_old))
        {
            if($password_new != $password_new_confirm)
            {
                return array(
                    'status'=>false,
                    'message'=>'Confirmation Password not match'
                );
            }

            $secure = new ZeusSecurity();
            if(!$secure->password_verify($password_old, $hash_password))
            {
                return array(
                    'status' => false,
                    'message' => 'Old Password not match'
                );
            }
        }

        if($next == true)
        {
            $edit=User::find($user_id);
            $edit->name     = $full_name;
            $edit->email    = $email;
            if(!empty($password_new))
            {
                $edit->password = $secure->password_hash($password_new);
            }
            $save=$edit->save();
            if($save)
            {
                return array(
                    'status'=>true,
                    'message'=>'Successfully updated profile'
                );
            }else{
                return array(
                    'status'=>false,
                    'message'=>'Failed update profile'
                );
            }
        }else{
            return array(
                'status' => false,
                'message' => 'Cannot change email'
            );
        }
    }

    public function user_profile_update_admin($user_id, $full_name, $email,$user_group_id,$password_new = "", $password_new_confirm = "")
    {
        $user_info = $this->user_info_by_id($user_id);
        $username = $user_info->username;
        $last_email = $user_info->email;
        $hash_password = $user_info->password;
        $next = false;
        if ($last_email == $email) {
            $next = true;
        } else {
            if ($this->user_exists($username, $email)['status'] == false) {
                $next = true;
            }
        }

        if (!empty($password_new)) {
            if ($password_new != $password_new_confirm) {
                return array(
                    'status' => false,
                    'message' => 'Confirmation Password not match'
                );
            }

            $secure = new ZeusSecurity();
        }

        if ($next == true) {
            $edit = User::find($user_id);
            $edit->name     = $full_name;
            $edit->user_group_id     = $user_group_id;
            $edit->email    = $email;
            if (!empty($password_new)) {
                $edit->password = $secure->password_hash($password_new);
            }
            $save = $edit->save();
            if ($save) {
                return array(
                    'status' => true,
                    'message' => 'Successfully updated user'
                );
            } else {
                return array(
                    'status' => false,
                    'message' => 'Failed update user'
                );
            }
        } else {
            return array(
                'status' => false,
                'message' => 'Cannot change email'
            );
        }
    }

    public function user_add($user_group_id,$full_name,$username,$email,$password_new,$password_new_confirm)
    {
        if($this->user_exists($username,$email)['status']==false)
        {
            if($password_new != $password_new_confirm)
            {
                return array(
                    'status' => false,
                    'message' => 'Confirmation Password not match'
                );
            }
            $secure = new ZeusSecurity();
            $password_hash=$secure->password_hash($password_new);

            $add=new User();
            $add->name     = $full_name;
            $add->username  = $username;
            $add->email     = $email;
            $add->password  = $password_hash;
            $add->user_group_id = $user_group_id;
            $add->status    = 1;
            $save=$add->save();
            if($save)
            {
                return array(
                    'status' => true,
                    'message' => 'Successfully added user'
                );
            } else {
                return array(
                    'status' => false,
                    'message' => 'Failed add user'
                );
            }
        }else{
            return array(
                'status' => false,
                'message' => 'Username/Email has exists'
            ); 
        }
    }

    public function user_delete($user_id)
    {
        $user_info = $this->user_info_by_id($user_id);
        $user_group_id=$user_info->user_group_id;
        if($user_group_id == 16)
        {
            return array(
                'status' => false,
                'message' => 'Failed delete user'
            );
        }

        $delete=User::where('id',$user_id)->forceDelete();
        if($delete)
        {
            return array(
                'status' => true,
                'message' => 'Successfully deleted user'
            );
        } else {
            return array(
                'status' => false,
                'message' => 'Failed delete user'
            );
        }
    }

    

}