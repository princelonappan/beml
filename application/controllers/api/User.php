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
    }

    public function signup_post()
    {
        $employee_id = $this->post('employee_id');
        $date_of_birth = $this->post('date_of_birth');
        $date_of_join = $this->post('date_of_join');
        if (!empty($employee_id) && !empty($date_of_birth) && !empty($date_of_join))
        {
            $user_details = $this->User_model->get_user_by_employee_details($employee_id, $date_of_birth, $date_of_join);
            if (!empty($user_details) && !empty($user_details[0]))
            {
                $user_details = $user_details[0];
                $user_id = $user_details->id;
                $key = $this->rest->key;
                $update_data['user_id'] = $user_id;
                $this->Key_model->update_key_details($key, $update_data);
                $this->response(array('result_code' => 200, 'result_title' => 'Success',
                    'result_string' => 'Success', 'user' => $user_details));
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

    public function forgot_password_post()
    {
        $key = $this->rest->key;
        $email = $this->post('email');
        if (!empty($email))
        {
            $user = $this->Pari_users_model->get_user_by_email($email);
            if (isset($user['0']) && !empty($user['0']))
            {
                $user = $user['0'];
                $message = "";
                //send a mail
                $title = $this->config->item('parippuvada_title');
                $site_url = WEBSITE_URL;

                $pass_rest_key = random_password();
                $link_key = encrypt($email . '||' . $pass_rest_key);

                $reset_link = $site_url . "/password/recover_password/" . $link_key;
                $user_details['pass_rest_key'] = $link_key;
                $this->Pari_users_model->update_users_details($user->id, $user_details);

                $message = "Hi " . $user->firstname . " " . $user->lastname . ",<br>";
                $message.= "To change your password for " . $title . ", you must click on following this link:<br><br>";
                $message.= "<a href='" . $reset_link . "'>" . $reset_link . "</a><br>";
                $message.= "(If clicking on the link doesn't work, copy and paste it into your browser.)<br><br>";
                $message.= "Thanks,<br>" . $title . "  Administrator";
                $to = $user->email;
                $subject = "Your request for change password of " . $title . "";
                $admin = $this->Pari_admindetails_model->get_details(1);
                $from = $admin['email'];
                $fromname = $title;

                send_mail($to, $message, $subject, $from, $fromname);
                $this->response(array('result_code' => 200, 'result_title' => 'Success', 'result_string' => "We have sent a password reset link to $to"));
            }
            else
            {
                $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Invalid email address!'));
            }
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide valid email address.'));
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
            $email = $this->post('email');
            $gender = $this->post('gender');
            $address = $this->post('address');
            $phone_number = $this->post('phone_number');
            $password = $this->post('password');
            $confirm_password = $this->post('confirm_password');

            $user_data = $user_details = array();
            $current_time = get_current_datetime();
            if (!empty($name) && !empty($address) && !empty($gender) && !empty($password) && !empty($confirm_password) && !empty($phone_number))
            {
                if ($password == $confirm_password)
                {
                    $user_details = array(
                        'name' => $name,
                        'email' => $email,
                        'address' => $address,
                        'gender' => $gender,
                        'password' => md5($password),
                        'phone_number' => $phone_number,
                        'modified_date' => $current_time
                    );

                    $user_details = $this->User_model->update_users_details($user_id, $user_details);
                    $user = $this->User_model->get_user_by_id($user_id);
                    $this->response(array('result_code' => 200, 'result_title' => 'Success', 'user' => $user[0], 'result_string' => 'Successfully updated the user details.'));
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
