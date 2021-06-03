<div class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-sm-6">
                    <form method="POST" action="{{ route('reset-password') }}">
                        <input type="hidden" name="user_id" value="{{$user->id}}">
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>