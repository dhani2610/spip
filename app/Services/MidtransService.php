<?php

namespace App\Services;

use Midtrans\Snap;
use Midtrans\Transaction;
use Midtrans\Config;

class MidtransService
{
    public function __construct()
    {
        // Set up Midtrans SDK configuration
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$clientKey = config('services.midtrans.client_key');
        Config::$isProduction = config('services.midtrans.environment') === 'production';
    }

    // Fungsi untuk membuat pembayaran snap token
    public function createSnapToken($order)
    {

         // Data dummy untuk order
         $order = (object) [
            'id' => 12345,
            'total_amount' => 250000,
            'items' => [
                (object) [
                    'id' => 1,
                    'name' => 'Web Development Package',
                    'price' => 150000,
                    'quantity' => 1
                ],
                (object) [
                    'id' => 2,
                    'name' => 'SEO Optimization',
                    'price' => 100000,
                    'quantity' => 1
                ]
            ],
            'user' => (object) [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'phone' => '+628123456789'
            ]
        ];

        // Membuat transactionDetails dari data dummy
        $transactionDetails = array(
            'order_id' => $order->id,
            'gross_amount' => $order->total_amount,  // total amount of the order
        );

        // Membuat itemDetails dari data dummy
        $itemDetails = array();
        foreach ($order->items as $item) {
            $itemDetails[] = array(
                'id' => $item->id,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'name' => $item->name
            );
        }

        // Membuat customerDetails dari data dummy
        $customerDetails = array(
            'first_name' => $order->user->name,
            'email' => $order->user->email,
            'phone' => $order->user->phone,
        );


        //  real 
        // Implementasikan logika untuk membuat token Snap di sini
        $transactionDetails = array(
            'order_id' => $order->id,
            'gross_amount' => $order->total_amount,  // total amount of the order
        );

        $itemDetails = array();
        foreach ($order->items as $item) {
            $itemDetails[] = array(
                'id' => $item->id,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'name' => $item->name
            );
        }

        $customerDetails = array(
            'first_name' => $order->user->name,
            'email' => $order->user->email,
            'phone' => $order->user->phone,
        );

        $transactionData = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            $snapToken = Snap::getSnapToken($transactionData);
            return $snapToken;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    // Fungsi untuk meng-handle callback dan status transaksi
    public function handleNotification($payload)
    {
        $status = Transaction::status($payload['order_id']);
        return $status;
    }
}
