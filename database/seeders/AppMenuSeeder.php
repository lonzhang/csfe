<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CsfeApp;
use App\Models\CsfeAppMenu;

class AppMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CsfeApp::create(['id' => 1,'app_title' => 'CS-PAC Request Case/SO Case Workpage','app_active' => '1']);
        CsfeApp::create(['id' => 2,'app_title' => 'Customer Service Complaint','app_active' => '1']);
		
		CsfeAppMenu::create([
			'id' => 1,
			'app_id' => 1,
			'apm_title' => 'Home',
			'apm_icon' => '',
			'apm_description' => '',
			'apm_url' => 'request-case/home',
			'apm_level' => '1',
			'apm_father_id' => '0'
		]);
		
		CsfeAppMenu::create([
			'id' => 2,
			'app_id' => 1,
			'apm_title' => 'Request Case',
			'apm_icon' => '',
			'apm_description' => '',
			'apm_url' => 'request-case/request-case',
			'apm_level' => '1',
			'apm_father_id' => '0'
		]);
		
		CsfeAppMenu::create([
			'id' => 3,
			'app_id' => 1,
			'apm_title' => 'SO Case',
			'apm_icon' => '',
			'apm_description' => '',
			'apm_url' => 'request-case/so-case',
			'apm_level' => '1',
			'apm_father_id' => '0'
		]);
		
		CsfeAppMenu::create([
			'id' => 4,
			'app_id' => 1,
			'apm_title' => 'Task',
			'apm_icon' => '',
			'apm_description' => '',
			'apm_url' => 'request-case/task',
			'apm_level' => '1',
			'apm_father_id' => '0'
		]);
		
		CsfeAppMenu::create([
			'id' => 5,
			'app_id' => 2,
			'apm_title' => 'Home',
			'apm_icon' => '',
			'apm_description' => '',
			'apm_url' => 'complaint/home',
			'apm_level' => '1',
			'apm_father_id' => '0'
		]);
		
		CsfeAppMenu::create([
			'id' => 6,
			'app_id' => 2,
			'apm_title' => 'Case',
			'apm_icon' => '',
			'apm_description' => '',
			'apm_url' => 'complaint/case',
			'apm_level' => '1',
			'apm_father_id' => '0'
		]);
		
		CsfeAppMenu::create([
			'id' => 7,
			'app_id' => 2,
			'apm_title' => 'Test',
			'apm_icon' => '',
			'apm_description' => '',
			'apm_url' => '',
			'apm_level' => '1',
			'apm_father_id' => '0'
		]);
		
		CsfeAppMenu::create([
			'id' => 8,
			'app_id' => 2,
			'apm_title' => 'Test 1',
			'apm_icon' => '',
			'apm_description' => '',
			'apm_url' => 'complaint/test1',
			'apm_level' => '2',
			'apm_father_id' => '7'
		]);
		
		CsfeAppMenu::create([
			'id' => 9,
			'app_id' => 2,
			'apm_title' => 'Test 2',
			'apm_icon' => '',
			'apm_description' => '',
			'apm_url' => 'complaint/test2',
			'apm_level' => '2',
			'apm_father_id' => '7'
		]);
    
    }
}
