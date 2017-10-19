<?php

namespace Modules\User\Events\Handlers;

use Modules\User\Events\UserHasRegistered;
use Modules\User\Repositories\UserTokenRepository;

class CreateApiToken
{
    /**
     * @var UserTokenRepository
     */
    private $userTokenRepository;

    public function __construct(UserTokenRepository $userTokenRepository)
    {
        $this->userTokenRepository = $userTokenRepository;
    }

    public function handle(UserHasRegistered $event)
    {
        $this->userTokenRepository->generateFor($event->user->id);
    }
}
