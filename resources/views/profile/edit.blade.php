@extends('layouts.bloglayout')
@section('content')

    <form action="{{ route('profile.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="image">Profile Image</label>
            <input type="file" class="form-control" name="image" value="{{ $user->profile->image ?? '' }}">
        </div>
        <button type="submit" class="btn btn-dark">Save Changes</button>
    </form>

@endsection
