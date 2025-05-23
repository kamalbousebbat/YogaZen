<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionReminder;
use Carbon\Carbon;
use App\Models\JobLog;


class DailyTaskScheduler extends Command
{
    protected $signature = 'tasks:daily';
    protected $description = 'Handle daily tasks: send subscription reminders and archive inactive accounts';

    public function handle()
    {
        
        $this->sendSubscriptionReminders();
        $this->archiveInactiveAccounts();
        $this->info('Daily tasks completed successfully.');
    }

    protected function sendSubscriptionReminders()
    {
        $threeDaysFromNow = Carbon::now()->addDays(3)->startOfDay();
        $subscriptions = Subscription::where('expires_at', '>=', Carbon::now()->startOfDay())
                                    ->where('expires_at', '<=', $threeDaysFromNow)
                                    ->with('student')
                                    ->get();

        foreach ($subscriptions as $subscription) {
            if ($subscription->student) {
                Mail::to($subscription->student->email)->send(new SubscriptionReminder($subscription));
                JobLog::create([
                    'action' => 'reminder_sent',
                    'entity_type' => 'subscription',
                    'entity_id' => $subscription->id,
                ]);
                $this->info("Reminder sent to {$subscription->student->email} for subscription ID {$subscription->id}");
            }
        }
    }

    protected function archiveInactiveAccounts()
    {
        $twelveMonthsAgo = Carbon::now()->subMonths(12)->startOfDay();
        $inactiveStudents = Student::where('status', 'active')
                                  ->whereDoesntHave('subscriptions', function ($query) use ($twelveMonthsAgo) {
                                      $query->where('started_at', '>=', $twelveMonthsAgo);
                                  })
                                  ->where('last_login', '<', $twelveMonthsAgo)
                                  ->get();

        foreach ($inactiveStudents as $student) {
            $student->update(['status' => 'archived']);
            JobLog::create([
                'action' => 'account_archived',
                'entity_type' => 'student',
                'entity_id' => $student->id,
            ]);
            $this->info("Archived account for student ID {$student->id}");
        }
    }
}
