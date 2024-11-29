<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;
use App\Models\Client;
use App\Models\RequestRecord;

class ValidateRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;


    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        print_r($this->data);
        // Extract data
        $productId = $this->data['product_id'];
        $clientId = $this->data['client_id'];
        $quantity = $this->data['quantity'];

        // Initialize the response
        $response = [
            'valid' => true,
            'errors' => [],
        ];

        // Validate client existence
        $client = Client::find($clientId);
        if (!$client) {
            $response['valid'] = false;
            $response['errors'][] = "Client with ID {$clientId} does not exist.";
        }

        // Validate product existence and quantity
        $product = Product::find($productId);
        if (!$product) {
            $response['valid'] = false;
            $response['errors'][] = "Product with ID {$productId} does not exist.";
        } elseif ($product && $product->stock < $quantity) {
            $response['valid'] = false;
            $response['errors'][] = "Not enough stock for Product ID {$productId}. Available: {$product->stock}.";
        }

        // Log the request in the database
        RequestRecord::create([
            'request_data' => json_encode($this->data),
            'response_data' => json_encode($response),
            'is_valid' => $response['valid'],
        ]);


    }
}
