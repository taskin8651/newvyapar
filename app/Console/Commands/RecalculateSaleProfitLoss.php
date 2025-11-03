<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\SaleInvoice;

class RecalculateSaleProfitLoss extends Command
{
    protected $signature = 'sales:recalculate-profit-loss';
    protected $description = 'Recalculate and populate sale_profit_losses for historical invoices';

    public function handle()
    {
        $this->info('🔄 Starting recalculation of Sale Profit/Loss data...');
        $invoices = SaleInvoice::with(['items'])->get();

        if ($invoices->isEmpty()) {
            $this->warn('No invoices found.');
            return 0;
        }

        $bar = $this->output->createProgressBar($invoices->count());
        $bar->start();

        foreach ($invoices as $invoice) {
            $totalPurchase = 0;
            $totalSale = 0;

            // 🔹 Calculate totals + prepare composition
            $composition = $invoice->items->map(function ($item) use (&$totalPurchase, &$totalSale) {
                $qty = $item->pivot->qty ?? 0;
                $purchase = ($item->pivot->purchase_price ?? 0) * $qty;
                $sale = ($item->pivot->price ?? 0) * $qty;

                $totalPurchase += $purchase;
                $totalSale += $sale;

                return [
                    'product_id' => $item->id,
                    'product_name' => $item->name ?? null,
                    'qty' => $qty,
                    'purchase_price' => round($item->pivot->purchase_price ?? 0, 2),
                    'sale_price' => round($item->pivot->price ?? 0, 2),
                    'total_purchase' => round($purchase, 2),
                    'total_sale' => round($sale, 2),
                ];
            })->toArray();

            // 🔹 Profit/Loss calculation
            $profitLoss = round($totalSale - $totalPurchase, 2);
            $isProfit = $profitLoss >= 0;

            // 🔹 Insert or update using DB facade (no model dependency)
            DB::table('sale_profit_losses')->updateOrInsert(
                ['sale_invoice_id' => $invoice->id],
                [
                    'select_customer_id' => $invoice->select_customer_id,
                    'main_cost_center_id' => $invoice->main_cost_center_id,
                    'sub_cost_center_id' => $invoice->sub_cost_center_id,
                    'total_purchase_value' => round($totalPurchase, 2),
                    'total_sale_value' => round($totalSale, 2),
                    'profit_loss_amount' => abs($profitLoss),
                    'is_profit' => $isProfit,
                    'composition_json' => json_encode($composition),
                    'created_by_id' => $invoice->created_by_id ?? null,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info('✅ Profit/Loss recalculation complete!');

        return 0;
    }
}
