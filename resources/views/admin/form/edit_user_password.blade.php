@extends('admin.master')
@section('title', 'Admin | Change User Password')

@section('main')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">

      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
          <div id="wait" style="display:none;width:70px;height:90px;position:absolute;top:40%;left:45%;padding:2px;z-index:1;">
              <img src="{{asset('storage/image/Film.gif')}}" width="100" height="100"/>
            </div>
            <h4 class="card-title">Change Password</h4>
            <p class="card-description">
              Welcome {{$user->name}}
            </p>
            @include('error')
            <!-- form start -->
            <form class="forms-sample" method="post" action="/admin-panel/edit-user" enctype="multipart/form-data">
              @csrf
              <!-- User password -->
              <input type="hidden" class="form-control" name="user_id" value="{{$user->id}}"><br>
              <div class="form-group">
                <label for="exampleInputPassword">Old Password</label>
                <input type="password" class="form-control" name="password" placeholder="User Old Password">
                @error('password')
                <span class="fadeIn second" role="alert" style="color: red;">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <!-- confirm password -->
              <div class="form-group">
                <label for="exampleInputPassword">New Password</label>
                <input type="password" class="form-control" name="new_password" placeholder="New Password">
                @error('new_password')
                <span class="fadeIn second" role="alert" style="color: red;">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputPassword">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                @error('confirm_password')
                <span class="fadeIn second" role="alert" style="color: red;">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary mr-2">Update</button>
            </form>
            <a href="/admin-panel/user-list"><button class="btn btn-light" style="float: right;">Cancel</button></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection