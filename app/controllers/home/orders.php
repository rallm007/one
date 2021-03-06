<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * 
	 */
    function __construct()
    {
        parent::__construct();
        $this->load->model('order');
    }
	public function index()
	{
		$this->auth->check_login();
  	    $user_id = $this->auth->user_id();
        $this->load->model('product');
        $this->load->model('order_detail');
        $base_url = base_url().'/home/orders/index/';
        $param = $this->uri->uri_to_assoc(4);

        $keyword = $this->input->post('keyword')!='' ? trim($this->input->post('keyword')) : 
              (isset($param['keyword']) ? urldecode(trim($param['keyword'])) : '');
        $search_type = $this->input->post('search_type')!='' ? trim($this->input->post('search_type')) : 
              (isset($param['search_type']) ? urldecode(trim($param['search_type'])) : '');
        $status = $this->param['status'] = $this->input->post('status')!='' ? trim($this->input->post('status')) : 
            (isset($param['status']) ? trim($param['status']) : '');
        $create_time = $this->param['create_time'] = $this->input->post('create_time')!='' ? trim($this->input->post('create_time')) : 
            (isset($param['create_time']) ? trim($param['create_time']) : '');
        
        $condition = array("a.user_id = '".$user_id."'");

        if($keyword != '')
        {
            $condition[] = "a.code like '%".addslashes(str_replace('%', '\%', $keyword))."%'".
                        " or p.name like '%".addslashes(str_replace('%', '\%', $keyword))."%'";
            $base_url .= 'keyword/'.urlencode($keyword).'/';
        }
        // if($search_type != '')
        // {
        //     $where[] = "a.code like '%".addslashes(str_replace('%', '\%', $search_type))."%'";
        //     $base_url .= 'search_type/'.urlencode($search_type).'/';
        // }
        if($status != '')
        {
            $where[] = "a.code like '%".addslashes(str_replace('%', '\%', $status))."%'";
            $base_url .= 'status/'.urlencode($status).'/';
        }
        if($create_time != '')
        {
            switch ($create_time) {
                case 1:
                    $start_time = strtotime('-3 month');
                    $end_time = time();
                    break;
                case 2:
                    $start_time = strtotime(date('Y',time()).'-1-1');
                    $end_time = strtotime(date('Y',time()).'-12-31');
                    break;
                case 3:
                    $start_time = strtotime(date('Y-m-d',strtotime((date('Y',time())-1).'-1-1')));
                    $end_time = strtotime(date('Y-m-d',strtotime((date('Y',time())-1).'-12-31')));
                    break;
                case 4:
                    $start_time = strtotime(date('Y-m-d',strtotime((date('Y',time())-2).'-1-1')));
                    $end_time = strtotime(date('Y-m-d',strtotime((date('Y',time())-2).'-12-31')));
                    break;
                case 5:
                    $start_time = strtotime(date('Y-m-d',strtotime((date('Y',time())-3).'-1-1')));
                    $end_time = strtotime(date('Y-m-d',strtotime((date('Y',time())-3).'-12-31')));
                    break;
                case 6:
                    $start_time = strtotime(date('Y-m-d',strtotime((date('Y',time())-20).'-1-1')));
                    $end_time = strtotime(date('Y-m-d',strtotime((date('Y',time())-3).'-1-1')));
                    break;
                default:
                    $start_time = strtotime('-1 year');
                    $end_time = time();
                    break;
            }

            $condition[] =$start_time." <= a.create_time";
            $condition[] ="a.create_time <= ".$end_time;
            $base_url .= 'create_time/'.urlencode($create_time).'/';
        }

        $all = $this->order->all($condition);
        $fu_kuan = 0;
        $fa_huo = 0;
        $shou_huo = 0;
        $ping_jia = 0;
        if($all)
        {
            foreach ($all as $key => $item) {
                if(intval($item->status) == 0){
                    $fu_kuan++;
                }
                else if(intval($item->status) == 1){
                    $fa_huo++;
                }   
                else if(intval($item->status) == 2){
                    $shou_huo++;
                }
                else if(intval($item->status) == 3){
                    $ping_jia++;
                }
            }
        }

        if($status !== '')
        {
            $condition[] = 'a.status = '.$status;
        }
        
        $orderlist = $this->order->lists($condition,15,'a.id desc','a.id');
        if($orderlist)
        {
            foreach ($orderlist as $key => $item) {
                $result = $this->order->get_detail($item->id);
                $item->order_detail = $result;
            }
        }

        $data['fu_kuan'] = $fu_kuan;
        $data['fa_huo'] = $fa_huo;
        $data['shou_huo'] = $shou_huo;
        $data['ping_jia'] = $ping_jia;

        $data['order_list'] = $orderlist;
        $data['pagination'] = $this->order->pages($base_url,$condition);
        $data['keyword'] = stripslashes($keyword);
        $data['status'] = stripslashes($status);
        $data['search_type'] = stripslashes($search_type);
        $data['create_time'] = stripslashes($create_time);
        $data['status'] = $status;
        $data['create_time'] = $create_time;
		$this->load->view('home/order',$data);
	}

    public function pay($n)
    {    
        $this->auth->check_login();
        $this->load->model('order_detail');
        $this->load->model('user_coupon');
        $this->load->model('coupon');

        if(!$n)
        {
            show_404();
        }
        $order = $this->order->get($n);
        if(!$order)
        {
            show_404();
        }
        if($order->user_id != $this->auth->user_id())
        {
            show_404();
        }
        if($order->complete==1)
        {
            show_error('订单已完成',500);
        }
        $data['order'] = $order;
        $data['detail'] = $this->order->get_detail($n);
        //优惠券
        $data['coupon'] = $this->user_coupon->all(array(
            'a.user_id='.$this->auth->user_id(),
            'a.is_use="0"',
            'c.expirse_from <= '. local_to_gmt(),
            'c.expirse_to >='. local_to_gmt(),
            'c.use <= '.$order->price
        ));
        $this->load->view('home/pay',$data);
    }

}

/* End of file orders.php */
/* Location: ./application/controllers/orders.php */