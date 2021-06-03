@extends('layouts.app')

@section('content')

<section class="content-header">
    <h1>Change Password</h1>
    
    @if (session('status'))
        <br><div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if (session('error'))
    <br><div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
    <br><div class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>
    @endif
        
</section>

<div class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-sm-6">
                    <form method="POST" action="">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword1">Current Password</label>
                            <input type="password" name="current_password" class="form-control" id="exampleInputPassword1" placeholder="Current Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">New Password</label>
                            <input type="password" name="new_password" class="form-control" id="exampleInputPassword1" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ url('home') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection