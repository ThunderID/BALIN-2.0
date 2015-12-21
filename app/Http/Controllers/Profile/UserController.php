<?php namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\Web\Controller;

use Input, Redirect, Auth, Carbon, Validator, DB, App;
use Illuminate\Support\MessageBag;

// use App\Models\Transaction;
// use App\Models\User;
// use App\Models\Address;
// use App\Jobs\ChangeStatus;

class UserController extends Controller 
{
	protected $controller_name 					= 'user';

	public function index()
	{		
		$breadcrumb								= ['Profile' => route('balin.profile.user.index')];

		$this->layout->page 					= view('web.page.profile.user.index');
		$this->layout->breadcrumb 				= $breadcrumb;
		$this->layout->controller_name			= $this->controller_name;
		$this->layout->page->page_title 		= 'BALIN.ID';
		$this->layout->page->page_subtitle 		= 'Profile';

		return $this->layout;
	}

	public function edit()
	{		
		$breadcrumb									= ['Ubah Profile' => route('balin.profile.user.edit')];

		$this->layout->page 						= view('web.page.profile.user.edit');
		$this->layout->page->page_subtitle 			= 'Ubah Pengaturan Akun';

		return  $this->layout->page;
	}

	public function update()
	{
		dd(Input::all());
	}

	// public function update()
	// {		
	// 	$inputs 								= Input::only('name', 'email', 'date_of_birth', 'gender');
		
	// 	$data									= Auth::user();

	// 	if($inputs['date_of_birth'])
	// 	{
	// 		if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]))
	// 		{
	// 			$dob 							= Carbon::createFromFormat('Y-m-d', $inputs['date_of_birth'])->format('Y-m-d H:i:s');
	// 		}
	// 		else
	// 		{
	// 			$dob 								= Carbon::createFromFormat('d-m-Y', $inputs['date_of_birth'])->format('Y-m-d H:i:s');
	// 		}
	// 	}
	// 	else
	// 	{
	// 			return Redirect::route('frontend.user.index')
	// 				->withInput()
	// 				->withErrors('Tanggal lahir tidak boleh kosong')
	// 				->with('msg-type', 'danger');
	// 	}

	// 	if(Input::has('password'))
	// 	{
	// 		$validator 							= Validator::make(Input::only('password', 'password_confirmation'), ['password' => 'required|min:8|confirmed']);

	// 		if (!$validator->passes())
	// 		{
	// 			return Redirect::back()
	// 				->withInput()
	// 				->withErrors($validator->errors())
	// 				->with('msg-type', 'danger');
	// 		}
	// 	}

	// 	DB::beginTransaction();

	// 	$data->fill([
	// 			'name' 							=> $inputs['name'],
	// 			// 'email'							=> $inputs['email'],
	// 			'date_of_birth'					=> $dob,
	// 			'gender'						=> $inputs['gender'],
	// 	]);

	// 	if(Input::has('password'))
	// 	{
	// 		$data->password 					= Input::get('password');
	// 	}

	// 	if (!$data->save())
	// 	{
	// 		DB::rollback();

	// 		return Redirect::route('frontend.user.index')
	// 				->withInput()
	// 				->withErrors($data->getError())
	// 				->with('msg-type', 'danger');
	// 	}
	// 	else
	// 	{
	// 		DB::commit();

	// 		return Redirect::route('frontend.user.index')
	// 			->with('msg','Pengaturan akun sudah disimpan')
	// 			->with('msg-type', 'success');
	// 	}
	// }

	// public function point()
	// {		
	// 	$breadcrumb								= ['Ubah Profile' => route('frontend.user.edit')];
	// 	return  view('pages.frontend.user.point')
	// 												->with('controller_name', $this->controller_name)
	// 												->with('subnav_active', 'account_point')
	// 												->with('title', 'Buku Tabungan')
	// 												->with('breadcrumb', $breadcrumb);
	// }	

	// public function downline()
	// {	
	// 	$breadcrumb								= ['Ubah Profile' => route('frontend.user.edit')];
	// 	return view('pages.frontend.user.downline')
	// 												->with('controller_name', $this->controller_name)
	// 												->with('subnav_active', 'account_downline')
	// 												->with('title', 'Daftar Downline')
	// 												->with('breadcrumb', $breadcrumb);

	// }	

	// public function orders()
	// {		
	// 	$breadcrumb								= ['Ubah Profile' => route('frontend.user.edit')];
	// 	return view('pages.frontend.user.order.index')
	// 												->with('controller_name', $this->controller_name)
	// 												->with('subnav_active', 'account_order')
	// 												->with('title', 'Riwayat Pesanan')
	// 												->with('breadcrumb', $breadcrumb);

	// }

	// public function order($ref = null)
	// {		
	// 	$breadcrumb								= ['Ubah Profile' => route('frontend.user.edit')];
	// 	$transaction 							= Transaction::userid(Auth::user()->id)->type('sell')->refnumber($ref)->first();

	// 	if(!$transaction)
	// 	{
	// 		App::abort(404);
	// 	}
		
	// 	return view('pages.frontend.user.order.show')
	// 												->with('controller_name', $this->controller_name)
	// 												->with('subnav_active', 'account_order')
	// 												->with('title', 'Riwayat Pesanan #'.$ref)
	// 												->with('transaction', $transaction)
	// 												->with('breadcrumb', $breadcrumb);

	// }

	// public function orderdestroy($ref = null)
	// {		
	// 	$transaction 							= Transaction::userid(Auth::user()->id)->type('sell')->refnumber($ref)->first();
		
	// 	if(!$transaction)
	// 	{
	// 		App::abort(404);
	// 	}
		
	// 	$result                         		= $this->dispatch(new ChangeStatus($transaction, 'canceled'));

	// 	if($result->getStatus()=='success')
	// 	{
	// 		return Redirect::route('frontend.user.index')
	// 						->with('msg','Pesanan anda sudah dibatalkan')
	// 						->with('msg-type', 'success');
	// 	}

	// 	return Redirect::route('frontend.user.index')
	// 						->withErrors($result->getErrorMessage())
	// 						->with('msg-type', 'danger');
	// }

	// public function orderconfirmdestroy()
	// {
	// 	return view('widgets.dialog_confirm');
	// }

	// public function changePassword()
	// {		
	// 	$breadcrumb								= ['Ubah Password' => route('frontend.user.edit')];

	// 	return view('pages.frontend.user.change_password')
	// 												->with('controller_name', $this->controller_name)
	// 												->with('subnav_active', 'account_setting')
	// 												->with('title', 'Ubah Password')
	// 												->with('breadcrumb', $breadcrumb);
	// }	
}