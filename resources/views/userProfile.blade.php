@extends('layout')

@section('content')

<div class="box box-default">
	<div class="box-header with-border">
	  <h3 class="box-title">Name : {{$profile->name}}</h3><br>
	  <h3 class="box-title">Email : {{$profile->email}}</h3>
	</div>
	<div class="box-body"> 
	</div>
</div>

@if(isset($mutualProfile))

<div class="row">
        <div class="col-md-6">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-users"></i>
              <h3 class="box-title">Mutual Friends</h3>
            </div>
            @foreach($mutualProfile as $key)
            <!-- /.box-header -->
            <div class="box-body">

              <div class="alert alert-info alert-dismissible">
               <div class="box box-default">
					<div class="box-header with-border">
					  <h3 class="box-title">Name : {{$key->name}}</h3><br>
					  <h3 class="box-title">Email : {{$key->email}}</h3>
					</div>
					<div class="box-body">
						@if(!in_array($key->id, $myAllFriends))
						<button type="button" data-id="{{$key->id}}" class="btn btn-success addFriend">Add Friend</button>
						@endif
						<form action="/viewProfile/{{$key->id}}" style="display: inline;">
							<button type="submit" class="btn btn-default">View Profile</button>
						</form>
					  
					</div>
				</div>
              </div>
             
            </div>
            <!-- /.box-body -->

			@endforeach 
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>     	
@endif    
      	
@stop