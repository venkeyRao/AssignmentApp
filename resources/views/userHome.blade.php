@extends('layout')

@section('content')

<div class="box box-default">
	<div class="box-header with-border">
		<h3 class="box-title">Search Friends</h3>
	</div>
	<div class="box-body">
		<form action="{{ URL::Route('userSearchFriend') }}" method="post">
			{{ csrf_field() }}
			<div class="input-group">
				<input type="text" name="searchFriend" id="searchFriend" class="form-control" placeholder="Search Friends...">
				<span class="input-group-btn">
					<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form>
	</div>
</div>
@if(isset($searchData))
@if(count($searchData) != 0)
@foreach($searchData as $key)
<div class="box box-default">
	<div class="box-header with-border">
	  <h3 class="box-title">Name : {{$key->name}}</h3><br>
	  <h3 class="box-title">Email : {{$key->email}}</h3>
	</div>
	<div class="box-body">
	@if(!in_array($key->id, $myAllFriendsId))
	<button type="button" data-id="{{$key->id}}" class="btn btn-success addFriend">Add Friend</button>
	@endif
	<form action="/viewProfile/{{$key->id}}" style="display: inline;">
		<button type="submit" class="btn btn-default">View Profile</button>
	</form>
	  
	</div>
</div>
@endforeach      	
@endif
@endif


@if(!isset($searchData))
<div class="box box-default">
    <div class="box-header with-border">
      <i class="fa  fa-user"></i>

      <h3 class="box-title">Friend Requests</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    @if(count($friendRequests) != 0)
		@foreach($friendRequests as $key)	
            <div class="callout callout-info">
	        <h4>New Friend Request from {{$key['name']}}</h4>
		       	<button type="button" data-id="{{$key['requestId']}}" class="btn btn-success acceptRequest">Accept</button>
		       	<button type="button" data-id="{{$key['requestId']}}" class="btn btn-danger rejectRequest">Reject</button>
		       	<form action="/viewProfile/{{$key['id']}}" style="display: inline;">
				<button type="submit" class="btn btn-default">View Profile</button>
				</form>
      		</div>
      	@endforeach 
  	@else
  		<div class="alert alert-info alert-dismissible">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	        <h5><i class="icon fa fa-info"></i> No New Requests!</h5>
	    </div>  	
	@endif
    <!-- /.box-body -->
	</div>    
      
</div>   
@endif	

@stop