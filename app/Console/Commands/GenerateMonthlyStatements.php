<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\StatementGenerator;
use App\Models\BankAccount;

class GenerateMonthlyStatements extends Command
{
    protected $signature = 'statements:generate {--student_id=}';
    protected $description = 'Generate monthly bank statements for all bank account students (or single with --student_id)';

    public function handle(StatementGenerator $generator)
    {
        $studentId = $this->option('student_id');
        if ($studentId) {
            $res = $generator->generateForUser((int)$studentId, 0);
            $this->info('Generated statement for user ' . $studentId . ' (bank_statement_id: '.$res['bank_statement_id'].')');
            return 0;
        }

        $accounts = BankAccount::all();
        $count = 0;
        foreach ($accounts as $acc) {
            try {
                $result = $generator->generateForUser((int)$acc->student_id, rand(0,500) / 1.0);
                $count++;
                $this->info("Processed student {$acc->student_id} -> BS ID {$result['bank_statement_id']}");
            } catch (\Exception $e) {
                \Log::error('Statement generation error for '.$acc->student_id.': '.$e->getMessage());
                $this->error("Failed: {$acc->student_id} -- see logs");
            }
        }
        $this->info("Processed {$count} students.");
        return 0;
    }
}
