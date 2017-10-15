@extends('layout')

@section('content')

@if(isset($myAllFriends))

<div class="row">
        <div class="col-md-6">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-users"></i>
              <h3 class="box-title">Friends List</h3>
            </div>
            @foreach($myAllFriends as $key)
            <!-- /.box-header -->
            <div class="box-body">

              <div class="alert alert-info alert-dismissible">
               <div class="box box-default">
					<div class="box-header with-border">
					  <h3 class="box-title">Name : {{$key->name}}</h3><br>
					  <h3 class="box-title">Email : {{$key->email}}</h3>
					</div>
					<div class="box-body">
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