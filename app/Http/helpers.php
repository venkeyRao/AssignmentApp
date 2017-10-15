<?php

use App\FriendRequest;

function getUserFriendsIds($userId){

	$myRequests =  FriendRequest::where('userId', $userId)->where('status', 1)->pluck('friendId')->toArray();

    $myAcceptedRequests =  FriendRequest::where('friendId', $userId)->where('status', 1)->pluck('userId')->toArray();

    $myAllFriendsId = array_unique(array_merge($myRequests, $myAcceptedRequests));

    return $myAllFriendsId;

}


?>