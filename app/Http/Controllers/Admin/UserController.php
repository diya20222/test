<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UpdateSettingRequest;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Contracts\ChangePasswordContract;
use App\Contracts\SettingContract;
use App\Models\User;
use App\Models\Setting;

use App\Http\Controllers\Controller;

use App\DataTables\UserDataTable;
use App\Models\Aboutus;

class UserController extends Controller
{
    public function __construct(ChangePasswordContract $changePasswordService, SettingContract $settingService)
    {
        $this->changePasswordService = $changePasswordService;
        $this->settingService = $settingService;
    }

    public function showUserData(UserDataTable $userDataTable)
    {
        return $userDataTable->render('admin/user_list');
    }

    public function editUserData(User $user)
    {
        return view('admin.form.edit_user_password', compact('user'));
    }

    public function updateUserData(UserRequest $request)
    {
        $data = $this->changePasswordService->updatePassword($request->all());
        $request->session()->flash('success', 'Password changed');
        return redirect()->route('admin.user-list');
    }

    public function profileUserData(User $user)
    {
        return view('admin.user_profile', compact('user'));
    }

    public function destroyUserData(User $user)
    {
        unlink(public_path() . '/storage/image/' . $user->getRawOriginal('image'));
        $user->delete();
        return $user;
    }

    public function editSettingDetails(Setting $setting)
    {
        return view('admin.form.setting_form', compact('setting'));
    }
    public function updateSettingDetails(UpdateSettingRequest $request)
    {
        $data = $this->settingService->updateSetting($request->all());
        return response()->json(['setting' => $data]);
    }
    public function updateAboutusDetails(Request $request)
    {
        $data = $this->settingService->updateAboutus($request->all());
        return response()->json(['aboutus' => $data]);
            
    }
    public function editaboutusDetails(Aboutus $aboutus)
    {
        return view('admin.form.aboutus_form', compact('aboutus'));
    }
}
