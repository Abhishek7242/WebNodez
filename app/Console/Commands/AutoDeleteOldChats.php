<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserChat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AutoDeleteOldChats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chats:delete-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete user chats that are older than 90 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $cutoffDate = Carbon::now()->subDays(90);

            $chats = UserChat::where('created_at', '<', $cutoffDate)->get();

            $deletedCount = 0;

            foreach ($chats as $chat) {
                // Delete all messages associated with this chat
                $chat->messages()->delete();
                // Delete the chat itself
                $chat->delete();
                $deletedCount++;
            }

            Log::info("Auto-deleted {$deletedCount} chats older than 90 days");
            $this->info("Successfully deleted {$deletedCount} old chats");
        } catch (\Exception $e) {
            Log::error('Error in auto-deleting old chats: ' . $e->getMessage());
            $this->error('Failed to delete old chats: ' . $e->getMessage());
        }
    }
}
