<?php

namespace App\Providers;

use App\Models\CsfeApp;

/*
 * application相关方法
 */
class ApplicationServiceProvider
{
    /*
     *获取apps的列表信息
     *创建人：Leon
     */
    public function getLists()
    {
		return CsfeApp::get();
    }
	
	/*
     *获取apps单条数据
     *创建人：Leon
     */
    public function getItem($id)
    {
		return CsfeApp::find($id);
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

            $model = new CsfeApp();
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

            $model = new CsfeApp();
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
            $model = new CsfeApp();
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
            'app_title' => isset($data['app_title']) ? $data['app_title'] : "",
            'app_icon' => isset($data['app_icon']) ? $data['app_icon'] : "",
            'app_description' => isset($data['app_description']) ? $data['app_description'] : "",
            'app_active' => isset($data['app_active']) ? $data['app_active'] : "",
            'app_permission_path' => isset($data['app_permission_path']) ? $data['app_permission_path'] : "",
        ];
    }

    /*
     *获取关联menu数据
     *创建人：Leon
     */
    public function getAppMenu($id)
    {
        $app_menus = CacheServiceProvider::getAppMenuCache();
        return isset($app_menus[$id]) ? $app_menus[$id] : [];
    }
}