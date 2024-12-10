<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Services\OrderAssignmentService;

class AssignOrderToDeliveryBoy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign orders to available delivery boys';

    protected $orderAssignmentService;

    public function __construct(OrderAssignmentService $orderAssignmentService)
    {
        parent::__construct();
        $this->orderAssignmentService = $orderAssignmentService;
    }

    public function handle()
    {
        $this->info('Starting the order assignment process...');

        try {
            $this->orderAssignmentService->assignOrders();
            $this->info('Orders have been assigned successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
            Log::error('Error in AssignOrderToDeliveryBoy: ' . $e->getMessage());
        }
    }
}
