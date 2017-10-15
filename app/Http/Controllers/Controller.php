<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Request;
use Validator;
use App\User;
use App\FriendRequest;
use Hash;
use Auth;
use Session;
use Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(){
    	return view('homePage');
    }

    public function registerUser(){

    	$userFormData =  Request::all(); //dd($userFormData);

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
            'confirmPassword' => 'required|same:password',
            'name' => 'required'
        ]; 
        
        $validation = Validator::make($userFormData, $rules);   
        
        
        if($validation->fails())
        {
            $error_messages = $validation->messages()->first();
            return redirect()->back()->with('errorMessage', $error_messages);
        }

        $user = User::where('email', $userFormData['email'])->first();

       	if(!isset($user)){

       		$data['name'] = $userFormData['name'];
        	$data['email'] = $userFormData['email'];
        	$data['password'] = Hash::make($userFormData['password']);

       		$user = User::create($data);

       		return redirect()->back()->with('success', 'Successfully Registered!! Please Login.');

       	}else{
       		return redirect()->back()->with('errorMessage', 'Email already Registered!! Please Login.');
       	}
        
    }

    public function loginUser(){

    	$userLoginData =  Request::all(); //dd($userLoginData);

        $rules = [
            'loginEmail' => 'required|email',
            'loginPass' => 'required'
        ]; 
        
        $validation = Validator::make($userLoginData, $rules);   
        
        
        if($validation->fails())
        {
            $error_messages = $validation->messages()->first();
            return redirect()->back()->with('errorMessage', $error_messages);
        }

        $user = User::where('email', $userLoginData['loginEmail'])->first();

       	if(isset($user)){

       		if (Auth::attempt(['email' => $userLoginData['loginEmail'], 'password' => $userLoginData['loginPass']])) {
       			return redirect()->route('userHome');
        	}else{
        		return redirect()->back()->with('errorMessage', 'Invalid Password!! Please try again.');
        	}

       	}else{
       		return redirect()->back()->with('errorMessage', 'User not found!! Please Register.');
       	}
        
    }

    public function userHome(){

       	if(Auth::check()){

       		$user = Auth::user();

          $friendRequests = FriendRequest::where('friendId', $user->id)->where('status', 0)->get();

          $allRequests = array();

          foreach ($friendRequests as $key) {
            $data = array();
            $friend = User::where('id', $key->userId)->first();
            $data['name'] = $friend->name;
            $data['id'] = $key->friendId;
            $data['requestId'] = $key->id;
            array_push($allRequests, $data);
          }
          
          if(Session::has('userSearchData')){
            $searchData = Session::get('userSearchData');
            Session::forget('userSearchData');

            //HELPER FUNCTION getUserFriendsIds CREATED FOR REUSEABLE CODE

            $myAllFriendsId = getUserFriendsIds($user->id);
            
            return view('userHome', ['title' => 'Dashboard', 'userData' => $user, 'searchData' => $searchData, 'friendRequests' => $allRequests, 'myAllFriendsId' => $myAllFriendsId]);

          }else{

            return view('userHome', ['title' => 'Dashboard', 'userData' => $user, 'friendRequests' => $allRequests]);
          }       		

       	}else{
       		return redirect()->route('login');
       	}
        
    }

    public function userLogout(){

       	Auth::logout();
       	
       	return redirect()->route('login');
       	    
    }

    public function getUserNames(){

      $myId = Auth::id();

      $users = User::where('id', '!=', $myId)->pluck('name')->toArray();

      return response()->json($users);
    }

    public function userSearchFriend(){

      $name =  Request::input('searchFriend');
      $myId = Auth::id();

      $users = User::where('name', 'like', '%'.$name.'%')->where('id', '!=', $myId)->get();

      Session::forget('userSearchData');

      Session::put('userSearchData', $users);

      return redirect()->route('userHome');

    }

    public function sendFriendRequest(){

      $friendId =  Request::input('friendId');

      //Log::info($friendId);

      $myId = Auth::id();

      $friendRequest = new FriendRequest;
      $friendRequest->userId = $myId;
      $friendRequest->friendId = $friendId;
      $friendRequest->save();

      return response()->json($friendId);

    }

    public function acceptFriendRequest(){

      $id =  Request::input('id');

      $request = FriendRequest::where('id', $id)->first();
      $request->status = 1; // status 1 represents accepted
      $request->save();

      return response()->json($id);

    }


    public function rejectFriendRequest(){

      $id =  Request::input('id');

      $request = FriendRequest::where('id', $id)->first();
      $request->status = 2; // status 2 represents rejected
      $request->save();

      return response()->json($id);

    }

    public function viewProfile($id){

      $profile = User::where('id', $id)->first();

      $currentUser = Auth::user();

      $myAllFriends = getUserFriendsIds($currentUser->id);

      $profileRequests =  FriendRequest::where('userId', $id)->where('status', 1)->pluck('friendId')->toArray();

      $profileAcceptedRequests =  FriendRequest::where('friendId', $id)->where('status', 1)->pluck('userId')->toArray();

      $profileAllFriends = array_unique(array_merge($profileRequests, $profileAcceptedRequests));

      $mutualFriendsId = array_values(array_intersect($myAllFriends, $profileAllFriends));


      $mutualProfile = User::whereIn('id', $mutualFriendsId)->get();

      return view('userProfile', ['title' => 'Profile', 'profile' => $profile, 'mutualProfile' => $mutualProfile,'userData' => $currentUser, 'myAllFriends' => $myAllFriends]);
     
    }

    public function myFriends(){

      $currentUser = Auth::user();

      $myAllFriendsId = getUserFriendsIds($currentUser->id);

      $myAllFriends =  User::whereIn('id', $myAllFriendsId)->get();

      return view('myFriends', ['title' => 'Friends List', 'myAllFriends' => $myAllFriends, 'userData' => $currentUser]);
     
    }
}
