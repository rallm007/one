<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**********************************
    * 优惠券
    * @author alex.liang
    * 2014/11/7
**********************************/
class Coupon extends CI_Model{
	
	private $table = 'coupon';
    private $page = 1;
    private $per_page = 15;
    private $param = array();
    private $base_url = '';
    private $groupby = '';

    //---------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();
        $param = $this->uri->uri_to_assoc(4);
        $this->page = isset($param['page']) ? trim($param['page']) : 1;
        $this->base_url = '';
    }
    //----------------------------------------------------------------
	public function insert($row)
    {
		if(is_array($row) && !empty($row)){
            if(!isset($row['create_time']) || intval($row['create_time'])==0)
            {
                $row['create_time'] = time();
            }
			if($this->db->insert($this->table,$row)){
				return $this->db->insert_id();
			}
		}
		return false;
	}
	public function update($row,$id)
    {
		if(!empty($row) && $id){
			$this->db->where('id',$id);
			return $this->db->update($this->table,$row);
		}
		return false;
	}	
    //----------------------------------------------------------------

	public function delete($id)
    {
		if($id){
			$this->db->where('id',$id);
            return $this->db->delete($this->table);
		}
		return false;
	}
    //----------------------------------------------------------------

	public function get($id)
    {
		if($id){
            $this->db->from($this->table. ' as a');
			$this->db->where('a.id',$id);
            $type = 'a.*';
            $this->db->select($type);
			$query = $this->db->get();
			if($query->num_rows()>0){
				return $query->row();
			}
		}
		return false;
	}
	//----------------------------------------------------------------

    /**
    *   get_param
    *   返回所有参数
    *   @param return array
    * 
    */
    public function get_param()
    {
        return $this->param;
    }
    //----------------------------------------------------------------

    /**
    *   condition
    *   由传递的参数拼成查询条件
    */
    public function condition($cond=array())
    {
        $where = array();
        if(isset($this->param['user_id']) && $this->param['user_id'] != '')
        {
            $where[] = "a.user_id = '".$this->param['user_id']."'";
            $this->base_url .= 'user_id/'.urlencode($this->param['user_id']).'/';
        }
        if(!empty($cond))
        {
            $where = array_merge($where,$cond);
        }
        if(!empty($where))
        {
            return "(".implode(") and (",$where).")";
        }
        return '';
    }
    /**
     * lists
     * 查询所有 显示列表
     * @param var orderby 排序方式
     * @param var groupby 分组方式
     * @param int num 每页显示的个数
     * @author alex.liang
     * 2014/11/7
     */    
    public function lists($where=array(),$num=15,$orderby='',$groupby='')
    {
        $_where = $this->condition($where);
        $_num = intval($num)>0 ? intval($num) : 15;
        $_start = (intval($this->page)-1)*$_num;
        $_orderby = isset($orderby) && $orderby!='' ? $orderby : 'a.id desc';
        $this->groupby = isset($groupby) && $groupby!='' ? $groupby : '';
        $this->per_page = $_num;
        $_type = 'a.*';
        $this->db->select ( $_type );
        if(isset($_where)){
            $this->db->where($_where);
        }
        $this->db->limit($_num,$_start);
        $this->db->from($this->table.' as a');
        if($this->groupby!='')
        {
            $this->db->group_by($this->groupby);
        }
        $this->db->order_by($_orderby);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;   
    }
    //----------------------------------------------------------------
    /**
     * all
     * 查询所有 显示列表
     * @param var orderby 排序方式
     * @param var groupby 分组方式
     * @param int num 每页显示的个数
     * @author alex.liang
     * 2014/11/7
     */    
    public function all($where=array(),$orderby='',$groupby='')
    {
        $_where = $this->condition($where);
        $_orderby = isset($orderby) && $orderby!='' ? $orderby : 'a.id desc';
        $this->groupby = isset($groupby) && $groupby!='' ? $groupby : '';
        $_type = 'a.*';
        $this->db->select ( $_type );
        if(!empty($_where)){
            $this->db->where($_where);
        }
        $this->db->from($this->table.' as a');
        if($this->groupby!='')
        {
            $this->db->group_by($this->groupby);
        }
        $this->db->order_by($_orderby);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result();
        }
        return false;   
    }
    //----------------------------------------------------------------
    /**
     * count
     * 查询所有数量
     * @param var orderby 排序方式
     * @param var groupby 分组方式
     * @param int num 每页显示的个数
     * @author alex.liang
     * 2014/11/7
     */    
    public function count($where)
    {
        $_where = $this->condition($where);
        $this->db->select ('count(a.id) as count');
        if(isset($_where)){
            $this->db->where($_where);
        }
        $this->db->from($this->table.' as a');
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $result = $query->result();
            return $result[0]->count;
        }
        return 0; 
    }
    //----------------------------------------------------------------

    /**
    * 分页
    */
    public function pages($where)
    {
        $config['per_page'] = $this->per_page;
        $config['total_rows'] = $this->count($where);
        $config['base_url'] = rtrim($this->base_url,'/');
        $this->pagination->initialize($config);
        return $this->pagination->links();
    }
    //----------------------------------------------------------------

    /**
    *   exist
    *   检查是否存在
    *   @param int id
    * 
    */
    public function exist($where)
    {
        if($where){
            $this->db->from($this->table. ' as a');
            $this->db->where($where);
            $type = 'count(a.id) as count';
            $this->db->select($type);
            $query = $this->db->get();
            if($query->row()->count > 0)
            {
                return true;
            }
        }
        return false;
    }
    //----------------------------------------------------------------

    public function get_type($type='')
    {
        $arr = array(
            '1' => '购物赠送',
            '2' => '商家赠送'
        );
        if($type!=='')
        {
            if(array_key_exists($type, $arr))
            {
                return $arr[$type];
            }
            else
            {
                return false;
            }
        }
        return $arr;
    }

}
/* End of file Coupon.php */
/* Location: ./app/models/Coupon.php */	