<?php

namespace App\Console\Commands;

use App\Models\Stock;
use Illuminate\Console\Command;

class StockUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the stock';

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
    public function handle()
    {
        Stock::query()->update(['in_stock_date' => now()->format('Y-m-d')]); // Example query

        $this->info('Record updated successfully!');
    }
}
