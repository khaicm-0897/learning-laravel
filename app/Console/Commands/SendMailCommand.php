<?php

namespace App\Console\Commands;

use App\Jobs\SendMailJob;
use Illuminate\Console\Command;
use App\Repositories\User\UserRepositoryInterface;

class SendMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-mail:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to user';

    protected $userRepository;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = $this->userRepository->getAll();
        if (!empty($users)) {
            SendMailJob::dispatch($users);
        }
    }
}
