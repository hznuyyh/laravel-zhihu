<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Auth;
use App\User;
use Illuminate\Http\Request;

/**
 * Class FollowersController
 * @package App\Http\Controllers
 */
class FollowersController extends Controller
{
	/**
	 * @var UserRepository
	 */

	public function __construct(UserRepository $user)
	{
		$this->user = $user;
	}
	/**
	 * @param $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function byId($id)
	{
		return User::find($id);
	}
	public function index($id)
	{
		$user = $this->byId($id);
		$followers = $user->followersUser()->pluck('follower_id')->toArray();

		if ( in_array(Auth::guard('api')->user()->id, $followers) ) {
			return response()->json(['followed' => true]);
		}

		return response()->json(['followed' => false]);

	}

	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function follow($id)
	{
		$userToFollow = $this->byId($id);
		$user = $this->byId(Auth::id());
		//echo Auth::id();
		//echo $user;
//		echo request('user');
//		echo $userToFollow;
		$followed = $user->followThisUser($userToFollow);
		//echo $userToFollow;
		//$followed = $userToFollow->followThisUser($id);
		if ( count($followed['attached']) > 0 ) {
			//$userToFollow->notify(new NewUserFollowNotification());
			$userToFollow->increment('followers_count');
			//return  response()->json(['followed' => true]);
			return back();
		}

		$userToFollow->decrement('followers_count');
		return back();
		//return response()->json(['followed' => false]);
	}
}
