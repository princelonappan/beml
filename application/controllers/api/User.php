<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
 */
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller
{

    function __construct()
    {
        // Construct our parent class
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Key_model');
        $this->load->model('Otp_authentication_model');
    }

    public function signup_post()
    {
        $employee_id = $this->post('employee_id');
        $date_of_birth = $this->post('date_of_birth');
        $date_of_join = $this->post('date_of_join');
        $mobile_number = $this->post('mobile_number');
        if (!empty($employee_id) && !empty($date_of_birth) && !empty($date_of_join)
                && !empty($mobile_number))
        {
            $user_details = $this->User_model->get_user_by_employee_details($employee_id, $date_of_birth, $date_of_join, $mobile_number);
            if (!empty($user_details) && !empty($user_details[0]))
            {
                $user_details = $user_details[0];
                $user_id = $user_details->id;
                $is_registered = $user_details->is_registered;
                if ($is_registered == 1)
                {
                    $this->response(array('result_code' => 202, 'result_title' => 'Error',
                        'result_string' => 'Already a user'));
                }
                else
                {
                    if ($user_details->user_profile_image && !empty($user_details->user_profile_image))
                    {
                        $user_details->user_profile_image = base_url() . 'uploads/user_profile_images/' . $user_details->user_profile_image;
                    }
                    else
                        unset($user_details->user_profile_image);
                    
                    //sending the otp token to the mobile number.
                    $response = send_otp($mobile_number, 1);
                    if($response['success'] == true)
                    {
                        $this->response(array('result_code' => 200, 'result_title' => 'Successfully sent the OTP to the mobile number.',
                        'result_string' => 'Success', 'user' => $user_details));
                    }
                    else 
                    {
                        $this->response(array('result_code' => 400, 'result_title' => 'Error',
                        'result_string' => 'Error occured while sending the OTP. Please try after sometime.'));
                    }
                }
            }
            else
            {
                $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Invalid employee details.'));
            }
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide employee details.'));
        }
    }

    public function login_post()
    {
        $key = $this->rest->key;
        $employee_id = $this->post('employee_id');
        $password = $this->post('password');
        if (!empty($employee_id) && !empty($password))
        {
            $user_details = $this->User_model->get_user_by_employee_id($employee_id);
            if (isset($user_details['0']) && !empty($user_details['0']))
            {
                $user = $user_details['0'];
                $password_md5 = $user->password;
                if ($password_md5 == md5($password))
                {
                    $update_data['user_id'] = $user->id;
                    $this->Key_model->update_key_details($key, $update_data);

                    if ($user->user_profile_image && !empty($user->user_profile_image))
                    {
                        $user->user_profile_image = base_url() . 'uploads/user_profile_images/' . $user->user_profile_image;
                    }
                    else
                        unset($user->user_profile_image);

                    $this->response(array('result_code' => 200, 'result_title' => 'Success', 'user' => $user));
                }
                else
                {
                    $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Invalid employee details!'));
                }
            }
            else
            {
                $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Invalid employee details'));
            }
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide user details.'));
        }
    }
    
    /**
     * Send OTP
     */
    public function send_otp_post()
    {
        $key = $this->rest->key;
        $mobile_number = $this->post('mobile_number');
        $type = $this->post('type');
        if (!empty($mobile_number) && !empty($type))
        {
            $user_details = $this->User_model->get_user_by_mobile_id($mobile_number);
            if (isset($user_details['0']) && !empty($user_details['0']))
            {
                $user = $user_details['0'];
                //sending the otp number to the mobile number
                $response = send_otp($mobile_number, $type);
                if ($response['success'] == true)
                {
                    $this->response(array('result_code' => 200, 'result_title' => 'Successfully sent the OTP to the mobile number.',
                        'result_string' => 'Success'));
                }
                else
                {
                    $this->response(array('result_code' => 400, 'result_title' => 'Error',
                        'result_string' => 'Error occured while sending the OTP. Please try after sometime.'));
                }
            }
            else
            {
                $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'No user registered with the mobile number.'));
            }
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide mobile details.'));
        }
    }
    
    public function verify_otp_post()
    {
        $key = $this->rest->key;
        $mobile_number = $this->post('mobile_number');
        $otp = $this->post('otp');
        $type = $this->post('type');
        if (!empty($mobile_number) && !empty($otp) && !empty($type))
        {
            $otp_details = $this->Otp_authentication_model->get_otp_details($mobile_number, $otp, $type, true);
            if (isset($otp_details['0']) && !empty($otp_details['0']))
            {
                $otp_details = $otp_details['0'];
                $user_details = $this->User_model->get_user_by_mobile_id($mobile_number);
                $$otp_details_id = $otp_details->id;
                if (isset($user_details['0']) && !empty($user_details['0']))
                {
                    $user = $user_details['0'];
                    $user_id = $user->id;
                    $update_otp_data['is_verified'] = 1;
                    $this->Otp_authentication_model->update_otp_details($$otp_details_id, $update_otp_data);
                    //If the type is signup, then updating the session with current user id.
                    if ($type == 1)
                    {
                        $key = $this->rest->key;
                        $update_data['user_id'] = $user_id;
                        $this->Key_model->update_key_details($key, $update_data);
                        if ($user->user_profile_image && !empty($user->user_profile_image))
                        {
                            $user->user_profile_image = base_url() . 'uploads/user_profile_images/' . $user->user_profile_image;
                        }
                        else
                            unset($user->user_profile_image);

                        $this->response(array('result_code' => 200, 'result_title' => 'Success',
                            'result_title' => 'Successfully verified the mobile number.','user' => $user, 'type' => $type));
                    }
                    else
                    {
                        $reset_password_token = rand_string(30);
                        $user_details = array(
                            'reset_password_token' => $reset_password_token
                        );
                        
                        $user_details = $this->User_model->update_users_details($user_id, $user_details);
                        $this->response(array('result_code' => 200, 'result_title' => 'Success', 'user' => $user,
                            'type' => $type, 'reset_password_token' => $reset_password_token));
                    }                    
                }
                else 
                {
                    $this->response(array('result_code' => 400, 'result_title' => 'Error', 
                        'result_string' => 'No user registered with the mobile number.'));
                }
            }
            else
            {
                $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Invalid OTP details'));
            }
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide user details.'));
        }
    }

    public function forgot_password_post()
    {
        $employee_id = $this->post('employee_id');
        $date_of_birth = $this->post('date_of_birth');
        $date_of_join = $this->post('date_of_join');
        if (!empty($employee_id) && !empty($date_of_birth) && !empty($date_of_join))
        {
            $user_details = $this->User_model->get_user_by_employee_details($employee_id, $date_of_birth, $date_of_join);
            if (!empty($user_details) && !empty($user_details[0]))
            {
                $current_time = get_current_datetime();
                $user_details = $user_details[0];
                $user_id = $user_details->id;
                $user_details = array(
                    'name' => '',
                    'password' => '',
                    'modified_date' => $current_time,
                    'is_registered' => 0
                );

                $user_details = $this->User_model->update_users_details($user_id, $user_details);
                $user = $this->User_model->get_user_by_id($user_id);
                $this->response(array('result_code' => 200, 'result_title' => 'Success', 'result_string' => 'Successfully updated the user details.'));
            }
            else
            {
                $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Invalid employee details.'));
            }
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide employee details.'));
        }
    }

    public function logout_post()
    {
        $key = $this->rest->key;
        if (!empty($key) && !empty($key))
        {
            if (isset($this->rest->user_id) && !empty($this->rest->user_id))
            {
                $update_data['user_id'] = '';
                $this->Key_model->update_key_details($key, $update_data);
            }
            $this->response(array('result_code' => 200, 'result_title' => 'Success', 'result_string' => 'Successfuly logged out from the application.'));
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide user details.'));
        }
    }

    public function get_user_get()
    {
        $user_id = $this->get('user_id');
        if (!empty($user_id))
        {
            $user = $this->Pari_users_model->get_user_by_id($user_id);
            if (isset($user['0']) && !empty($user['0']))
            {
                $this->response(array('result_code' => 200, 'result_title' => 'Success', 'user' => $user));
            }
            else
            {
                $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'No user details found.'));
            }
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide user details.'));
        }
    }

    public function update_user_profile_post()
    {
        $user_id = $this->post('user_id');
        if (!empty($user_id))
        {
            $name = $this->post('name');
            $password = $this->post('password');
            $confirm_password = $this->post('confirm_password');

            $user_data = $user_details = array();
            $current_time = get_current_datetime();
            if (!empty($name) && !empty($confirm_password))
            {
                if ($password == $confirm_password)
                {
                    $user_details = array(
                        'name' => $name,
                        'password' => md5($password),
                        'modified_date' => $current_time,
                        'is_registered' => 1
                    );

                    $user_details = $this->User_model->update_users_details($user_id, $user_details);
                    $user = $this->User_model->get_user_by_id($user_id);
                    $user = $user[0];
                    if ($user->user_profile_image && !empty($user->user_profile_image))
                    {
                        $user->user_profile_image = base_url() . 'uploads/user_profile_images/' . $user->user_profile_image;
                    }
                    else
                        unset($user->user_profile_image);
                    $this->response(array('result_code' => 200, 'result_title' => 'Success', 'user' => $user, 'result_string' => 'Successfully updated the user details.'));
                }
                else
                {
                    $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please enter the same value for the password.'));
                }
            }
            else
            {
                $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide user details.'));
            }
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide user id.'));
        }
    }

    public function upload_user_image_post()
    {
        $key = $this->rest->key;
        if (!empty($key) && isset($this->rest->user_id) && !empty($this->rest->user_id) && isset($_FILES['user_image']))
        {
            $user_id = $this->rest->user_id;
            $path = $_FILES['user_image']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $uploaddir = './uploads/user_profile_images/';
            $user_img = time() . rand() . '.' . $ext;
            $uploadfile = $uploaddir . $user_img;

            if (move_uploaded_file($_FILES['user_image']['tmp_name'], $uploadfile))
            {
                $user_details = array(
                    'user_profile_image' => $user_img
                );
                $user_details = $this->User_model->update_users_details($user_id, $user_details);
                $user = $this->User_model->get_user_by_id($user_id);
                $user = $user[0];
                if ($user->user_profile_image && !empty($user->user_profile_image))
                {
                    $user->user_profile_image = base_url() . 'uploads/user_profile_images/' . $user->user_profile_image;
                }
                else
                    unset($user->user_profile_image);
                $this->response(array('result_code' => 200, 'result_title' => 'Success', 'user' => $user, 'result_string' => 'Successfully updated the user details.'));
            }
            else
            {
                $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'There was an issue while uploading the image.'));
            }
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide user id.'));
        }
    }

    public function reset_password_post()
    {
        $user_id = $this->post('user_id');
        $old_password = $this->post('old_password');
        $new_password = $this->post('new_password');
        if (!empty($user_id) && !empty($old_password) && !empty($new_password))
        {
            $user = $this->Pari_users_model->get_user_by_id($user_id);
            if (isset($user['0']) && !empty($user['0']))
            {
                $user = $user['0'];
                $old_password_md5 = $user->password;
                if ($old_password_md5 == md5($old_password))
                {
                    $user_details = $this->Pari_users_model->update_user_details($user_id, array('password' => md5($new_password)));
                    $user = $this->Pari_users_model->get_user_by_id($user_id);
                    $this->response(array('result_code' => 200, 'result_title' => 'Success', 'user' => $user[0], 'result_string' => 'Successfully updated the user password.'));
                }
                else
                {
                    $this->response(array('result_code' => 200, 'result_title' => 'Error', 'result_string' => 'Please provide the correct old password.'));
                }
            }
            else
            {
                $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide user details.'));
            }
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide user password details.'));
        }
    }

}
