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

class Post extends REST_Controller
{

    function __construct()
    {
        // Construct our parent class
        parent::__construct();
        $this->load->model('Like_model');
        $this->load->model('Post_model');
        $this->load->model('Favourite_model');
        $this->load->model('Post_comments_model');
        $this->load->model('Post_category_model');
    }
    
    function _update_like_count($post, $like_type, $post_id, $update, $previous_type = 0)
    {
        $like_count = $post->like_count;
        $like_total_count_value = $post->like_total_count;
        $like_count = json_decode($like_count, true);
        if (empty($like_count))
        {
            $like_count[$like_type] = 1;
        }
        else
        {
            if (array_key_exists($like_type, $like_count))
            {
                $like_total_count = $like_count[$like_type];
                $like_count[$like_type] = $like_total_count + 1;
            }
            else
            {
                $like_count[$like_type] = 1;
            }
            
            if ($update == true && array_key_exists($previous_type, $like_count))
            {
                $like_total_count = $like_count[$previous_type];
                $like_count[$previous_type] = $like_total_count - 1;
            }
        }

        $update_data['like_count'] = json_encode($like_count);
        if($update === false) 
        {
            $update_data['like_total_count'] = $like_total_count_value + 1;
        }
        $this->Post_model->update_post_details($post_id, $update_data);
        $this->response(array('result_code' => 200, 'result_title' => 'Success',
            'result_string' => 'Successfully updated the details'));
    }

