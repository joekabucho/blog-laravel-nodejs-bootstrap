@extends('user.user')
@section('title', 'My Pictures')
@section('user-content')
    @can('manager',$user)
        <div class="p-3">
            <form method="post" action="{{ route('user.update.avatar') }}"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="patch">
                @if($user->avatar)
                    <img src="{{ $user->avatar }}" class="img-fluid" width="256" height="256">
                @endif
                <div class="form-group">
                    <label class="control-label">Modify avatar:</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="form-group">
                    <label class="control-label">Use URL:</label>
                    <input type="text" class="form-control" name="url">
                </div>
                <button class="btn btn-outline-success" id="upload-button" type="submit">Modify avatar</button>
            </form>

            <form class="mt-3" method="post" action="{{ route('user.update.profile') }}"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="patch">
                @if($user->profile_image)
                    <img src="{{ $user->profile_image }}" width="100%">
                @endif
                <div class="form-group">
                    <label>Modify the profile picture:</label>
                    <input class="form-control" type="file" name="image">
                </div>
                <div class="form-group">
                    <label class="control-label">Use URL:</label>
                    <input type="text" class="form-control" name="url">
                </div>
                <button class="btn btn-outline-success" id="upload-button" type="submit">Edit profile image</button>
            </form>
        </div>
    @endcan
@endsection
