<?php

namespace App\Containers\AppSection\InquiryQuotation\UI\CLI\Commands;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\AppSection\InquiryQuotation\Models\ClientInquiry;
use App\Containers\AppSection\InquiryQuotation\Models\MwNotifications;
use App\Containers\AppSection\Tenantusers\Models\Tenantusers;
use App\Containers\AppSection\Themesettings\Models\Themesettings;
use App\Ship\Parents\Commands\ConsoleCommand;
use App\Ship\Transporters\DataTransporter;
use Log;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
use GuzzleHttp\Client;

/**
 * Class CreateAdminCommand
 *
 * @author  Johannes Schobel <johannes.schobel@googlemail.com>
 */
class FollowUpReminderCommand extends ConsoleCommand
{

    protected $signature = 'apiato:FollowUpReminder';

    protected $description = 'Inquiry Follow Up Reminder';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Follow Up Reminder Cron ...Start");
        $currentDate = date('Y-m-d');

        $check_followup_date = ClientInquiry::select('followup_date', 'inquiry_code', 'created_by')->where('is_active', 1)
            ->whereNotNull('followup_date')
            ->where('followup_date', '>=', $currentDate)
            ->get();

        if (!empty($check_followup_date) && count($check_followup_date) >= 1) {

            for ($i = 0; $i < count($check_followup_date); $i++) {

                $followup_date = Carbon::parse($check_followup_date[$i]->followup_date);

                $one_day_before_followup = $followup_date->copy()->subDay()->toDateString();  // 1 day before Follow Up Date

                if ($currentDate == $one_day_before_followup) {


                    $super_admin = Tenantusers::select('id')->where('role_id', 1)->first();
                    if ($check_followup_date[$i]->created_by != $super_admin->id) {
                        $send_to_created_by = [
                            'user_to_notify' => $check_followup_date[$i]->created_by,
                            'user_who_fired_event' => $check_followup_date[$i]->created_by,
                            'message' => 'Attention: The Followup Date for the given Inquiry "' . $check_followup_date[$i]->inquiry_code . '" is on, ' . $check_followup_date[$i]->followup_date . '.',
                            'is_seen' => 0,
                            'module' => "Inquiry",
                        ];

                        $existingNotification = MwNotifications::where('user_to_notify', $check_followup_date[$i]->created_by)
                            ->where('module', 'Inquiry')
                            ->whereDate('created_at', '=', now()->toDateString())
                            ->first();
                        if (!$existingNotification) {
                            $noti_to_created_by = MwNotifications::create($send_to_created_by);
                        }
                    }


                    $send_to_super_admin = [
                        'user_to_notify' => $super_admin->id,
                        'user_who_fired_event' => $check_followup_date[$i]->created_by,
                        'message' => 'Attention: The Followup Date for the given Inquiry "' . $check_followup_date[$i]->inquiry_code . '" is on, ' . $check_followup_date[$i]->followup_date . '.',
                        'is_seen' => 0,
                        'module' => "Inquiry",
                    ];

                    $existingNotification = MwNotifications::where('user_to_notify', $super_admin->id)
                        ->where('module', 'Inquiry')
                        ->whereDate('created_at', '=', now()->toDateString())
                        ->first();

                    if (!$existingNotification) {
                        $noti_to_super_admin = MwNotifications::create($send_to_super_admin);
                    }
                }
            }
        }
        Log::info("Follow Up Reminder Cron ...Finish");
    }
}
