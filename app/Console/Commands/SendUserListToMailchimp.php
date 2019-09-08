<?php

namespace App\Console\Commands;

use App\UserList;
use Carbon\Carbon;
use Illuminate\Console\Command;
use DrewM\MailChimp\MailChimp;

class SendUserListToMailchimp extends Command
{
    public const SUBSCRIBED = 'subscribed';
    public const UNSUBSCRIBED = 'unsubscribed';

    /**
     * @var array
     */
    protected $status_list = [
        self::UNSUBSCRIBED,
        self::SUBSCRIBED,
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mailchimp:send {listId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send user list to mailchimp';

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
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        $api_key = config('mailchimp.api_key');

        if (!$api_key) {
            $this->error('MAILCHIMP_API_KEY is required');

            return false;
        }

        $mailchimp = new MailChimp($api_key);
        $list_id   = $this->argument('listId'); // b9e1aff289

        $user_list = UserList::all();

        foreach ($user_list as $user) {
            $member_id = md5(strtolower($user->email));
            $result    = $mailchimp->get("lists/$list_id/members/$member_id");

            switch ($result['status']) {
                case self::SUBSCRIBED:
                case self::UNSUBSCRIBED:
                    $status = $this->status_list[$user->subscribed];

                    if ($status !== $result['status']) {
                        $data = $mailchimp->patch("lists/$list_id/members/$member_id", [
                            'status' => $status,
                        ]);

                        $this->info("Email ({$user->email}): status changed to {$status}");

                        $user->synchronized_at = Carbon::now()->toDateTimeString();

                        $user->save();
                    } else {
                        $this->info("Email ({$user->email}): not changed");
                    }

                    break;
                case 404:
                    $data = $mailchimp->post("lists/$list_id/members", [
                        'email_address' => $user->email,
                        'status'        => $this->status_list[$user->subscribed],
                        'merge_fields'  => [
                            'FNAME' => $user->name,
                            'LNAME' => $user->lastname,
                        ],
                    ]);

                    if (!isset($data['title'])) {
                        $this->info("Email ({$user->email}): added to list");
                    } else {
                        $this->info("$data[title]. $data[detail]" );

                        $user->synchronized_at = Carbon::now()->toDateTimeString();

                        $user->save();
                    }
                    break;
                default:
                    $this->info($result['detail']);
            }
        }
    }
}

