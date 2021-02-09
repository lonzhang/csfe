<?php

namespace App\Providers;

use App\Models\CsfeAppMenu;

/*
 * application相关方法
 */
class AppMenuServiceProvider
{
    /*
     *获取列表信息
     *创建人：Leon
     */
    public function getLists()
    {
		return CsfeAppMenu::get();
    }
	
	/*
     *获取单条数据
     *创建人：Leon
     */
    public function getItem($id)
    {
		return CsfeAppMenu::find($id);
    }
	
	/*
     *创建
     *创建人：Leon
     */
    public function createItem($data)
    {
		//初始化返回值
        $result = ['status'=>0, 'message'=>''];

        try{
            $row = $this->formatData($data);

            $model = new CsfeAppMenu();
            $res = $model->insert($row);
            if($res){
                $result['status'] = 1;
            }
        }catch (QueryException $e) {
            $result['message'] = $e->getMessage();
        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
        }

        return $result;
    }
	
	/*
     *更新
     *创建人：Leon
     */
    public function updateItem($data)
    {
		//初始化返回值
        $result = ['status'=>0, 'message'=>''];

        try{
            $row = $this->formatData($data);

            $model = new CsfeAppMenu();
            $res = $model->where('id',$data['id'])->update($row);
            if($res){
                $result['status'] = 1;
            }
        }catch (QueryException $e) {
            $result['message'] = $e->getMessage();
        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
        }

        return $result;
    }
	
	/*
     *删除
     *创建人：Leon
     */
    public function deleteItem($id)
    {
		//初始化返回值
        $result = ['status'=>0, 'message'=>''];

        try{
            $model = new CsfeAppMenu();
            $res = $model->where('id',$id)->delete();
            if($res){
                $result['status'] = 1;
            }
        }catch (QueryException $e) {
            $result['message'] = $e->getMessage();
        } catch (\Exception $e) {
            $result['message'] = $e->getMessage();
        }

        return $result;
    }

    /*
     *格式化表单数据
     *创建人：Leon
     */
    public function formatData($data)
    {
        return $row = [
            'app_id' => isset($data['app_id']) ? $data['app_id'] : "",
            'apm_title' => isset($data['apm_title']) ? $data['apm_title'] : "",
            'apm_icon' => isset($data['apm_icon']) ? $data['apm_icon'] : "",
            'apm_description' => isset($data['apm_description']) ? $data['apm_description'] : "",
            'apm_url' => isset($data['apm_url']) ? $data['apm_url'] : "",
            'apm_level' => isset($data['apm_level']) ? $data['apm_level'] : "",
            'apm_father_id' => isset($data['apm_father_id']) ? $data['apm_father_id'] : "",
            'apm_display_flag' => isset($data['apm_display_flag']) ? $data['apm_display_flag'] : "",
        ];
    }
}
