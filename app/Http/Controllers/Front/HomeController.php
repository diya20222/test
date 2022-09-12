<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pawlox\VideoThumbnail\Facade\VideoThumbnail;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Requests\EditUser\UserEditVideoRequest;
use App\Http\Requests\EditUser\EditRequest;
use App\Http\Requests\EditUser\UploadVideoRequest;
use App\Http\Requests\Admin\UserRequest;


use App\Models\Comment;
use App\Models\User;
use App\Models\Like;
use App\Models\Video;
use App\Models\Aboutus;

use App\Contracts\VideoContract;
use App\Contracts\ChangePasswordContract;

class HomeController extends Controller
{
    public function __construct(VideoContract $videoService, ChangePasswordContract $changePasswordService)
	{
		$this->videoService = $videoService;
		$this->changePasswordService = $changePasswordService;
	}

    public function index(Request $request)
    {
        $trending_video = Video::where('category_id', 1)->get();
        return view('front.home', compact('trending_video'));
    }

    //edit user record
    public function updateAccount(EditRequest $request, User $user)
    {
        $image = uploadFile($request['image'], 'image');
        $user = User::find($request['id']);
        // dd($user);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->mobile = $request['mobile'];
        if ($request->hasFile('image')) {
            $image_path = public_path() . '/storage/image/' . $user->getRawOriginal('image');
            if (File::exists($image_path)) {
                File::delete($image_path);
                $user->image  = $image;
            }
        }
        $user->save();
        $request->session()->flash('success', 'Your Data Updated Successfuly');
        // return response()->json(['user'=>$user]);
        return redirect()->route('home');
    }

    //store video
    public function store(UploadVideoRequest $request)
    {
        $res = $this->videoService->upload($request->all());
        return response()->json(['video_upload' => $res]);
    }

    //edit time get video data 
    public function edit_video($id)
    {
        try {
            $video = Video::findOrFail($id);
            return view('front.form.edit_video_form', compact('video'));
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

    //update video details
    public function update_video(UserEditVideoRequest $request)
    {
        $resul = $this->videoService->update($request->all());
        return response()->json(['video_edit' => $resul]);
        // return redirect()->route('user-videos');
    }

    //delete video
    public function delete_video(Video $video)
    {
        $res = $this->videoService->deleteVideo($video->id);
        // return redirect()->route('home');
        return $res;
    }

    //single video details
    public function details(Request $request, $slug)
    {
        $like_user = false;
        $comment_user = false;
        try {
            $trending_video_slide = Video::with('videoComment')->where('slug', $slug)->firstOrFail();
            $side_video_slide = Video::where('category_id', $trending_video_slide->category_id)->get();
            if (Auth::user()) {
                $like_user = Like::where('user_id', Auth::user()->id)->where('video_id', $trending_video_slide->id)->first();
                $comment_user = Comment::where('video_id', $trending_video_slide->id)->where('user_id', Auth::user()->id)->first();
            }
            return view('front.detail', compact(['trending_video_slide', 'side_video_slide', 'like_user', 'comment_user']));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('warning', ' Sorry ! This Page Not Found.');
        }
    }
    
    // user like
    public function user_likes(Request $request)
    {
        $like = new Like;
        $video_id = Video::find($request['id']);
        $user_id = Auth::user()->id;
        $like->user_id = $user_id;
        $like->video_id = $video_id->id;
        $like->status = "Like";
        $like->save();
        return redirect()->back();
    }

    // usre dislike
    public function user_dislikes(Request $request)
    {
        $video_id = Video::find($request['id']);
        $dislike = Like::where('user_id', Auth::user()->id)->where('video_id', $video_id->id)->first();
        $dislike->forceDelete();
        return redirect()->back();
        // return response()->json(['data'=>$dislike]);
    }

    //user comment
    public function user_comments(Request $request, $slug)
    {
        if (isset($request->my_comment_id)) {
            $data = Comment::find($request->my_comment_id);
            $data->comment = $request['comment'];
            $data->save();
            return response()->json(['comment_update' => $data]);
        } else {
            $comment = new Comment();
            $comment_video_id = Video::where('slug', $slug)->first();
            $user_id = Auth::user()->id;
            $comment->name = Auth::user()->name;
            $comment->image = Auth::user()->image;
            $comment->comment = $request['comment'];
            $comment->user_id = $user_id;
            $comment->video_id = $comment_video_id->id;
            $comment->save();
            return response()->json(['comment' => $comment]);
        }
        //  return redirect()->back();
    }

    public function user_video()
    {
        $user_video = Video::with('user')->where('user_id', Auth::user()->id)->get();
        return view('front.user_videos', compact('user_video'));
    }
    //User Delete Comments
    public function delete_comments(Request $request)
    {
        return Comment::where('id', $request->id)->delete();
    }

    //user change password
    public function user_change_passwod($id)
    {
        try {
            $user = User::findOrFail($id);
            return view('front.change_password', compact('user'));
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }

    //user can change their password
    public function user_edit_password(UserRequest $request)
    {
        $data = $this->changePasswordService->updatePassword($request->all());
        $request->session()->flash('success', 'Password changed');
        return redirect()->route('home');
    }

    public function abouteUs(){
        $value=Aboutus::all();
        return view('front.layout.about_us',compact('value'));
    }
}
