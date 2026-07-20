<?php

namespace App\Http\Controllers;
use App\Services\ParticipationService;
use App\Models\Transaction1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $request->validate([
            'pin'  => 'required|digits:4',
            'cart' => 'required|array',
            'total'=> 'required|numeric|min:1'
        ]);

        $user = Auth::user();

        // 1. Get bank account
        $bankAccount = DB::table('bank_accounts')
            ->where('student_id', $user->id)
            ->first();

        if (!$bankAccount) {
            return response()->json([
                'message' => 'Bank account not found'
            ], 404);
        }

        // 2. PIN check (PLAIN comparison)
        if ($request->pin != $bankAccount->card_pin) {
            return response()->json([
                'message' => 'Invalid PIN'
            ], 422);
        }

        // 3. Balance check
        $latestTxn = Transaction1::where('user_id', $user->id)
        ->latest('id') // or latest('created_at') if you track timestamps
        ->first();
        $lastBalance = $latestTxn ? $latestTxn->balance : 0;
        /*if ($lastBalance < $request->total) {
            return response()->json([
                'message' => 'Insufficient balance'
            ], 422);
        }
        if ($lastBalance < $request->total) {
            return response()->json([
                'status'             => false,
                'message'            => 'Insufficient balance',
                'available_balance'  => round($lastBalance, 2),
                'required_amount'    => round($request->total, 2),
                'short_by'           => round($request->total - $lastBalance, 2),
            ], 422);
        }*/
        if ($lastBalance < $request->total) {
           return response()->json([
                'status'  => false,
                'message' => 'Insufficient balance. Your available balance is ' 
                            . number_format($lastBalance, 2) 
                            . ' Z. Required amount is ' 
                            . number_format($request->total, 2) 
                            . ' Z.'
            ], 422);

        }
        /*if ($bankAccount->primary_savings_account_amount < $request->total) {
            return response()->json([
                'message' => 'Insufficient balance'
            ], 422);
        }*/

        DB::beginTransaction();

        try {
            // ✅ Authoritative balance re-check under row lock — the check
            // above happened before the transaction opened, so it can't
            // prevent two concurrent orders from racing. This re-read with
            // lockForUpdate() is the one that actually protects the balance.
            $runningBalance = \App\Services\BalanceService::lockedBalance($user->id);

            if ($runningBalance < $request->total) {
                throw new \Exception('Insufficient balance');
            }

            // 4. Deduct balance
            /*DB::table('bank_accounts')
                ->where('id', $bankAccount->id)
                ->update([
                    'primary_savings_account_amount' => $bankAccount->primary_savings_account_amount - $request->total,
                    'updated_at' => now()
                ]);*/

            // 5. Create order
            $orderId = DB::table('orders')->insertGetId([
                'user_id'    => $user->id,
                'total'      => $request->total,
                'status'     => 'paid',
                'created_at'=> now(),
                'updated_at'=> now(),
            ]);
            // 6. Order items
            foreach ($request->cart as $item) {
                 $itemSubtotal = $item['price'] * $item['quantity'];

                $runningBalance -= $itemSubtotal;

                if ($runningBalance < 0) {
                    throw new \Exception('Insufficient balance');
                }
                DB::table('order_items')->insert([
                    'order_id'  => $orderId,
                    'sid'  => $user->sid,
                    'name'      => $item['name'],
                    'price'     => $item['price'],
                    'qty'       => $item['quantity'],
                    'subtotal'  => $item['price'] * $item['quantity'],
                    'type'  => $item['type'],
                    'category'  => $item['category'],
                    'created_at'=> now(),
                    'updated_at'=> now(),
                ]);

                 Transaction1::create([
                    'user_id'          => $user->id,
                    'sid'              => $user->sid,
                    'bank_account_id'  => $bankAccount->id,
                    'transaction_date' => now(),
                    'description'      => "Purchase: {$item['name']} (Order #{$orderId})",
                    'type'             => 'debit',
                    'category'         => $item['category'],
                    'amount'           => $itemSubtotal,
                    'balance'          => $runningBalance,
                    'is_penalty'       => 0,
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ]);
            }
            $lastBalance = $runningBalance;
            // 7. Clear cart session
            session()->forget('cart');

            DB::commit();
            $shopId = '1';
            app(ParticipationService::class)->award($user->id, 'shopping', $shopId);

            return response()->json([
                'status'  => true,
                'message' => 'Payment successful',
                'order_id'=> $orderId,
                'balance'  => $lastBalance
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Payment failed',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
    public function placeOrderActivity(Request $request)
    {
        $request->validate([
            'pin'  => 'required|digits:4',
            'cart' => 'required|array',
            'total'=> 'required|numeric|min:1'
        ]);

        $user = Auth::user();

        // 1. Get bank account
        $bankAccount = DB::table('bank_accounts')
            ->where('student_id', $user->id)
            ->first();

        if (!$bankAccount) {
            return response()->json([
                'message' => 'Bank account not found'
            ], 404);
        }

        // 2. PIN check (PLAIN comparison)
        if ($request->pin != $bankAccount->card_pin) {
            return response()->json([
                'message' => 'Invalid PIN'
            ], 422);
        }

        // 3. Balance check
        $latestTxn = Transaction1::where('user_id', $user->id)
        ->latest('id') // or latest('created_at') if you track timestamps
        ->first();
        $lastBalance = $latestTxn ? $latestTxn->balance : 0;
        /*if ($lastBalance < $request->total) {
            return response()->json([
                'message' => 'Insufficient balance'
            ], 422);
        }
        if ($lastBalance < $request->total) {
            return response()->json([
                'status'             => false,
                'message'            => 'Insufficient balance',
                'available_balance'  => round($lastBalance, 2),
                'required_amount'    => round($request->total, 2),
                'short_by'           => round($request->total - $lastBalance, 2),
            ], 422);
        }*/
        if ($lastBalance < $request->total) {
           return response()->json([
                'status'  => false,
                'message' => 'Insufficient balance. Your available balance is ' 
                            . number_format($lastBalance, 2) 
                            . ' Z. Required amount is ' 
                            . number_format($request->total, 2) 
                            . ' Z.'
            ], 422);

        }
        /*if ($bankAccount->primary_savings_account_amount < $request->total) {
            return response()->json([
                'message' => 'Insufficient balance'
            ], 422);
        }*/

        DB::beginTransaction();

        try {
            // ✅ Authoritative balance re-check under row lock — the check
            // above happened before the transaction opened, so it can't
            // prevent two concurrent orders from racing. This re-read with
            // lockForUpdate() is the one that actually protects the balance.
            $runningBalance = \App\Services\BalanceService::lockedBalance($user->id);

            if ($runningBalance < $request->total) {
                throw new \Exception('Insufficient balance');
            }

            // 4. Deduct balance
            /*DB::table('bank_accounts')
                ->where('id', $bankAccount->id)
                ->update([
                    'primary_savings_account_amount' => $bankAccount->primary_savings_account_amount - $request->total,
                    'updated_at' => now()
                ]);*/

            // 5. Create order
            $orderId = DB::table('orders')->insertGetId([
                'user_id'    => $user->id,
                'total'      => $request->total,
                'status'     => 'paid',
                'created_at'=> now(),
                'updated_at'=> now(),
            ]);
            // 6. Order items
            foreach ($request->cart as $item) {
                 $itemSubtotal = $item['price'] * $item['quantity'];

                $runningBalance -= $itemSubtotal;

                if ($runningBalance < 0) {
                    throw new \Exception('Insufficient balance');
                }
                DB::table('order_items')->insert([
                    'order_id'  => $orderId,
                    'sid'  => $user->sid,
                    'name'      => $item['name'],
                    'price'     => $item['price'],
                    'qty'       => $item['quantity'],
                    'subtotal'  => $item['price'] * $item['quantity'],
                    'type'  => $item['type'],
                    //'category'  => $item['category'],
                    'category'  => 'Wants',
                    'created_at'=> now(),
                    'updated_at'=> now(),
                ]);

                 Transaction1::create([
                    'user_id'          => $user->id,
                    'sid'              => $user->sid,
                    'bank_account_id'  => $bankAccount->id,
                    'transaction_date' => now(),
                    'description'      => "Purchase: {$item['name']} (Order #{$orderId})",
                    'type'             => 'debit',
                    //'category'         => $item['category'],
                    'category'  => 'Wants',
                    'amount'           => $itemSubtotal,
                    'balance'          => $runningBalance,
                    'is_penalty'       => 0,
                    'created_at'       => now(),
                    'updated_at'       => now(),
                ]);
            }
            $lastBalance = $runningBalance;
            // 7. Clear cart session
            session()->forget('cart');

            DB::commit();
            //$shopId = '1';
            //app(ParticipationService::class)->award($user->id, 'shopping', $shopId);
            return response()->json([
                'status'  => true,
                'message' => 'Payment successful',
                'order_id'=> $orderId,
                'balance'  => $lastBalance
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Payment failed',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
