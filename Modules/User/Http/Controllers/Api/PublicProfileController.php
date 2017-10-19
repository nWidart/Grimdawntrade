<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Contracts\Authentication;
use Modules\User\Http\Requests\UpdateProfileRequest;
use Modules\User\Http\Requests\UpdatePublicProfileRequest;
use Modules\User\Repositories\UserRepository;
use Modules\User\Traits\CanFindUserWithBearerToken;
use Modules\User\Transformers\UserProfileTransformer;

class PublicProfileController extends Controller
{
    use CanFindUserWithBearerToken;
    /**
     * @var UserRepository
     */
    private $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function findCurrentUser(Request $request)
    {
        return new UserProfileTransformer($this->findUserWithBearerToken($request->header('Authorization')));
    }

    public function update(UpdatePublicProfileRequest $request)
    {
        $user = $this->findUserWithBearerToken($request->header('Authorization'));

        $this->user->update($user, $request->only(['display_name', 'steam_profile_link']));

        return response()->json([
            'errors' => false,
            'message' => trans('user::messages.profile updated'),
        ]);
    }
}
