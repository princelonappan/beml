<?php
require(APPPATH . '/libraries/textlocal.class.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function get_current_datetime()
{
    date_default_timezone_set('Asia/Calcutta');
    $now = new DateTime();
    return $now->format('Y-m-d H:i:s');
}

function get_ip_address()
{
   return $_SERVER['REMOTE_ADDR'];
}

function rand_string($length)
{

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return substr(str_shuffle($chars), 0, $length);
}

function get_current_time()
{
    date_default_timezone_set('Asia/Manila');
    $now = new DateTime();
    return $now->format('Y-m-d H:i:s');
}

function send_sms($mobile_number, $text)
{
    $CI = & get_instance();

    $bashsms_username = $CI->config->item('bashsms_username');
    $bashsms_password = $CI->config->item('bashsms_password');
    $bashsms_sender = $CI->config->item('bashsms_sender');

    $curl = curl_init();

    $url = "http://bhashsms.com/api/sendmsg.php?user=" . $bashsms_username . "&pass=" . $bashsms_password . "&sender=" . $bashsms_sender . "&phone=" . $mobile_number . "&text=" . urlencode($text) . "&priority=ndnd&stype=normal";
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $details = curl_exec($curl);
}

function upload_image($file_name)
{
    $CI = & get_instance();
    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '10240';
    $config['max_width'] = '1024';
    $config['max_height'] = '768';
    
    $ext = end(explode(".", $_FILES[$file_name]['name']));
    $filename = md5(uniqid(time())) . $ext;
    $config['file_name'] = $filename;
    if (!is_dir($config['upload_path']))
        return false;
    $CI->load->library('upload', $config);
    if (!$CI->upload->do_upload($file_name))
    {
        unset($config);
        return false;
    }
    else
    {
        return $filename;
    }
}


/**
 * Function to check user loggined or not
 * 
 * @return boolean
 */
function get_logged_in_user()
{
    $CI = & get_instance();
        
    if($CI->session->userdata('user'))
	{
        
		$user = $CI->session->userdata('user');
		if (!empty($user))
		{ 
			return $user;
		}
	}

	return false;
}

function get_logged_user_name()
{
    $user = get_logged_in_user();
    if ($user && !empty($user))
    {
        if($user['name'] && !empty($user['name']))
            return $user['name'];
        else if($user['username'] && !empty($user['username']))
            return $user['username'];
        else
            return $user['employee_id'];
    }
    else
    {
        return false;
    }
}

/**
* Function to return if the user is logged in or not
*
* @return boolean
*/
function is_logged_in()
{

	/*
	* Check if the user needs authentication for the coming url
	*/
	$user = get_logged_in_user();
	if($user) 
	{
		return true;
	}
	
	return false;
}

function get_logged_user_id()
{
    /*
	* Check if the user needs authentication for the coming url
	*/
	$user = get_logged_in_user();
	if($user && !empty($user)) 
	{
            return $user['user_id'];
	}
        else
        {
            return false;
        }
}

function format_date($date, $format='Y-m-d H:i:s')
{
    date_default_timezone_set('Asia/Calcutta');
    $now = new DateTime($date);
    return $now->format($format);
}

function format_post($posts, $user_id)
{
    $CI = & get_instance();
    $post_details = array();
    $i = 0;
    $CI->load->model('Like_model');
    $CI->load->model('Favourite_model');
    foreach ($posts as $post)
    {
        $post_details[$i]['post_id'] = $post_id = $post['post_id'];
        $post_details[$i]['title'] = $post['title'];
        $post_details[$i]['body'] = $post['body'];
        if(!empty(json_decode($post['like_count'], true)))
        {
            $like_type_count = json_decode($post['like_count'], true);
        } 
        else 
        {
            $like_type_count = 0;
        }
        
        $post_details[$i]['like_type_count'] = $like_type_count;
        $post_details[$i]['like_total_count'] = $post['like_total_count'];
        $post_details[$i]['is_share'] = $post['is_share'];
        $post_details[$i]['media_available'] = $post['media_available'];
        if ($post['media_available'] == 1)
        {
            $post_details[$i]['media_type'] = $post['media_type'] == 6 ? 1 : $post['media_type'];
            if ($post['media_type'] == 6 || $post['media_type'] == 7)
            {
                $post_details[$i]['media_url'] = $CI->config->base_url() . 'uploads/' . $post['file_path'];
            }
            else
            {
                $post_details[$i]['media_url'] = $post['media_url'];
            }
        }
        else
        {
            $post_details[$i]['media_type'] = 0;
            $post_details[$i]['media_url'] = '';
        }


        $like_details = $CI->Like_model->get_like_details($user_id, $post_id);
        if(empty($like_details))
            $post_details[$i]['is_liked'] = 0;
        else
        {
            $post_details[$i]['is_liked'] = 1;
            $post_details[$i]['liked_type'] = $like_details[0]->like_type;;
        }
            
        
        $post_details[$i]['comment_count'] = $post['comment_count'];
        $post_details[$i]['category_id'] = $post['cat_id'];
        $post_details[$i]['category_name'] = $post['category_name'];
        $post_details[$i]['created_date'] = format_date($post['post_created_date'], 'd M Y');
        //implement the logic 
        $post_details[$i]['is_comment'] = 1;
        $post_details[$i]['created_by']['name'] = $post['name'];
        $post_details[$i]['created_by']['employee_id'] = $post['employee_id'];
        if(isset($post['user_profile_image']))
            $post_details[$i]['created_by']['user_profile_image'] = base_url() . 'uploads/user_profile_images/' . $post['user_profile_image'];
        else
            $post_details[$i]['created_by']['user_profile_image'] = '';
        $i++;
    }
    
    return $post_details;
}

function format_post_comments($comments)
{
    $CI = & get_instance();
    $post_comment_details = array();
    $i = 0;
    foreach ($comments as $comment)
    {
        $post_comment_details[$i]['post_id'] = $comment['post_id'];
        $post_comment_details[$i]['user_id'] = $comment['user_id'];
        $post_comment_details[$i]['comment'] = $comment['comment'];
        $post_comment_details[$i]['created_by']['name'] = $comment['name'];
        $post_comment_details[$i]['created_by']['employee_id'] = $comment['employee_id'];
        if(isset($comment['user_profile_image']))
            $post_comment_details[$i]['created_by']['user_profile_image'] = base_url() . 'uploads/user_profile_images/' . $comment['user_profile_image'];
        else
            $post_comment_details[$i]['created_by']['user_profile_image'] = '';
        $post_comment_details[$i]['created_date'] = format_date($comment['post_commented_date'], 'd M Y');
        $i++;
    }
    
    return $post_comment_details;
}

/**
 * 
 * @param type $mobile_number
 * @param type $type
 * @return type
 */

function send_otp($mobile_number, $type, $employee_id = NULL) 
{
    $otp = rand(1001, 9999);
    $CI = & get_instance();
    $CI->load->model('Otp_authentication_model');
    $otp_details = $CI->Otp_authentication_model->get_otp_details($mobile_number, $otp, $type);
    if(empty($otp_details)) 
    {
        $otp_authentication_details = save_otp_details($otp, $mobile_number, $type, $employee_id);
    }
    else 
    {
        $otp = rand(1001, 9999);
        $otp_authentication_details = save_otp_details($otp, $mobile_number, $type, $employee_id);
    }
    //Sending the OTP Code
    $textlocal_api_key = $CI->config->item('textlocal_api_key');
    $textlocal_sender = $CI->config->item('sms_title');
    $Textlocal = new Textlocal(false, false, $textlocal_api_key);
    //appending the 91 with mobile number
    $numbers = array($mobile_number);
    $sender = $textlocal_sender;
    if($type == 1)
        $message = $otp.' - Use this secure code in BEML First app to continue.';
    else
        $message = 'Your BEML First secure code is '.$otp.'. Enter this pin to set a new password for your account.';

    try
    {
        $response = $Textlocal->sendSms($numbers, $message, $sender);
        if (isset($response) && !empty($response) && isset($response->status) && $response->status == 'success')
        {
            $otp_authentication_details['message_response'] = json_encode($response);
            //Deleting the previous otp entries
            $CI->Otp_authentication_model->delete_previous_otp_entries($mobile_number, $type);
            $CI->Otp_authentication_model->save_otp($otp_authentication_details);
            return array('success' => true);
        }
        else
        {
            return array('success' => false);
        }
    } catch (Exception $ex)
    {
        return array('success' => false);
    }
}

function save_otp_details($otp, $mobile_number, $type, $employee_id)
{
    $otp_details['otp'] = $otp;
    $otp_details['mobile_number'] = $mobile_number;
    $otp_details['type'] = $type;
    $otp_details['created_date'] = get_current_datetime();
    $otp_details['employee_id'] = $employee_id;
    return $otp_details;
}

function insert_notification($post_title, $post_description) 
{
    $CI = & get_instance();
    $CI->load->model('Key_model');
    $CI->load->model('Email_queue_model');
    $CI->Key_model->get_device_token_details();
    $devices = $CI->Key_model->get_device_token_details();
    $data['body'] = $post_title;
    $data['title'] = substr($post_description, 0, 400);
    foreach ($devices as $device)
    {
        $token_details['to'] = $device->device_token;
        $token_details['message'] = json_encode($data);
        $token_details['status'] = 'pending';
        $token_details['date'] = get_current_datetime();
        $CI->db->insert('email_queue', $token_details);
    }
    
}

/**
 * Function to send the Notification message
 * 
 * @param type $message
 * @param type $id
 * @return boolean
 */
function send_gcm($message, $id)
{
    $CI = & get_instance();
    $firebase_app_id = $CI->config->item('firebase_app_id');
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array(
        'to' => $id,
        'notification' => $message
    );
    $fields = json_encode($fields);

    $headers = array(
        'Authorization: key=' . $firebase_app_id,
        'Content-Type: application/json'
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    
    /**
     * Comment out in the production server.
     * For Local, please enable
     */
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    /**
     * 
     */
    $result = curl_exec($ch);
   
    if(curl_error($ch))
    {
        return false;
    }
    curl_close($ch);
    return $result;
    
}
