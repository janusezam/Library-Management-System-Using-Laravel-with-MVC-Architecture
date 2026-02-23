<?php

namespace App\Console\Commands;

use App\Models\BorrowTransaction;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TestOverdueQuery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test overdue query';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Today: '.Carbon::today()->toDateString());
        $this->info('---');

        $this->info('Testing transaction ID 3 fine calculation:');
        $transaction = BorrowTransaction::find(3);
        if ($transaction) {
            foreach ($transaction->borrowItems as $item) {
                $fine = $item->computeFine();
                $this->line("Item ID: {$item->id}, Status: {$item->status}, Fine: ₱{$fine}");
                $this->line("  Due Date: {$transaction->due_date}");
                $this->line("  Returned Date: {$item->returned_date}");
                $compareDate = $item->returned_date ?? Carbon::today();
                $this->line("  Compare Date: {$compareDate}");
            }
        }

        $this->info('---');
        $this->info('Overdue transactions:');
        $overdueTransactions = BorrowTransaction::query()
            ->where('due_date', '<=', Carbon::today())
            ->whereIn('status', ['active', 'partially_returned'])
            ->with('student', 'borrowItems.book')
            ->get();

        foreach ($overdueTransactions as $t) {
            $totalFine = 0;
            foreach ($t->borrowItems as $item) {
                $totalFine += $item->computeFine();
            }
            $this->line("ID: {$t->id}, Due: {$t->due_date}, Fine: ₱{$totalFine}");
        }

        $this->info('Total: '.$overdueTransactions->count());
    }
}
