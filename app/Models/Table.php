<?php

namespace App\Models;

use DB;

/*
 * 常用数据库操作方法封装
 * 创建方法   NEW Table($table 数据表名,$pre 字段前缀)
 */
trait Table
{
	protected $vardata = "";
	
	/*
     * 插入单条数据，无附加数据
     * 传入值：$row=array() 插入的单条数据
     *      一维数组
     * 返回值：$res 成功返回1，失败返回0
     * 创建人：Leon
     */
    public function addOnly($row){
    	$res=DB::table($this->getTable())->insert($row);
		return $res;
	}

	/*
	 * 插入多条数据
	 * 传入值:$row=array(
	  				"0"=>array(),
	  				"1"=>array(),
	  				...
	            )
	 * 返回值：$res 成功返回1，失败返回0
	 * 创建人：Leon
	 */
	public function addItems($row){
		//为每条数据增加创建时间
		foreach($row as $k=>$r){
			$row[$k]["created_at"]=$date;
		}
		$res=DB::table($this->getTable())->insert($row);
		return $res;
	}

	/*
	 * 根据传入条件删除数据
	 * 传入值：$row=array()
     *      一维数组
     * 返回值：$res 成功返回1，失败返回0
     * 创建人：Leon
	 */
	public function deleteItems($row){
		$res=DB::table($this->getTable())->where($row)->delete();
		return $res;
	}

	/*
	 * 根据传入条件更改数据
	 * 传入值：$where=array() 一维数组  查找条件
	 * 	   $row=array() 一维数组  更改值
	 * 返回值：$res 成功返回1，失败返回0
	 * 创建人：Leon
	 */
	public function updateItems($where,$row){
		$res=DB::table($this->getTable())->where($where)->update($row);
		return $res;
	}
	
	/*
	 * 根据传入条件增加减少数值
	 * 传入值：$where=array() 一维数组  查找条件
	 * 	   $field 更改的字段  $value 增加/减少的数值 正数增加，负数减少
	 * 返回值：$res 成功返回影响行数，失败返回0
	 * 创建人：Leon
	 */
	public function increaseValue($where,$field,$value){
		$res=DB::table($this->getTable())->where($where)->increment($field,$value);
		return $res;
	}

	/*
	 * 根据字段名和查询值返回单条数据
	 * 传入值：$field 字段名 $value 查询值
	 * 返回值：$res为对象
	 * 创建人：Leon
	 */
	public function getByField($field,$value){
		$res=DB::table($this->getTable())->where($field,$value)->first();
		return $res;
	}

	/*
	 * 根据字段名和查询值返回多条数据
	* 传入值：$field 字段名 $value 查询值
	* 返回值：$res为二维对象
	* 创建人：Leon
	*/
	public function getRowsByField($field,$value){
		$res=DB::table($this->getTable())->where($field,$value)->get();
		return $res;
	}

	/*
	 * 根据多个查询值返回单条数据
	 * 传入值：$row 一维数组 条件值
	 * 返回值：$res为对象
	 * 创建人：Leon
	 */
	public function getByWhere($row){
		$res=DB::table($this->getTable())->where($row)->first();
		return $res;
	}

	/*
	 * 根据多个查询值返回多条数据
	* 传入值：$row 一维数组 条件值
	* 返回值：$res为二维对象
	* 创建人：Leon
	*/
	public function getRowsByWhere($row){
		$res=DB::table($this->getTable())->where($row)->get();
		return $res;
	}

	/*
	 * 返回表中所有数据
	 * 返回值为对象
	 * 创建人：Leon
	 */
	public function getAll(){
		$res=DB::table($this->getTable())->get();
		return $res;
	}

	/*
	 * 以传入字段名的值为键值返回数据
	 * 传入值：$key 需要设为键值的字段名
	 * 返回值：$res 为数组
	 * 创建人：Leon
	 */
	public function listByKey($key,$where=""){
		if($where==""){
			$list = DB::table($this->getTable())->get();
		}else{
			$list = DB::table($this->getTable())->where($where)->get();
		}
		$res=array();
		if($list){
			foreach($list as $l){
				$res[$l->$key]=(array)$l;
			}
		}
		return $res;
	}
	
	/*
	 * 以传入的两个字段名的值为键值返回数据
	 * 传入值：$key 需要设为键值的字段名（一维键名） $key2 需要设为键值的字段名（二维键名）
	 * 返回值：$res 为二维数组
	 * 创建人：Leon
	 */
	public function listByKeys($key,$key2,$where=""){
		if($where==""){
			$list = DB::table($this->getTable())->get();
		}else{
			$list = DB::table($this->getTable())->where($where)->get();
		}
		$res=array();
		if($list){
			foreach($list as $l){
				$res[$l->$key][$l->$key2]=(array)$l;
			}
		}
		return $res;
	}
	
	/*
	 * 以传入的两个字段名的值为键值和值返回数据
	 * 传入值：$key 需要设为键值的字段名（一维键名） $field 需要设为值的字段名
	 * 返回值：$res 为二维数组
	 * 创建人：Leon
	 */
	public function listFieldByKey($key,$field){
		$res=array();
		if($list=DB::table($this->getTable())->get()){
			foreach($list as $l){
				$res[$l->$key][]=$l->$field;
			}
		}
		return $res;
	}

