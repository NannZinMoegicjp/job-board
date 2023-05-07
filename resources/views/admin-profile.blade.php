@extends('welcome')
@section('content')
<div class="row">
        <h5 class="text-center my-3">My profile</h5>
        <form action="" method="post" class="p-2">
            <div class="col-md-6 offset-md-3 mb-2">
                <label for="userName">Name</label>
                <input type="text" name="userName" id="userName" class="form-control">
            </div>
            <div class="col-md-6 offset-md-3 mb-2">
                <label for="userEmail">Email</label>
                <input type="email" name="userEmail" id="userEmail" class="form-control" readonly disabled value="nannzinme.gicjp@gmail.com">
            </div>
            <div class="col-md-6 offset-md-3 mb-2">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control">
            </div>  
            <div class="col-md-6 offset-md-3 mb-2">               
                <button class="btn btn-primary">Save</button>
            </div>           
        </form>
    </div>
@endsection