<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use App\Services\MailService;
use Illuminate\Console\Command;

class SendMarketingMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:marketing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send marketing emails';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(MailService $mailService)
    {
        $campaigns = Campaign::future()->unscheduled()->unsent()->get();
        foreach($campaigns as $campaign) {
            $mailService->mailCampaign($campaign);
        }
        return Command::SUCCESS;
    }
}