	/*
	 * 加载搜索条件
	 * 传入值：示例(条件可为单个或多个)
	   $condition=array(
	        'where'=>array(
				'crl_name'=>"Chinese Yuan",
				'crl_name_cn'=>"人民币",
				...
    		),
    		'like'=>array(
    			'crl_name'=>"Chines",
    			'crl_name_cn'=>"中",
    			...
    		),
			'in'=>array(
    			'id'=>array("12","26",...),
    			'status'=>array("cl-1","cl-2","cl-3"...),
    			...
    		),
    		'between'=>array(
    			'id'=>array("12","26"),
    			'crl_create_time'=>array("2015-10-10 23:23:23","2017-11-10 23:23:23"),
    			...
    		),
    		'join'=>array(
    			'0'=>array('eoms_customer_list','eoms_customer_list.cl_code','eoms_currency_list.crl_code'),
    			'1'=>array('eoms_express_list','eoms_express_list.el_code','eoms_currency_list.crl_code'),
    			...
    		),
			如果join条件为多条，可以用数组一一对应，如下第一条：
			'join'=>array(
    			'0'=>array('eoms_customer_list',array('eoms_customer_list.cl_code','...'),array('eoms_currency_list.crl_code','...')),
    			'1'=>array('eoms_express_list','eoms_express_list.el_code','eoms_currency_list.crl_code'),
    			...
    		),
    		'order'=>array(
    			'crl_id'=>'ASC',
    			'crl_code'=>"DESC",
    			...
    		),
    		'group'=>array('crl_name','crl_name_cn', ...),
    		'select'=>array('crl_code','cl_code','el_code', ...)
       );
     * 返回值：已加载搜索条件的DB对象
     * 创建人：Leon
	 */
	public function selectConditions($condition){
		$query=DB::table($this->getTable());

		//加载相等条件
		if(!empty($condition['where'])){
			$query->where($condition['where']);
		}
		//加载模糊条件
		if(!empty($condition['like'])){
			foreach($condition['like'] as $k=>$like){
				$query->where($k, 'like', '%'.$like.'%');
			}
		}
		//加载in条件
		if(!empty($condition['in'])){
			foreach($condition['in'] as $k=>$in){
				$query->whereIn($k,$in);
			}
		}
		//加载范围条件
		if(!empty($condition['between'])){
			foreach($condition['between'] as $k=>$between){
				$query->whereBetween($k, [$between['0'], $between['1']]);
			}
		}
		//加载多表关联条件
		if(!empty($condition['join'])){
			foreach($condition['join'] as $join){
				if(is_array($join['1'])){
					$this->vardata = $join;
					$query->join($join['0'],function($leftjoin)
					{
						$join = $this->vardata;
						foreach($join['1'] as $k=>$j){
							$leftjoin->on($join['1'][$k], '=', $join['2'][$k]);
						}
					});
				}else{
					$query->leftJoin($join['0'],$join['1'],'=',$join['2']);
				}
			}
		}
		//加载排序条件
		if(!empty($condition['order'])){
			foreach($condition['order'] as $k=>$order){
				$query->orderBy($k,$order);
			}
		}
		//加载去重条件
		if(!empty($condition['group'])){
			foreach($condition['group'] as $group){
				$query->groupBy($group);
			}
		}
		//加载查询字段，若空为全部字段
		if(!empty($condition['select'])){
			$query->select($condition['select']);
		}
		return $query;
	}
	
	/*
	 * 加载or
	 * 传入值：示例(条件可为单个或多个)
	   $condition=array(
	        'where'=>array(
				'crl_name'=>"Chinese Yuan",
				'crl_name_cn'=>"人民币",
				...
    		),
    		'like'=>array(
    			'crl_name'=>"Chines",
    			'crl_name_cn'=>"中",
    			...
    		),
			'in'=>array(
    			'id'=>array("12","26",...),
    			'status'=>array("cl-1","cl-2","cl-3"...),
    			...
    		),
    		'between'=>array(
    			'id'=>array("12","26"),
    			'crl_create_time'=>array("2015-10-10 23:23:23","2017-11-10 23:23:23"),
    			...
    		),
       );
     * 返回值：已加载搜索条件的DB对象
     * 创建人：Leon
	 */
	public function orWheres($query,$condition){
		//加载相等条件
		if(!empty($condition['where'])){
			$query->where($condition['where']);
		}
		//加载模糊条件
		if(!empty($condition['like'])){
			foreach($condition['like'] as $k=>$like){
				$query->where($k, 'like', '%'.$like.'%');
			}
		}
		//加载in条件
		if(!empty($condition['in'])){
			foreach($condition['in'] as $k=>$in){
				$query->whereIn($k,$in);
			}
		}
		//加载范围条件
		if(!empty($condition['between'])){
			foreach($condition['between'] as $k=>$between){
				$query->whereBetween($k, [$between['0'], $between['1']]);
			}
		}
		
		return $query;
	}
}