    public function like_post()
    {
        $post_id = $this->post('post_id');
        $user_id = $this->post('user_id');
        $like_type = $this->post('like_type');
        $data['post_id'] = $post_id;
        $data['liked_by'] = $user_id;
        $data['like_type'] = $like_type;
        $data['created'] = get_current_datetime();
        $data['ip'] = get_ip_address();
        $post = $this->Post_model->get_post_by_id($post_id);
        if (!empty($post_id) && !empty($user_id) && !empty($like_type))
        {
            $like_details = $this->Like_model->get_like_details($user_id, $post_id);
            if (empty($like_details))
            {
                $response = $this->Like_model->save_post_like($data);
                if (isset($post) && isset($post[0]))
                {
                    $post = $post[0];
                    if (!empty($response) && !empty($response))
                    {
                        $this->_update_like_count($post, $like_type, $post_id, false);
                    }
                    else
                    {
                        $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'There was an issue, Please try after some time.'));
                    }
                }
                else
                {
                    $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'No Post details found.'));
                }
            }
            else
            {
                if(isset($like_details[0]) && $like_details[0]->id) 
                {
                    if ($like_details[0]->like_type != $like_type)
                    {
                        $response = $this->Like_model->update_like($like_details[0]->id, $data);
                        if (isset($post) && isset($post[0]))
                        {
                            $post = $post[0];
                            $this->_update_like_count($post, $like_type, $post_id, true, $like_details[0]->like_type);
                        }
                        else
                        {
                            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'No Post details found.'));
                        }
                    }
                    else
                    {
                        $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Already liked.'));
                    }
                }
                else
                {
                    $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'There was an issue, Please try after some time.'));
                }
            }
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide details for like the post.'));
        }
    }

    public function un_like_post()
    {
        $post_id = $this->post('post_id');
        $user_id = $this->post('user_id');
        if (!empty($post_id) && !empty($user_id))
        {
            $data['post_id'] = $post_id;
            $data['liked_by'] = $user_id;
            $data['created'] = get_current_datetime();
            $data['ip'] = get_ip_address();
            $like_details = $this->Like_model->get_like_details($user_id, $post_id);
            if (!empty($like_details) && isset($like_details[0]))
            { 
                $like_type = $like_details[0]->like_type;
                $response = $this->Like_model->unlike_post($post_id, $user_id);
                $post = $this->Post_model->get_post_by_id($post_id);
                if (isset($post) && isset($post[0]))
                {
                    $post = $post[0];
                    if (!empty($response) && !empty($response))
                    {
                        $like_count = $post->like_count;
                        $like_count = json_decode($like_count, true);
                        $like_total_count_value = $post->like_total_count;
                        if(empty($like_count))
                        {
                            $like_count = array();
                        }
                        else 
                        {
                            if(array_key_exists($like_type, $like_count)) 
                            {
                                $like_total_count = $like_count[$like_type];
                                if($like_total_count > 0)
                                    $like_count[$like_type] = $like_total_count - 1;
                            }
                        }

                        $update_data['like_count'] = json_encode($like_count);
                        if($like_total_count_value > 0)
                        {
                            $update_data['like_total_count'] = $like_total_count_value - 1;
                        }
                        $this->Post_model->update_post_details($post_id, $update_data);
                        $this->response(array('result_code' => 200, 'result_title' => 'Success',
                            'result_string' => 'Successfully updated the details'));
                    }
                    else
                    {
                        $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'There was an issue, Please try after some time.'));
                    }
                }
                else
                {
                    $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'No Post details found.'));
                }
            }
            else
            {
                $this->response(array('result_code' => 402, 'result_title' => 'Error', 'result_string' => 'Not liked.'));
            }
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide details for like the post.'));
        }
    }
    
    public function un_favourite_post()
    {
        $post_id = $this->post('post_id');
        $user_id = $this->post('user_id');
        if (!empty($post_id) && !empty($user_id))
        {
            $favourite_details = $this->Favourite_model->get_favourite_details($user_id, $post_id);
            if (!empty($favourite_details))
            {
                $response = $this->Favourite_model->un_favourite_post($post_id, $user_id);
                $post = $this->Post_model->get_post_by_id($post_id);
                if (isset($post) && isset($post[0]))
                {
                    if (!empty($response) && !empty($response))
                    {
                        $this->response(array('result_code' => 200, 'result_title' => 'Success',
                            'result_string' => 'Successfully updated the details'));
                    }
                    else
                    {
                        $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'There was an issue, Please try after some time.'));
                    }
                }
                else
                {
                    $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'No Post details found.'));
                }
            }
            else
            {
                $this->response(array('result_code' => 402, 'result_title' => 'Error', 'result_string' => 'Already updated the details.'));
            }
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide details for like the post.'));
        }
    }

    public function favourite_post()
    {
        $post_id = $this->post('post_id');
        $user_id = $this->post('user_id');
        if (!empty($post_id) && !empty($user_id))
        {
            $data['post_id'] = $post_id;
            $data['user_id'] = $user_id;
            $data['created'] = get_current_datetime();
            $data['ip'] = get_ip_address();
            $favourite_details = $this->Favourite_model->get_favourite_details($user_id, $post_id);
            if (empty($favourite_details))
            {
                $response = $this->Favourite_model->save_post_favourite($data);
                $post = $this->Post_model->get_post_by_id($post_id);
                if (isset($post) && isset($post[0]))
                {
                    if (!empty($response) && !empty($response))
                    {
                        $this->response(array('result_code' => 200, 'result_title' => 'Success',
                            'result_string' => 'Successfully updated the details'));
                    }
                    else
                    {
                        $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'There was an issue, Please try after some time.'));
                    }
                }
                else
                {
                    $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'No Post details found.'));
                }
            }
            else
            {
                $this->response(array('result_code' => 402, 'result_title' => 'Error', 'result_string' => 'Already updated the details.'));
            }
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide details for like the post.'));
        }
    }

    public function add_comment_post()
    {
        $post_id = $this->post('post_id');
        $user_id = $this->post('user_id');
        $comment = $this->post('comment');
        if (!empty($post_id) && !empty($comment) && !empty($user_id))
        {
            $data['post_id'] = $post_id;
            $data['user_id'] = $user_id;
            $data['comment'] = $comment;
            $data['created_date'] = get_current_datetime();
            $data['status'] = 1;
            $details = $this->Post_comments_model->save_comment($data);
            $post = $this->Post_model->get_post_by_id($post_id);
            if (isset($post) && isset($post[0]))
            {
                $post = $post[0];
                if ($details)
                {
                    $comment_count = $post->comment_count;
                    $new_count = $comment_count + 1;
                    $update_data['comment_count'] = $new_count;
                    $this->Post_model->update_post_details($post_id, $update_data);
                    $this->response(array('result_code' => 200, 'result_title' => 'Success',
                        'result_string' => 'Successfully added the comment.'));
                }
                else
                {
                    $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'There was an issue, Please try after some time.'));
                }
            }
            else
            {
                $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'No Post details found.'));
            }
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide details for like the post.'));
        }
    }

    public function get_posts_get()
    {
        $category_id = $this->get('category_id');
        $user_id = $this->rest->user_id;
        if (!empty($category_id))
        {
            $pagination_limit = $this->config->item('pagination_limit');
            $offset = $this->input->get('offset');
            $posts = $this->Post_model->get_post_by_category($category_id, $pagination_limit, $offset);
            $post_details = format_post($posts, $user_id);
            if ($post_details && !empty($post_details))
            {
                $this->response(array('result_code' => 200, 'result_title' => 'Success',
                    'result_string' => 'Success', 'posts' => $post_details));
            }
            else
            {
                $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'No Posts found'));
            }
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide details for getting the posts.'));
        }
    }

    public function get_post_comments_get()
    {
        $post_id = $this->get('post_id');
        if (!empty($post_id))
        {
            $pagination_limit = $this->config->item('pagination_limit');
            $offset = $this->input->get('offset');
            $post_comments = $this->Post_comments_model->get_post_comments($post_id, $pagination_limit, $offset);
            $post_comments = format_post_comments($post_comments);
            if ($post_comments && !empty($post_comments))
            {
                $this->response(array('result_code' => 200, 'result_title' => 'Success',
                    'result_string' => 'Success', 'post_comments' => $post_comments));
            }
            else
            {
                $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'No comments found.'));
            }
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide details for getting the post comments'));
        }
    }

    public function get_favourite_posts_get()
    {
        $user_id = $this->get('user_id');
        if (!empty($user_id))
        {
            $pagination_limit = $this->config->item('pagination_limit');
            $offset = $this->input->get('offset');
            $posts = $this->Favourite_model->get_favourite_posts($user_id, $pagination_limit, $offset);
            $post_details = format_post($posts, $user_id, true);
            if ($post_details && !empty($post_details))
            {
                $this->response(array('result_code' => 200, 'result_title' => 'Success',
                    'result_string' => 'Success', 'posts' => $post_details));
            }
            else
            {
                $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'No Posts found'));
            }
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'Please provide details for getting the favourite post'));
        }
    }

    public function get_post_categories_get()
    {
        $categories = $this->Post_category_model->get_categories();
        if ($categories && !empty($categories))
        {
            $this->response(array('result_code' => 200, 'result_title' => 'Success',
                'categories' => $categories));
        }
        else
        {
            $this->response(array('result_code' => 400, 'result_title' => 'Error', 'result_string' => 'No categories found.'));
        }
    }

}
