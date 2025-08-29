<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::post('user-alerts/parse-csv-import', 'UserAlertsController@parseCsvImport')->name('user-alerts.parseCsvImport');
    Route::post('user-alerts/process-csv-import', 'UserAlertsController@processCsvImport')->name('user-alerts.processCsvImport');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Add Business
    Route::delete('add-businesses/destroy', 'AddBusinessController@massDestroy')->name('add-businesses.massDestroy');
    Route::post('add-businesses/media', 'AddBusinessController@storeMedia')->name('add-businesses.storeMedia');
    Route::post('add-businesses/ckmedia', 'AddBusinessController@storeCKEditorImages')->name('add-businesses.storeCKEditorImages');
    Route::post('add-businesses/parse-csv-import', 'AddBusinessController@parseCsvImport')->name('add-businesses.parseCsvImport');
    Route::post('add-businesses/process-csv-import', 'AddBusinessController@processCsvImport')->name('add-businesses.processCsvImport');
    Route::resource('add-businesses', 'AddBusinessController');

    // Party Details
    Route::delete('party-details/destroy', 'PartyDetailsController@massDestroy')->name('party-details.massDestroy');
    Route::post('party-details/media', 'PartyDetailsController@storeMedia')->name('party-details.storeMedia');
    Route::post('party-details/ckmedia', 'PartyDetailsController@storeCKEditorImages')->name('party-details.storeCKEditorImages');
    Route::post('party-details/parse-csv-import', 'PartyDetailsController@parseCsvImport')->name('party-details.parseCsvImport');
    Route::post('party-details/process-csv-import', 'PartyDetailsController@processCsvImport')->name('party-details.processCsvImport');
    Route::resource('party-details', 'PartyDetailsController');

    // Loyalty Point
    Route::delete('loyalty-points/destroy', 'LoyaltyPointController@massDestroy')->name('loyalty-points.massDestroy');
    Route::resource('loyalty-points', 'LoyaltyPointController');

    // Whatsapp Connect
    Route::delete('whatsapp-connects/destroy', 'WhatsappConnectController@massDestroy')->name('whatsapp-connects.massDestroy');
    Route::resource('whatsapp-connects', 'WhatsappConnectController');

    // Add Item
    Route::delete('add-items/destroy', 'AddItemController@massDestroy')->name('add-items.massDestroy');
    Route::post('add-items/parse-csv-import', 'AddItemController@parseCsvImport')->name('add-items.parseCsvImport');
    Route::post('add-items/process-csv-import', 'AddItemController@processCsvImport')->name('add-items.processCsvImport');
    Route::resource('add-items', 'AddItemController');

    // Unit
    Route::delete('units/destroy', 'UnitController@massDestroy')->name('units.massDestroy');
    Route::post('units/parse-csv-import', 'UnitController@parseCsvImport')->name('units.parseCsvImport');
    Route::post('units/process-csv-import', 'UnitController@processCsvImport')->name('units.processCsvImport');
    Route::resource('units', 'UnitController');

    // Category
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::post('categories/parse-csv-import', 'CategoryController@parseCsvImport')->name('categories.parseCsvImport');
    Route::post('categories/process-csv-import', 'CategoryController@processCsvImport')->name('categories.processCsvImport');
    Route::resource('categories', 'CategoryController');

    // Tax Rate
    Route::delete('tax-rates/destroy', 'TaxRateController@massDestroy')->name('tax-rates.massDestroy');
    Route::post('tax-rates/parse-csv-import', 'TaxRateController@parseCsvImport')->name('tax-rates.parseCsvImport');
    Route::post('tax-rates/process-csv-import', 'TaxRateController@processCsvImport')->name('tax-rates.processCsvImport');
    Route::resource('tax-rates', 'TaxRateController');

    // Sale Invoice
    Route::delete('sale-invoices/destroy', 'SaleInvoiceController@massDestroy')->name('sale-invoices.massDestroy');
    Route::post('sale-invoices/media', 'SaleInvoiceController@storeMedia')->name('sale-invoices.storeMedia');
    Route::post('sale-invoices/ckmedia', 'SaleInvoiceController@storeCKEditorImages')->name('sale-invoices.storeCKEditorImages');
    Route::post('sale-invoices/parse-csv-import', 'SaleInvoiceController@parseCsvImport')->name('sale-invoices.parseCsvImport');
    Route::post('sale-invoices/process-csv-import', 'SaleInvoiceController@processCsvImport')->name('sale-invoices.processCsvImport');
    Route::resource('sale-invoices', 'SaleInvoiceController');

    // Estimate Quotation
    Route::delete('estimate-quotations/destroy', 'EstimateQuotationController@massDestroy')->name('estimate-quotations.massDestroy');
    Route::post('estimate-quotations/media', 'EstimateQuotationController@storeMedia')->name('estimate-quotations.storeMedia');
    Route::post('estimate-quotations/ckmedia', 'EstimateQuotationController@storeCKEditorImages')->name('estimate-quotations.storeCKEditorImages');
    Route::post('estimate-quotations/parse-csv-import', 'EstimateQuotationController@parseCsvImport')->name('estimate-quotations.parseCsvImport');
    Route::post('estimate-quotations/process-csv-import', 'EstimateQuotationController@processCsvImport')->name('estimate-quotations.processCsvImport');
    Route::resource('estimate-quotations', 'EstimateQuotationController');

    // Proforma Invoice
    Route::delete('proforma-invoices/destroy', 'ProformaInvoiceController@massDestroy')->name('proforma-invoices.massDestroy');
    Route::post('proforma-invoices/media', 'ProformaInvoiceController@storeMedia')->name('proforma-invoices.storeMedia');
    Route::post('proforma-invoices/ckmedia', 'ProformaInvoiceController@storeCKEditorImages')->name('proforma-invoices.storeCKEditorImages');
    Route::post('proforma-invoices/parse-csv-import', 'ProformaInvoiceController@parseCsvImport')->name('proforma-invoices.parseCsvImport');
    Route::post('proforma-invoices/process-csv-import', 'ProformaInvoiceController@processCsvImport')->name('proforma-invoices.processCsvImport');
    Route::resource('proforma-invoices', 'ProformaInvoiceController');

    // Bank Account
    Route::delete('bank-accounts/destroy', 'BankAccountController@massDestroy')->name('bank-accounts.massDestroy');
    Route::post('bank-accounts/parse-csv-import', 'BankAccountController@parseCsvImport')->name('bank-accounts.parseCsvImport');
    Route::post('bank-accounts/process-csv-import', 'BankAccountController@processCsvImport')->name('bank-accounts.processCsvImport');
    Route::resource('bank-accounts', 'BankAccountController');

    // Bank To Cash
    Route::delete('bank-to-cashes/destroy', 'BankToCashController@massDestroy')->name('bank-to-cashes.massDestroy');
    Route::post('bank-to-cashes/media', 'BankToCashController@storeMedia')->name('bank-to-cashes.storeMedia');
    Route::post('bank-to-cashes/ckmedia', 'BankToCashController@storeCKEditorImages')->name('bank-to-cashes.storeCKEditorImages');
    Route::post('bank-to-cashes/parse-csv-import', 'BankToCashController@parseCsvImport')->name('bank-to-cashes.parseCsvImport');
    Route::post('bank-to-cashes/process-csv-import', 'BankToCashController@processCsvImport')->name('bank-to-cashes.processCsvImport');
    Route::resource('bank-to-cashes', 'BankToCashController');

    // Cash To Bank
    Route::delete('cash-to-banks/destroy', 'CashToBankController@massDestroy')->name('cash-to-banks.massDestroy');
    Route::post('cash-to-banks/media', 'CashToBankController@storeMedia')->name('cash-to-banks.storeMedia');
    Route::post('cash-to-banks/ckmedia', 'CashToBankController@storeCKEditorImages')->name('cash-to-banks.storeCKEditorImages');
    Route::post('cash-to-banks/parse-csv-import', 'CashToBankController@parseCsvImport')->name('cash-to-banks.parseCsvImport');
    Route::post('cash-to-banks/process-csv-import', 'CashToBankController@processCsvImport')->name('cash-to-banks.processCsvImport');
    Route::resource('cash-to-banks', 'CashToBankController');

    // Bank To Bank
    Route::delete('bank-to-banks/destroy', 'BankToBankController@massDestroy')->name('bank-to-banks.massDestroy');
    Route::post('bank-to-banks/media', 'BankToBankController@storeMedia')->name('bank-to-banks.storeMedia');
    Route::post('bank-to-banks/ckmedia', 'BankToBankController@storeCKEditorImages')->name('bank-to-banks.storeCKEditorImages');
    Route::post('bank-to-banks/parse-csv-import', 'BankToBankController@parseCsvImport')->name('bank-to-banks.parseCsvImport');
    Route::post('bank-to-banks/process-csv-import', 'BankToBankController@processCsvImport')->name('bank-to-banks.processCsvImport');
    Route::resource('bank-to-banks', 'BankToBankController');

    // Adjust Bank Balance
    Route::delete('adjust-bank-balances/destroy', 'AdjustBankBalanceController@massDestroy')->name('adjust-bank-balances.massDestroy');
    Route::post('adjust-bank-balances/media', 'AdjustBankBalanceController@storeMedia')->name('adjust-bank-balances.storeMedia');
    Route::post('adjust-bank-balances/ckmedia', 'AdjustBankBalanceController@storeCKEditorImages')->name('adjust-bank-balances.storeCKEditorImages');
    Route::post('adjust-bank-balances/parse-csv-import', 'AdjustBankBalanceController@parseCsvImport')->name('adjust-bank-balances.parseCsvImport');
    Route::post('adjust-bank-balances/process-csv-import', 'AdjustBankBalanceController@processCsvImport')->name('adjust-bank-balances.processCsvImport');
    Route::resource('adjust-bank-balances', 'AdjustBankBalanceController');

    // Cash In Hand
    Route::delete('cash-in-hands/destroy', 'CashInHandController@massDestroy')->name('cash-in-hands.massDestroy');
    Route::post('cash-in-hands/media', 'CashInHandController@storeMedia')->name('cash-in-hands.storeMedia');
    Route::post('cash-in-hands/ckmedia', 'CashInHandController@storeCKEditorImages')->name('cash-in-hands.storeCKEditorImages');
    Route::post('cash-in-hands/parse-csv-import', 'CashInHandController@parseCsvImport')->name('cash-in-hands.parseCsvImport');
    Route::post('cash-in-hands/process-csv-import', 'CashInHandController@processCsvImport')->name('cash-in-hands.processCsvImport');
    Route::resource('cash-in-hands', 'CashInHandController');

    // Purchase Bill
    Route::delete('purchase-bills/destroy', 'PurchaseBillController@massDestroy')->name('purchase-bills.massDestroy');
    Route::post('purchase-bills/media', 'PurchaseBillController@storeMedia')->name('purchase-bills.storeMedia');
    Route::post('purchase-bills/ckmedia', 'PurchaseBillController@storeCKEditorImages')->name('purchase-bills.storeCKEditorImages');
    Route::post('purchase-bills/parse-csv-import', 'PurchaseBillController@parseCsvImport')->name('purchase-bills.parseCsvImport');
    Route::post('purchase-bills/process-csv-import', 'PurchaseBillController@processCsvImport')->name('purchase-bills.processCsvImport');
    Route::resource('purchase-bills', 'PurchaseBillController');

    // Current Stocks
    Route::delete('current-stocks/destroy', 'CurrentStocksController@massDestroy')->name('current-stocks.massDestroy');
    Route::post('current-stocks/parse-csv-import', 'CurrentStocksController@parseCsvImport')->name('current-stocks.parseCsvImport');
    Route::post('current-stocks/process-csv-import', 'CurrentStocksController@processCsvImport')->name('current-stocks.processCsvImport');
    Route::resource('current-stocks', 'CurrentStocksController');

    // Stocks Report
    Route::delete('stocks-reports/destroy', 'StocksReportController@massDestroy')->name('stocks-reports.massDestroy');
    Route::resource('stocks-reports', 'StocksReportController');

    // Stock History
    Route::delete('stock-histories/destroy', 'StockHistoryController@massDestroy')->name('stock-histories.massDestroy');
    Route::resource('stock-histories', 'StockHistoryController');

    // Payment Out
    Route::delete('payment-outs/destroy', 'PaymentOutController@massDestroy')->name('payment-outs.massDestroy');
    Route::post('payment-outs/media', 'PaymentOutController@storeMedia')->name('payment-outs.storeMedia');
    Route::post('payment-outs/ckmedia', 'PaymentOutController@storeCKEditorImages')->name('payment-outs.storeCKEditorImages');
    Route::post('payment-outs/parse-csv-import', 'PaymentOutController@parseCsvImport')->name('payment-outs.parseCsvImport');
    Route::post('payment-outs/process-csv-import', 'PaymentOutController@processCsvImport')->name('payment-outs.processCsvImport');
    Route::resource('payment-outs', 'PaymentOutController');

    // Expense Category
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::post('expense-categories/parse-csv-import', 'ExpenseCategoryController@parseCsvImport')->name('expense-categories.parseCsvImport');
    Route::post('expense-categories/process-csv-import', 'ExpenseCategoryController@processCsvImport')->name('expense-categories.processCsvImport');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Expense List
    Route::delete('expense-lists/destroy', 'ExpenseListController@massDestroy')->name('expense-lists.massDestroy');
    Route::post('expense-lists/media', 'ExpenseListController@storeMedia')->name('expense-lists.storeMedia');
    Route::post('expense-lists/ckmedia', 'ExpenseListController@storeCKEditorImages')->name('expense-lists.storeCKEditorImages');
    Route::post('expense-lists/parse-csv-import', 'ExpenseListController@parseCsvImport')->name('expense-lists.parseCsvImport');
    Route::post('expense-lists/process-csv-import', 'ExpenseListController@processCsvImport')->name('expense-lists.processCsvImport');
    Route::resource('expense-lists', 'ExpenseListController');

    // Purchase Order
    Route::delete('purchase-orders/destroy', 'PurchaseOrderController@massDestroy')->name('purchase-orders.massDestroy');
    Route::post('purchase-orders/media', 'PurchaseOrderController@storeMedia')->name('purchase-orders.storeMedia');
    Route::post('purchase-orders/ckmedia', 'PurchaseOrderController@storeCKEditorImages')->name('purchase-orders.storeCKEditorImages');
    Route::post('purchase-orders/parse-csv-import', 'PurchaseOrderController@parseCsvImport')->name('purchase-orders.parseCsvImport');
    Route::post('purchase-orders/process-csv-import', 'PurchaseOrderController@processCsvImport')->name('purchase-orders.processCsvImport');
    Route::resource('purchase-orders', 'PurchaseOrderController');

    // Sale Report
    Route::delete('sale-reports/destroy', 'SaleReportController@massDestroy')->name('sale-reports.massDestroy');
    Route::resource('sale-reports', 'SaleReportController');

    // Purchase Report
    Route::delete('purchase-reports/destroy', 'PurchaseReportController@massDestroy')->name('purchase-reports.massDestroy');
    Route::resource('purchase-reports', 'PurchaseReportController');

    // Day Book
    Route::delete('day-books/destroy', 'DayBookController@massDestroy')->name('day-books.massDestroy');
    Route::resource('day-books', 'DayBookController');

    // All Transactions
    Route::delete('all-transactions/destroy', 'AllTransactionsController@massDestroy')->name('all-transactions.massDestroy');
    Route::resource('all-transactions', 'AllTransactionsController');

    // Profit Loss
    Route::delete('profit-losses/destroy', 'ProfitLossController@massDestroy')->name('profit-losses.massDestroy');
    Route::resource('profit-losses', 'ProfitLossController');

    // Bill Wise Profit
    Route::delete('bill-wise-profits/destroy', 'BillWiseProfitController@massDestroy')->name('bill-wise-profits.massDestroy');
    Route::resource('bill-wise-profits', 'BillWiseProfitController');

    // Balance Sheet
    Route::delete('balance-sheets/destroy', 'BalanceSheetController@massDestroy')->name('balance-sheets.massDestroy');
    Route::resource('balance-sheets', 'BalanceSheetController');

    // Party Statement
    Route::delete('party-statements/destroy', 'PartyStatementController@massDestroy')->name('party-statements.massDestroy');
    Route::resource('party-statements', 'PartyStatementController');

    // Party Wise Profit Loss
    Route::delete('party-wise-profit-losses/destroy', 'PartyWiseProfitLossController@massDestroy')->name('party-wise-profit-losses.massDestroy');
    Route::resource('party-wise-profit-losses', 'PartyWiseProfitLossController');

    // All Parties
    Route::delete('all-parties/destroy', 'AllPartiesController@massDestroy')->name('all-parties.massDestroy');
    Route::resource('all-parties', 'AllPartiesController');

    // Party Report By Item
    Route::delete('party-report-by-items/destroy', 'PartyReportByItemController@massDestroy')->name('party-report-by-items.massDestroy');
    Route::resource('party-report-by-items', 'PartyReportByItemController');

    // Sale Purchase By Party
    Route::delete('sale-purchase-by-parties/destroy', 'SalePurchaseByPartyController@massDestroy')->name('sale-purchase-by-parties.massDestroy');
    Route::resource('sale-purchase-by-parties', 'SalePurchaseByPartyController');

    // Stocks Summary
    Route::delete('stocks-summaries/destroy', 'StocksSummaryController@massDestroy')->name('stocks-summaries.massDestroy');
    Route::resource('stocks-summaries', 'StocksSummaryController');

    // Item Report By Party
    Route::delete('item-report-by-parties/destroy', 'ItemReportByPartyController@massDestroy')->name('item-report-by-parties.massDestroy');
    Route::resource('item-report-by-parties', 'ItemReportByPartyController');

    // Item Wise Profit And Loass
    Route::delete('item-wise-profit-and-loasses/destroy', 'ItemWiseProfitAndLoassController@massDestroy')->name('item-wise-profit-and-loasses.massDestroy');
    Route::resource('item-wise-profit-and-loasses', 'ItemWiseProfitAndLoassController');

    // Low Stock Summary
    Route::delete('low-stock-summaries/destroy', 'LowStockSummaryController@massDestroy')->name('low-stock-summaries.massDestroy');
    Route::resource('low-stock-summaries', 'LowStockSummaryController');

    // Stock Detail
    Route::delete('stock-details/destroy', 'StockDetailController@massDestroy')->name('stock-details.massDestroy');
    Route::resource('stock-details', 'StockDetailController');

    // Expense Report List
    Route::delete('expense-report-lists/destroy', 'ExpenseReportListController@massDestroy')->name('expense-report-lists.massDestroy');
    Route::resource('expense-report-lists', 'ExpenseReportListController');

    // Expense Category Report
    Route::delete('expense-category-reports/destroy', 'ExpenseCategoryReportController@massDestroy')->name('expense-category-reports.massDestroy');
    Route::resource('expense-category-reports', 'ExpenseCategoryReportController');

    // Expense Item Report
    Route::delete('expense-item-reports/destroy', 'ExpenseItemReportController@massDestroy')->name('expense-item-reports.massDestroy');
    Route::resource('expense-item-reports', 'ExpenseItemReportController');

    // Sale Purchase
    Route::delete('sale-purchases/destroy', 'SalePurchaseController@massDestroy')->name('sale-purchases.massDestroy');
    Route::resource('sale-purchases', 'SalePurchaseController');

    // Sale Purchase Item
    Route::delete('sale-purchase-items/destroy', 'SalePurchaseItemController@massDestroy')->name('sale-purchase-items.massDestroy');
    Route::resource('sale-purchase-items', 'SalePurchaseItemController');

    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
