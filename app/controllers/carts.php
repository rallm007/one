<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carts extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
    	$this->load->library('session');
        $this->load->model('cart');
        $this->load->model('product');
    }
	public function index()
	{

        $user_id = $this->auth->user_id();
        if($user_id)
        {
            $list = $this->cart->all(array('type'=>'a.product_id,a.count,p.name,p.price,p.best_price','join_product'=>true, 'where'=>array('user_id'=>$user_id)));
        }
        else
        {
            $list = $this->session->userdata('cart');
        }
        $data['list'] = $list;
		$this->load->view('home/cart', $data);
	}

	public function add()
	{
        $post = $this->input->post();
        $product_id = intval($post['product_id']);
        $count = intval($post['count']);
        $product = $this->product->get($product_id);
        if(!$product)
        {
            echo json_encode(array('code'=>'1001','msg'=>$this->lang->line('no_data_exist')));
            exit;
        }
		if($this->auth->is_login())
        {
            $user_id = $this->auth->user_id();
            $exist = $this->cart->get_by_user($user_id,$product_id);
            if($exist)
            {
                $this->cart->update(array('count'=>$exist->count+$count),$exist->id);
            }
            else
            {
                $this->cart->insert(array('user_id'=>$user_id,'product_id'=>$product_id,'count'=>$count));
            }
            $total = $this->cart->count();
        }
        else
        {
            $cart = $this->session->userdata('cart');
            if(!$cart)
            {
                $cart = array();
            }
            $exist = false;
            foreach($cart as $key => $value)
            {
                if($value['product_id'] == $product_id)
                {
                    $cart[$key]['count'] = $value['count']+$count;
                    $exist = true;
                    break;
                }
            }
            if(!$exist)
            {
                $p = array(
                    'product_id'=>$product_id,
                    'name' => $product->name,
                    'count'=>$count,
                    'price'=>$product->price,
                    'best_price'=>$product->best_price
                );
                $cart[] = $p;
            }
            $this->session->set_userdata('cart', $cart);
            $total = count($cart);
        }
        echo json_encode(array('code'=>'1000','msg'=>$this->lang->line('success'),'total'=>$total));
	}

    public function del()
    {
        $post = $this->input->post();
        $product_id = intval($post['product_id']);
        if(!$product_id)
        {
            echo json_encode(array('code'=>'1001','msg'=>$this->lang->line('param_error')));
            exit;
        }
        if($this->auth->is_login())
        {
            $user_id = $this->auth->user_id();
            if($this->cart->del($user_id, $product_id))
            {
                echo json_encode(array('code'=>'1000'));
            }
            else
            {
                echo json_encode(array('code'=>'1001','msg'=>$this->lang->line('failed')));
                exit;
            }
        }
        else
        {
            $cart = $this->session->userdata('cart');
            if(!empty($cart))
            {
                foreach ($cart as $key => $value) {
                    if($value['product_id'] == $product_id)
                    {
                        unset($cart[$key]);
                        break;
                    }
                }
                $this->session->set_userdata('cart',$cart);
            }
            echo json_encode(array('code'=>'1000'));
        }
    }
}

/* End of file cart.php */
/* Location: ./application/controllers/cart.php */