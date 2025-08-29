<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // User Alerts
    Route::apiResource('user-alerts', 'UserAlertsApiController', ['except' => ['update']]);

    // Add Business
    Route::post('add-businesses/media', 'AddBusinessApiController@storeMedia')->name('add-businesses.storeMedia');
    Route::apiResource('add-businesses', 'AddBusinessApiController');

    // Party Details
    Route::post('party-details/media', 'PartyDetailsApiController@storeMedia')->name('party-details.storeMedia');
    Route::apiResource('party-details', 'PartyDetailsApiController');

    // Add Item
    Route::apiResource('add-items', 'AddItemApiController');

    // Unit
    Route::apiResource('units', 'UnitApiController');

    // Category
    Route::apiResource('categories', 'CategoryApiController');

    // Tax Rate
    Route::apiResource('tax-rates', 'TaxRateApiController');

    // Sale Invoice
    Route::post('sale-invoices/media', 'SaleInvoiceApiController@storeMedia')->name('sale-invoices.storeMedia');
    Route::apiResource('sale-invoices', 'SaleInvoiceApiController');

    // Estimate Quotation
    Route::post('estimate-quotations/media', 'EstimateQuotationApiController@storeMedia')->name('estimate-quotations.storeMedia');
    Route::apiResource('estimate-quotations', 'EstimateQuotationApiController');

    // Proforma Invoice
    Route::post('proforma-invoices/media', 'ProformaInvoiceApiController@storeMedia')->name('proforma-invoices.storeMedia');
    Route::apiResource('proforma-invoices', 'ProformaInvoiceApiController');

    // Bank Account
    Route::apiResource('bank-accounts', 'BankAccountApiController');

    // Bank To Cash
    Route::post('bank-to-cashes/media', 'BankToCashApiController@storeMedia')->name('bank-to-cashes.storeMedia');
    Route::apiResource('bank-to-cashes', 'BankToCashApiController');

    // Cash To Bank
    Route::post('cash-to-banks/media', 'CashToBankApiController@storeMedia')->name('cash-to-banks.storeMedia');
    Route::apiResource('cash-to-banks', 'CashToBankApiController');

    // Bank To Bank
    Route::post('bank-to-banks/media', 'BankToBankApiController@storeMedia')->name('bank-to-banks.storeMedia');
    Route::apiResource('bank-to-banks', 'BankToBankApiController');

    // Adjust Bank Balance
    Route::post('adjust-bank-balances/media', 'AdjustBankBalanceApiController@storeMedia')->name('adjust-bank-balances.storeMedia');
    Route::apiResource('adjust-bank-balances', 'AdjustBankBalanceApiController');

    // Cash In Hand
    Route::post('cash-in-hands/media', 'CashInHandApiController@storeMedia')->name('cash-in-hands.storeMedia');
    Route::apiResource('cash-in-hands', 'CashInHandApiController');

    // Purchase Bill
    Route::post('purchase-bills/media', 'PurchaseBillApiController@storeMedia')->name('purchase-bills.storeMedia');
    Route::apiResource('purchase-bills', 'PurchaseBillApiController');

    // Current Stocks
    Route::apiResource('current-stocks', 'CurrentStocksApiController');

    // Payment Out
    Route::post('payment-outs/media', 'PaymentOutApiController@storeMedia')->name('payment-outs.storeMedia');
    Route::apiResource('payment-outs', 'PaymentOutApiController');

    // Expense Category
    Route::apiResource('expense-categories', 'ExpenseCategoryApiController');

    // Expense List
    Route::post('expense-lists/media', 'ExpenseListApiController@storeMedia')->name('expense-lists.storeMedia');
    Route::apiResource('expense-lists', 'ExpenseListApiController');

    // Purchase Order
    Route::post('purchase-orders/media', 'PurchaseOrderApiController@storeMedia')->name('purchase-orders.storeMedia');
    Route::apiResource('purchase-orders', 'PurchaseOrderApiController');
});
