<?php

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

function format_post($posts, $user_id, $is_favourite = false)
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
        $post_details[$i]['like_count'] = $post['like_count'];
        $post_details[$i]['is_share'] = $post['is_share'];
        if($post['media_type'] && $post['media_type'] == 6)
        {
            $post_details[$i]['media_url'] = $CI->config->base_url().'uploads/'.$post['file_path'];
            $post_details[$i]['media_type'] = 1;
        }
        else
        {
            $post_details[$i]['media_url'] = $post['media_url'];
            $post_details[$i]['media_type'] = $post['media_type'];
        }
        if($is_favourite == true)
            $post_details[$i]['is_favourited'] = 1;
        else
        {
            $favourite_details = $CI->Favourite_model->get_favourite_details($user_id, $post_id);
            if(empty($favourite_details))
                $post_details[$i]['is_favourited'] = 0;
            else
                $post_details[$i]['is_favourited'] = 1;
        }
        
        $like_details = $CI->Like_model->get_like_details($user_id, $post_id);
        if(empty($like_details))
            $post_details[$i]['is_liked'] = 0;
        else
            $post_details[$i]['is_liked'] = 1;
        
        $post_details[$i]['comment_count'] = $post['comment_count'];
        $post_details[$i]['category_id'] = $post['cat_id'];
        $post_details[$i]['category_name'] = $post['category_name'];
        $post_details[$i]['created_date'] = format_date($post['post_created_date'], 'd M Y');
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
        $post_comment_details[$i]['commented_by'] = $comment['name'];
        $post_comment_details[$i]['created_date'] = format_date($comment['post_commented_date'], 'd M Y');
        $i++;
    }
    
    return $post_comment_details;
}