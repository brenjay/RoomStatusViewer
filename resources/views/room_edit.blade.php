@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$location->full_name}}</div>
                <div class="card-body">
                    <form method="post" action='{{ route("update_room", ["room" => $location->id]) }}' enctype="multipart/form-data">
                    @csrf
                    Cleaned By:
                    <select class="form-control" name="cleaned_by">
                        @foreach(App\User::all() as $user)
                        <option value='{{$user->id}}'>{{$user->name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control" name="last_cleaned">
                        <option value='{{date('Y-m-d',strtotime("-0 days"))}}'>{{date('M d, Y',strtotime("-0 days"))}}</option>
                        <option value='{{date('Y-m-d',strtotime("-1 days"))}}'>{{date('M d, Y',strtotime("-1 days"))}}</option>
                        <option value='{{date('Y-m-d',strtotime("-2 days"))}}'>{{date('M d, Y',strtotime("-2 days"))}}</option>
                        <option value='{{date('Y-m-d',strtotime("-3 days"))}}'>{{date('M d, Y',strtotime("-3 days"))}}</option>
                    </select>
                   
    
                    <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
