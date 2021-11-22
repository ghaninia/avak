<?php

namespace App\Providers;

use App\Core\Services\Poll\PollService;
use App\Core\Services\User\UserService;
use Illuminate\Support\ServiceProvider;
use App\Core\Services\Poll\PollServiceInterface;
use App\Core\Services\User\UserServiceInterface;
use App\Core\Services\UserAnswer\UserAnswerService;
use App\Core\Services\GroupQuestion\GroupQuestionService;
use App\Core\Services\UserAnswer\UserAnswerServiceInterface;
use App\Core\Services\GroupQuestion\GroupQuestionServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(PollServiceInterface::class, PollService::class);
        $this->app->bind(GroupQuestionServiceInterface::class, GroupQuestionService::class);
        $this->app->bind(UserAnswerServiceInterface::class, UserAnswerService::class);
    }
}
