<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 23,
                'title' => 'add_business_create',
            ],
            [
                'id'    => 24,
                'title' => 'add_business_edit',
            ],
            [
                'id'    => 25,
                'title' => 'add_business_show',
            ],
            [
                'id'    => 26,
                'title' => 'add_business_delete',
            ],
            [
                'id'    => 27,
                'title' => 'add_business_access',
            ],
            [
                'id'    => 28,
                'title' => 'party_access',
            ],
            [
                'id'    => 29,
                'title' => 'party_detail_create',
            ],
            [
                'id'    => 30,
                'title' => 'party_detail_edit',
            ],
            [
                'id'    => 31,
                'title' => 'party_detail_show',
            ],
            [
                'id'    => 32,
                'title' => 'party_detail_delete',
            ],
            [
                'id'    => 33,
                'title' => 'party_detail_access',
            ],
            [
                'id'    => 34,
                'title' => 'loyalty_point_create',
            ],
            [
                'id'    => 35,
                'title' => 'loyalty_point_edit',
            ],
            [
                'id'    => 36,
                'title' => 'loyalty_point_show',
            ],
            [
                'id'    => 37,
                'title' => 'loyalty_point_delete',
            ],
            [
                'id'    => 38,
                'title' => 'loyalty_point_access',
            ],
            [
                'id'    => 39,
                'title' => 'whatsapp_connect_create',
            ],
            [
                'id'    => 40,
                'title' => 'whatsapp_connect_edit',
            ],
            [
                'id'    => 41,
                'title' => 'whatsapp_connect_show',
            ],
            [
                'id'    => 42,
                'title' => 'whatsapp_connect_delete',
            ],
            [
                'id'    => 43,
                'title' => 'whatsapp_connect_access',
            ],
            [
                'id'    => 44,
                'title' => 'item_access',
            ],
            [
                'id'    => 45,
                'title' => 'add_item_create',
            ],
            [
                'id'    => 46,
                'title' => 'add_item_edit',
            ],
            [
                'id'    => 47,
                'title' => 'add_item_show',
            ],
            [
                'id'    => 48,
                'title' => 'add_item_delete',
            ],
            [
                'id'    => 49,
                'title' => 'add_item_access',
            ],
            [
                'id'    => 50,
                'title' => 'master_data_access',
            ],
            [
                'id'    => 51,
                'title' => 'unit_create',
            ],
            [
                'id'    => 52,
                'title' => 'unit_edit',
            ],
            [
                'id'    => 53,
                'title' => 'unit_show',
            ],
            [
                'id'    => 54,
                'title' => 'unit_delete',
            ],
            [
                'id'    => 55,
                'title' => 'unit_access',
            ],
            [
                'id'    => 56,
                'title' => 'category_create',
            ],
            [
                'id'    => 57,
                'title' => 'category_edit',
            ],
            [
                'id'    => 58,
                'title' => 'category_show',
            ],
            [
                'id'    => 59,
                'title' => 'category_delete',
            ],
            [
                'id'    => 60,
                'title' => 'category_access',
            ],
            [
                'id'    => 61,
                'title' => 'tax_rate_create',
            ],
            [
                'id'    => 62,
                'title' => 'tax_rate_edit',
            ],
            [
                'id'    => 63,
                'title' => 'tax_rate_show',
            ],
            [
                'id'    => 64,
                'title' => 'tax_rate_delete',
            ],
            [
                'id'    => 65,
                'title' => 'tax_rate_access',
            ],
            [
                'id'    => 66,
                'title' => 'sale_access',
            ],
            [
                'id'    => 67,
                'title' => 'sale_invoice_create',
            ],
            [
                'id'    => 68,
                'title' => 'sale_invoice_edit',
            ],
            [
                'id'    => 69,
                'title' => 'sale_invoice_show',
            ],
            [
                'id'    => 70,
                'title' => 'sale_invoice_delete',
            ],
            [
                'id'    => 71,
                'title' => 'sale_invoice_access',
            ],
            [
                'id'    => 72,
                'title' => 'estimate_quotation_create',
            ],
            [
                'id'    => 73,
                'title' => 'estimate_quotation_edit',
            ],
            [
                'id'    => 74,
                'title' => 'estimate_quotation_show',
            ],
            [
                'id'    => 75,
                'title' => 'estimate_quotation_delete',
            ],
            [
                'id'    => 76,
                'title' => 'estimate_quotation_access',
            ],
            [
                'id'    => 77,
                'title' => 'proforma_invoice_create',
            ],
            [
                'id'    => 78,
                'title' => 'proforma_invoice_edit',
            ],
            [
                'id'    => 79,
                'title' => 'proforma_invoice_show',
            ],
            [
                'id'    => 80,
                'title' => 'proforma_invoice_delete',
            ],
            [
                'id'    => 81,
                'title' => 'proforma_invoice_access',
            ],
            [
                'id'    => 82,
                'title' => 'purchase_access',
            ],
            [
                'id'    => 83,
                'title' => 'bank_access',
            ],
            [
                'id'    => 84,
                'title' => 'bank_account_create',
            ],
            [
                'id'    => 85,
                'title' => 'bank_account_edit',
            ],
            [
                'id'    => 86,
                'title' => 'bank_account_show',
            ],
            [
                'id'    => 87,
                'title' => 'bank_account_delete',
            ],
            [
                'id'    => 88,
                'title' => 'bank_account_access',
            ],
            [
                'id'    => 89,
                'title' => 'deposit_withdraw_access',
            ],
            [
                'id'    => 90,
                'title' => 'bank_to_cash_create',
            ],
            [
                'id'    => 91,
                'title' => 'bank_to_cash_edit',
            ],
            [
                'id'    => 92,
                'title' => 'bank_to_cash_show',
            ],
            [
                'id'    => 93,
                'title' => 'bank_to_cash_delete',
            ],
            [
                'id'    => 94,
                'title' => 'bank_to_cash_access',
            ],
            [
                'id'    => 95,
                'title' => 'cash_to_bank_create',
            ],
            [
                'id'    => 96,
                'title' => 'cash_to_bank_edit',
            ],
            [
                'id'    => 97,
                'title' => 'cash_to_bank_show',
            ],
            [
                'id'    => 98,
                'title' => 'cash_to_bank_delete',
            ],
            [
                'id'    => 99,
                'title' => 'cash_to_bank_access',
            ],
            [
                'id'    => 100,
                'title' => 'bank_to_bank_create',
            ],
            [
                'id'    => 101,
                'title' => 'bank_to_bank_edit',
            ],
            [
                'id'    => 102,
                'title' => 'bank_to_bank_show',
            ],
            [
                'id'    => 103,
                'title' => 'bank_to_bank_delete',
            ],
            [
                'id'    => 104,
                'title' => 'bank_to_bank_access',
            ],
            [
                'id'    => 105,
                'title' => 'adjust_bank_balance_create',
            ],
            [
                'id'    => 106,
                'title' => 'adjust_bank_balance_edit',
            ],
            [
                'id'    => 107,
                'title' => 'adjust_bank_balance_show',
            ],
            [
                'id'    => 108,
                'title' => 'adjust_bank_balance_delete',
            ],
            [
                'id'    => 109,
                'title' => 'adjust_bank_balance_access',
            ],
            [
                'id'    => 110,
                'title' => 'cash_in_hand_create',
            ],
            [
                'id'    => 111,
                'title' => 'cash_in_hand_edit',
            ],
            [
                'id'    => 112,
                'title' => 'cash_in_hand_show',
            ],
            [
                'id'    => 113,
                'title' => 'cash_in_hand_delete',
            ],
            [
                'id'    => 114,
                'title' => 'cash_in_hand_access',
            ],
            [
                'id'    => 115,
                'title' => 'purchase_bill_create',
            ],
            [
                'id'    => 116,
                'title' => 'purchase_bill_edit',
            ],
            [
                'id'    => 117,
                'title' => 'purchase_bill_show',
            ],
            [
                'id'    => 118,
                'title' => 'purchase_bill_delete',
            ],
            [
                'id'    => 119,
                'title' => 'purchase_bill_access',
            ],
            [
                'id'    => 120,
                'title' => 'stock_access',
            ],
            [
                'id'    => 121,
                'title' => 'current_stock_create',
            ],
            [
                'id'    => 122,
                'title' => 'current_stock_edit',
            ],
            [
                'id'    => 123,
                'title' => 'current_stock_show',
            ],
            [
                'id'    => 124,
                'title' => 'current_stock_delete',
            ],
            [
                'id'    => 125,
                'title' => 'current_stock_access',
            ],
            [
                'id'    => 126,
                'title' => 'stocks_report_create',
            ],
            [
                'id'    => 127,
                'title' => 'stocks_report_edit',
            ],
            [
                'id'    => 128,
                'title' => 'stocks_report_show',
            ],
            [
                'id'    => 129,
                'title' => 'stocks_report_delete',
            ],
            [
                'id'    => 130,
                'title' => 'stocks_report_access',
            ],
            [
                'id'    => 131,
                'title' => 'stock_history_create',
            ],
            [
                'id'    => 132,
                'title' => 'stock_history_edit',
            ],
            [
                'id'    => 133,
                'title' => 'stock_history_show',
            ],
            [
                'id'    => 134,
                'title' => 'stock_history_delete',
            ],
            [
                'id'    => 135,
                'title' => 'stock_history_access',
            ],
            [
                'id'    => 136,
                'title' => 'payment_out_create',
            ],
            [
                'id'    => 137,
                'title' => 'payment_out_edit',
            ],
            [
                'id'    => 138,
                'title' => 'payment_out_show',
            ],
            [
                'id'    => 139,
                'title' => 'payment_out_delete',
            ],
            [
                'id'    => 140,
                'title' => 'payment_out_access',
            ],
            [
                'id'    => 141,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 142,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 143,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 144,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 145,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 146,
                'title' => 'expense_access',
            ],
            [
                'id'    => 147,
                'title' => 'expense_list_create',
            ],
            [
                'id'    => 148,
                'title' => 'expense_list_edit',
            ],
            [
                'id'    => 149,
                'title' => 'expense_list_show',
            ],
            [
                'id'    => 150,
                'title' => 'expense_list_delete',
            ],
            [
                'id'    => 151,
                'title' => 'expense_list_access',
            ],
            [
                'id'    => 152,
                'title' => 'purchase_order_create',
            ],
            [
                'id'    => 153,
                'title' => 'purchase_order_edit',
            ],
            [
                'id'    => 154,
                'title' => 'purchase_order_show',
            ],
            [
                'id'    => 155,
                'title' => 'purchase_order_delete',
            ],
            [
                'id'    => 156,
                'title' => 'purchase_order_access',
            ],
            [
                'id'    => 157,
                'title' => 'report_access',
            ],
            [
                'id'    => 158,
                'title' => 'transaction_report_access',
            ],
            [
                'id'    => 159,
                'title' => 'sale_report_create',
            ],
            [
                'id'    => 160,
                'title' => 'sale_report_edit',
            ],
            [
                'id'    => 161,
                'title' => 'sale_report_show',
            ],
            [
                'id'    => 162,
                'title' => 'sale_report_delete',
            ],
            [
                'id'    => 163,
                'title' => 'sale_report_access',
            ],
            [
                'id'    => 164,
                'title' => 'purchase_report_create',
            ],
            [
                'id'    => 165,
                'title' => 'purchase_report_edit',
            ],
            [
                'id'    => 166,
                'title' => 'purchase_report_show',
            ],
            [
                'id'    => 167,
                'title' => 'purchase_report_delete',
            ],
            [
                'id'    => 168,
                'title' => 'purchase_report_access',
            ],
            [
                'id'    => 169,
                'title' => 'day_book_create',
            ],
            [
                'id'    => 170,
                'title' => 'day_book_edit',
            ],
            [
                'id'    => 171,
                'title' => 'day_book_show',
            ],
            [
                'id'    => 172,
                'title' => 'day_book_delete',
            ],
            [
                'id'    => 173,
                'title' => 'day_book_access',
            ],
            [
                'id'    => 174,
                'title' => 'all_transaction_create',
            ],
            [
                'id'    => 175,
                'title' => 'all_transaction_edit',
            ],
            [
                'id'    => 176,
                'title' => 'all_transaction_show',
            ],
            [
                'id'    => 177,
                'title' => 'all_transaction_delete',
            ],
            [
                'id'    => 178,
                'title' => 'all_transaction_access',
            ],
            [
                'id'    => 179,
                'title' => 'profit_loss_create',
            ],
            [
                'id'    => 180,
                'title' => 'profit_loss_edit',
            ],
            [
                'id'    => 181,
                'title' => 'profit_loss_show',
            ],
            [
                'id'    => 182,
                'title' => 'profit_loss_delete',
            ],
            [
                'id'    => 183,
                'title' => 'profit_loss_access',
            ],
            [
                'id'    => 184,
                'title' => 'bill_wise_profit_create',
            ],
            [
                'id'    => 185,
                'title' => 'bill_wise_profit_edit',
            ],
            [
                'id'    => 186,
                'title' => 'bill_wise_profit_show',
            ],
            [
                'id'    => 187,
                'title' => 'bill_wise_profit_delete',
            ],
            [
                'id'    => 188,
                'title' => 'bill_wise_profit_access',
            ],
            [
                'id'    => 189,
                'title' => 'balance_sheet_create',
            ],
            [
                'id'    => 190,
                'title' => 'balance_sheet_edit',
            ],
            [
                'id'    => 191,
                'title' => 'balance_sheet_show',
            ],
            [
                'id'    => 192,
                'title' => 'balance_sheet_delete',
            ],
            [
                'id'    => 193,
                'title' => 'balance_sheet_access',
            ],
            [
                'id'    => 194,
                'title' => 'party_report_access',
            ],
            [
                'id'    => 195,
                'title' => 'party_statement_create',
            ],
            [
                'id'    => 196,
                'title' => 'party_statement_edit',
            ],
            [
                'id'    => 197,
                'title' => 'party_statement_show',
            ],
            [
                'id'    => 198,
                'title' => 'party_statement_delete',
            ],
            [
                'id'    => 199,
                'title' => 'party_statement_access',
            ],
            [
                'id'    => 200,
                'title' => 'party_wise_profit_loss_create',
            ],
            [
                'id'    => 201,
                'title' => 'party_wise_profit_loss_edit',
            ],
            [
                'id'    => 202,
                'title' => 'party_wise_profit_loss_show',
            ],
            [
                'id'    => 203,
                'title' => 'party_wise_profit_loss_delete',
            ],
            [
                'id'    => 204,
                'title' => 'party_wise_profit_loss_access',
            ],
            [
                'id'    => 205,
                'title' => 'all_party_create',
            ],
            [
                'id'    => 206,
                'title' => 'all_party_edit',
            ],
            [
                'id'    => 207,
                'title' => 'all_party_show',
            ],
            [
                'id'    => 208,
                'title' => 'all_party_delete',
            ],
            [
                'id'    => 209,
                'title' => 'all_party_access',
            ],
            [
                'id'    => 210,
                'title' => 'party_report_by_item_create',
            ],
            [
                'id'    => 211,
                'title' => 'party_report_by_item_edit',
            ],
            [
                'id'    => 212,
                'title' => 'party_report_by_item_show',
            ],
            [
                'id'    => 213,
                'title' => 'party_report_by_item_delete',
            ],
            [
                'id'    => 214,
                'title' => 'party_report_by_item_access',
            ],
            [
                'id'    => 215,
                'title' => 'sale_purchase_by_party_create',
            ],
            [
                'id'    => 216,
                'title' => 'sale_purchase_by_party_edit',
            ],
            [
                'id'    => 217,
                'title' => 'sale_purchase_by_party_show',
            ],
            [
                'id'    => 218,
                'title' => 'sale_purchase_by_party_delete',
            ],
            [
                'id'    => 219,
                'title' => 'sale_purchase_by_party_access',
            ],
            [
                'id'    => 220,
                'title' => 'stock_report_access',
            ],
            [
                'id'    => 221,
                'title' => 'stocks_summary_create',
            ],
            [
                'id'    => 222,
                'title' => 'stocks_summary_edit',
            ],
            [
                'id'    => 223,
                'title' => 'stocks_summary_show',
            ],
            [
                'id'    => 224,
                'title' => 'stocks_summary_delete',
            ],
            [
                'id'    => 225,
                'title' => 'stocks_summary_access',
            ],
            [
                'id'    => 226,
                'title' => 'item_report_by_party_create',
            ],
            [
                'id'    => 227,
                'title' => 'item_report_by_party_edit',
            ],
            [
                'id'    => 228,
                'title' => 'item_report_by_party_show',
            ],
            [
                'id'    => 229,
                'title' => 'item_report_by_party_delete',
            ],
            [
                'id'    => 230,
                'title' => 'item_report_by_party_access',
            ],
            [
                'id'    => 231,
                'title' => 'item_wise_profit_and_loass_create',
            ],
            [
                'id'    => 232,
                'title' => 'item_wise_profit_and_loass_edit',
            ],
            [
                'id'    => 233,
                'title' => 'item_wise_profit_and_loass_show',
            ],
            [
                'id'    => 234,
                'title' => 'item_wise_profit_and_loass_delete',
            ],
            [
                'id'    => 235,
                'title' => 'item_wise_profit_and_loass_access',
            ],
            [
                'id'    => 236,
                'title' => 'low_stock_summary_create',
            ],
            [
                'id'    => 237,
                'title' => 'low_stock_summary_edit',
            ],
            [
                'id'    => 238,
                'title' => 'low_stock_summary_show',
            ],
            [
                'id'    => 239,
                'title' => 'low_stock_summary_delete',
            ],
            [
                'id'    => 240,
                'title' => 'low_stock_summary_access',
            ],
            [
                'id'    => 241,
                'title' => 'stock_detail_create',
            ],
            [
                'id'    => 242,
                'title' => 'stock_detail_edit',
            ],
            [
                'id'    => 243,
                'title' => 'stock_detail_show',
            ],
            [
                'id'    => 244,
                'title' => 'stock_detail_delete',
            ],
            [
                'id'    => 245,
                'title' => 'stock_detail_access',
            ],
            [
                'id'    => 246,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 247,
                'title' => 'expense_report_list_create',
            ],
            [
                'id'    => 248,
                'title' => 'expense_report_list_edit',
            ],
            [
                'id'    => 249,
                'title' => 'expense_report_list_show',
            ],
            [
                'id'    => 250,
                'title' => 'expense_report_list_delete',
            ],
            [
                'id'    => 251,
                'title' => 'expense_report_list_access',
            ],
            [
                'id'    => 252,
                'title' => 'expense_category_report_create',
            ],
            [
                'id'    => 253,
                'title' => 'expense_category_report_edit',
            ],
            [
                'id'    => 254,
                'title' => 'expense_category_report_show',
            ],
            [
                'id'    => 255,
                'title' => 'expense_category_report_delete',
            ],
            [
                'id'    => 256,
                'title' => 'expense_category_report_access',
            ],
            [
                'id'    => 257,
                'title' => 'expense_item_report_create',
            ],
            [
                'id'    => 258,
                'title' => 'expense_item_report_edit',
            ],
            [
                'id'    => 259,
                'title' => 'expense_item_report_show',
            ],
            [
                'id'    => 260,
                'title' => 'expense_item_report_delete',
            ],
            [
                'id'    => 261,
                'title' => 'expense_item_report_access',
            ],
            [
                'id'    => 262,
                'title' => 'sale_purchase_report_access',
            ],
            [
                'id'    => 263,
                'title' => 'sale_purchase_create',
            ],
            [
                'id'    => 264,
                'title' => 'sale_purchase_edit',
            ],
            [
                'id'    => 265,
                'title' => 'sale_purchase_show',
            ],
            [
                'id'    => 266,
                'title' => 'sale_purchase_delete',
            ],
            [
                'id'    => 267,
                'title' => 'sale_purchase_access',
            ],
            [
                'id'    => 268,
                'title' => 'sale_purchase_item_create',
            ],
            [
                'id'    => 269,
                'title' => 'sale_purchase_item_edit',
            ],
            [
                'id'    => 270,
                'title' => 'sale_purchase_item_show',
            ],
            [
                'id'    => 271,
                'title' => 'sale_purchase_item_delete',
            ],
            [
                'id'    => 272,
                'title' => 'sale_purchase_item_access',
            ],
            [
                'id'    => 273,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
