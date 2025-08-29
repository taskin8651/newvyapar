<!-- <aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li>
                <a href="{{ route("admin.home") }}">
                    <i class="fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <span>{{ trans('cruds.userManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('permission_access')
                            <li class="{{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <a href="{{ route("admin.permissions.index") }}">
                                    <i class="fa-fw fas fa-unlock-alt">

                                    </i>
                                    <span>{{ trans('cruds.permission.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="{{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <a href="{{ route("admin.roles.index") }}">
                                    <i class="fa-fw fas fa-briefcase">

                                    </i>
                                    <span>{{ trans('cruds.role.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('add_business_access')
                            <li class="{{ request()->is("admin/add-businesses") || request()->is("admin/add-businesses/*") ? "active" : "" }}">
                                <a href="{{ route("admin.add-businesses.index") }}">
                                    <i class="fa-fw fas fa-briefcase">

                                    </i>
                                    <span>{{ trans('cruds.addBusiness.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="{{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <a href="{{ route("admin.users.index") }}">
                                    <i class="fa-fw fas fa-user">

                                    </i>
                                    <span>{{ trans('cruds.user.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('audit_log_access')
                            <li class="{{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                <a href="{{ route("admin.audit-logs.index") }}">
                                    <i class="fa-fw fas fa-file-alt">

                                    </i>
                                    <span>{{ trans('cruds.auditLog.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('party_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-user-plus">

                        </i>
                        <span>{{ trans('cruds.party.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('party_detail_access')
                            <li class="{{ request()->is("admin/party-details") || request()->is("admin/party-details/*") ? "active" : "" }}">
                                <a href="{{ route("admin.party-details.index") }}">
                                    <i class="fa-fw far fa-address-card">

                                    </i>
                                    <span>{{ trans('cruds.partyDetail.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('loyalty_point_access')
                            <li class="{{ request()->is("admin/loyalty-points") || request()->is("admin/loyalty-points/*") ? "active" : "" }}">
                                <a href="{{ route("admin.loyalty-points.index") }}">
                                    <i class="fa-fw fas fa-eye">

                                    </i>
                                    <span>{{ trans('cruds.loyaltyPoint.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('whatsapp_connect_access')
                            <li class="{{ request()->is("admin/whatsapp-connects") || request()->is("admin/whatsapp-connects/*") ? "active" : "" }}">
                                <a href="{{ route("admin.whatsapp-connects.index") }}">
                                    <i class="fa-fw fab fa-whatsapp">

                                    </i>
                                    <span>{{ trans('cruds.whatsappConnect.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('item_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-luggage-cart">

                        </i>
                        <span>{{ trans('cruds.item.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('add_item_access')
                            <li class="{{ request()->is("admin/add-items") || request()->is("admin/add-items/*") ? "active" : "" }}">
                                <a href="{{ route("admin.add-items.index") }}">
                                    <i class="fa-fw fas fa-shopping-cart">

                                    </i>
                                    <span>{{ trans('cruds.addItem.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('sale_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-bezier-curve">

                        </i>
                        <span>{{ trans('cruds.sale.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('sale_invoice_access')
                            <li class="{{ request()->is("admin/sale-invoices") || request()->is("admin/sale-invoices/*") ? "active" : "" }}">
                                <a href="{{ route("admin.sale-invoices.index") }}">
                                    <i class="fa-fw fas fa-file-alt">

                                    </i>
                                    <span>{{ trans('cruds.saleInvoice.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('estimate_quotation_access')
                            <li class="{{ request()->is("admin/estimate-quotations") || request()->is("admin/estimate-quotations/*") ? "active" : "" }}">
                                <a href="{{ route("admin.estimate-quotations.index") }}">
                                    <i class="fa-fw fas fa-file-alt">

                                    </i>
                                    <span>{{ trans('cruds.estimateQuotation.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('proforma_invoice_access')
                            <li class="{{ request()->is("admin/proforma-invoices") || request()->is("admin/proforma-invoices/*") ? "active" : "" }}">
                                <a href="{{ route("admin.proforma-invoices.index") }}">
                                    <i class="fa-fw fas fa-file-alt">

                                    </i>
                                    <span>{{ trans('cruds.proformaInvoice.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('purchase_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-file-export">

                        </i>
                        <span>{{ trans('cruds.purchase.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('purchase_bill_access')
                            <li class="{{ request()->is("admin/purchase-bills") || request()->is("admin/purchase-bills/*") ? "active" : "" }}">
                                <a href="{{ route("admin.purchase-bills.index") }}">
                                    <i class="fa-fw fas fa-file-alt">

                                    </i>
                                    <span>{{ trans('cruds.purchaseBill.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('payment_out_access')
                            <li class="{{ request()->is("admin/payment-outs") || request()->is("admin/payment-outs/*") ? "active" : "" }}">
                                <a href="{{ route("admin.payment-outs.index") }}">
                                    <i class="fa-fw fab fa-amazon-pay">

                                    </i>
                                    <span>{{ trans('cruds.paymentOut.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('purchase_order_access')
                            <li class="{{ request()->is("admin/purchase-orders") || request()->is("admin/purchase-orders/*") ? "active" : "" }}">
                                <a href="{{ route("admin.purchase-orders.index") }}">
                                    <i class="fa-fw fas fa-file-alt">

                                    </i>
                                    <span>{{ trans('cruds.purchaseOrder.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('expense_access')
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa-fw fab fa-accusoft">

                                    </i>
                                    <span>{{ trans('cruds.expense.title') }}</span>
                                    <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('expense_category_access')
                                        <li class="{{ request()->is("admin/expense-categories") || request()->is("admin/expense-categories/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.expense-categories.index") }}">
                                                <i class="fa-fw fas fa-hand-holding-usd">

                                                </i>
                                                <span>{{ trans('cruds.expenseCategory.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('expense_list_access')
                                        <li class="{{ request()->is("admin/expense-lists") || request()->is("admin/expense-lists/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.expense-lists.index") }}">
                                                <i class="fa-fw fas fa-arrow-circle-right">

                                                </i>
                                                <span>{{ trans('cruds.expenseList.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('stock_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-warehouse">

                        </i>
                        <span>{{ trans('cruds.stock.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('current_stock_access')
                            <li class="{{ request()->is("admin/current-stocks") || request()->is("admin/current-stocks/*") ? "active" : "" }}">
                                <a href="{{ route("admin.current-stocks.index") }}">
                                    <i class="fa-fw fas fa-cubes">

                                    </i>
                                    <span>{{ trans('cruds.currentStock.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('stocks_report_access')
                            <li class="{{ request()->is("admin/stocks-reports") || request()->is("admin/stocks-reports/*") ? "active" : "" }}">
                                <a href="{{ route("admin.stocks-reports.index") }}">
                                    <i class="fa-fw fab fa-accusoft">

                                    </i>
                                    <span>{{ trans('cruds.stocksReport.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('stock_history_access')
                            <li class="{{ request()->is("admin/stock-histories") || request()->is("admin/stock-histories/*") ? "active" : "" }}">
                                <a href="{{ route("admin.stock-histories.index") }}">
                                    <i class="fa-fw fas fa-history">

                                    </i>
                                    <span>{{ trans('cruds.stockHistory.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('bank_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-university">

                        </i>
                        <span>{{ trans('cruds.bank.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('bank_account_access')
                            <li class="{{ request()->is("admin/bank-accounts") || request()->is("admin/bank-accounts/*") ? "active" : "" }}">
                                <a href="{{ route("admin.bank-accounts.index") }}">
                                    <i class="fa-fw fas fa-university">

                                    </i>
                                    <span>{{ trans('cruds.bankAccount.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('cash_in_hand_access')
                            <li class="{{ request()->is("admin/cash-in-hands") || request()->is("admin/cash-in-hands/*") ? "active" : "" }}">
                                <a href="{{ route("admin.cash-in-hands.index") }}">
                                    <i class="fa-fw fas fa-handshake">

                                    </i>
                                    <span>{{ trans('cruds.cashInHand.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('deposit_withdraw_access')
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.depositWithdraw.title') }}</span>
                                    <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('bank_to_cash_access')
                                        <li class="{{ request()->is("admin/bank-to-cashes") || request()->is("admin/bank-to-cashes/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.bank-to-cashes.index") }}">
                                                <i class="fa-fw fas fa-money-check-alt">

                                                </i>
                                                <span>{{ trans('cruds.bankToCash.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('cash_to_bank_access')
                                        <li class="{{ request()->is("admin/cash-to-banks") || request()->is("admin/cash-to-banks/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.cash-to-banks.index") }}">
                                                <i class="fa-fw fas fa-money-check-alt">

                                                </i>
                                                <span>{{ trans('cruds.cashToBank.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('bank_to_bank_access')
                                        <li class="{{ request()->is("admin/bank-to-banks") || request()->is("admin/bank-to-banks/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.bank-to-banks.index") }}">
                                                <i class="fa-fw fas fa-money-check-alt">

                                                </i>
                                                <span>{{ trans('cruds.bankToBank.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('adjust_bank_balance_access')
                                        <li class="{{ request()->is("admin/adjust-bank-balances") || request()->is("admin/adjust-bank-balances/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.adjust-bank-balances.index") }}">
                                                <i class="fa-fw fas fa-money-check-alt">

                                                </i>
                                                <span>{{ trans('cruds.adjustBankBalance.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('master_data_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.masterData.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('user_alert_access')
                            <li class="{{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                                <a href="{{ route("admin.user-alerts.index") }}">
                                    <i class="fa-fw fas fa-bell">

                                    </i>
                                    <span>{{ trans('cruds.userAlert.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('unit_access')
                            <li class="{{ request()->is("admin/units") || request()->is("admin/units/*") ? "active" : "" }}">
                                <a href="{{ route("admin.units.index") }}">
                                    <i class="fa-fw fas fa-universal-access">

                                    </i>
                                    <span>{{ trans('cruds.unit.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('category_access')
                            <li class="{{ request()->is("admin/categories") || request()->is("admin/categories/*") ? "active" : "" }}">
                                <a href="{{ route("admin.categories.index") }}">
                                    <i class="fa-fw fas fa-cart-arrow-down">

                                    </i>
                                    <span>{{ trans('cruds.category.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('tax_rate_access')
                            <li class="{{ request()->is("admin/tax-rates") || request()->is("admin/tax-rates/*") ? "active" : "" }}">
                                <a href="{{ route("admin.tax-rates.index") }}">
                                    <i class="fa-fw fas fa-cogs">

                                    </i>
                                    <span>{{ trans('cruds.taxRate.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('report_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw far fa-address-card">

                        </i>
                        <span>{{ trans('cruds.report.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('transaction_report_access')
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa-fw fas fa-exchange-alt">

                                    </i>
                                    <span>{{ trans('cruds.transactionReport.title') }}</span>
                                    <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('sale_report_access')
                                        <li class="{{ request()->is("admin/sale-reports") || request()->is("admin/sale-reports/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.sale-reports.index") }}">
                                                <i class="fa-fw fas fa-bookmark">

                                                </i>
                                                <span>{{ trans('cruds.saleReport.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('purchase_report_access')
                                        <li class="{{ request()->is("admin/purchase-reports") || request()->is("admin/purchase-reports/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.purchase-reports.index") }}">
                                                <i class="fa-fw fas fa-shopping-cart">

                                                </i>
                                                <span>{{ trans('cruds.purchaseReport.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('day_book_access')
                                        <li class="{{ request()->is("admin/day-books") || request()->is("admin/day-books/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.day-books.index") }}">
                                                <i class="fa-fw fas fa-book">

                                                </i>
                                                <span>{{ trans('cruds.dayBook.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('all_transaction_access')
                                        <li class="{{ request()->is("admin/all-transactions") || request()->is("admin/all-transactions/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.all-transactions.index") }}">
                                                <i class="fa-fw fas fa-exchange-alt">

                                                </i>
                                                <span>{{ trans('cruds.allTransaction.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('profit_loss_access')
                                        <li class="{{ request()->is("admin/profit-losses") || request()->is("admin/profit-losses/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.profit-losses.index") }}">
                                                <i class="fa-fw fab fa-gratipay">

                                                </i>
                                                <span>{{ trans('cruds.profitLoss.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('bill_wise_profit_access')
                                        <li class="{{ request()->is("admin/bill-wise-profits") || request()->is("admin/bill-wise-profits/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.bill-wise-profits.index") }}">
                                                <i class="fa-fw fas fa-file-invoice">

                                                </i>
                                                <span>{{ trans('cruds.billWiseProfit.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('balance_sheet_access')
                                        <li class="{{ request()->is("admin/balance-sheets") || request()->is("admin/balance-sheets/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.balance-sheets.index") }}">
                                                <i class="fa-fw fas fa-balance-scale">

                                                </i>
                                                <span>{{ trans('cruds.balanceSheet.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan
                        @can('party_report_access')
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa-fw fas fa-user-friends">

                                    </i>
                                    <span>{{ trans('cruds.partyReport.title') }}</span>
                                    <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('party_statement_access')
                                        <li class="{{ request()->is("admin/party-statements") || request()->is("admin/party-statements/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.party-statements.index") }}">
                                                <i class="fa-fw fas fa-cannabis">

                                                </i>
                                                <span>{{ trans('cruds.partyStatement.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('party_wise_profit_loss_access')
                                        <li class="{{ request()->is("admin/party-wise-profit-losses") || request()->is("admin/party-wise-profit-losses/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.party-wise-profit-losses.index") }}">
                                                <i class="fa-fw fab fa-angellist">

                                                </i>
                                                <span>{{ trans('cruds.partyWiseProfitLoss.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('all_party_access')
                                        <li class="{{ request()->is("admin/all-parties") || request()->is("admin/all-parties/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.all-parties.index") }}">
                                                <i class="fa-fw fas fa-user-cog">

                                                </i>
                                                <span>{{ trans('cruds.allParty.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('party_report_by_item_access')
                                        <li class="{{ request()->is("admin/party-report-by-items") || request()->is("admin/party-report-by-items/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.party-report-by-items.index") }}">
                                                <i class="fa-fw fas fa-chalkboard-teacher">

                                                </i>
                                                <span>{{ trans('cruds.partyReportByItem.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('sale_purchase_by_party_access')
                                        <li class="{{ request()->is("admin/sale-purchase-by-parties") || request()->is("admin/sale-purchase-by-parties/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.sale-purchase-by-parties.index") }}">
                                                <i class="fa-fw fas fa-arrow-circle-right">

                                                </i>
                                                <span>{{ trans('cruds.salePurchaseByParty.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan
                        @can('stock_report_access')
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa-fw fas fa-arrow-right">

                                    </i>
                                    <span>{{ trans('cruds.stockReport.title') }}</span>
                                    <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('stocks_summary_access')
                                        <li class="{{ request()->is("admin/stocks-summaries") || request()->is("admin/stocks-summaries/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.stocks-summaries.index") }}">
                                                <i class="fa-fw fas fa-umbrella-beach">

                                                </i>
                                                <span>{{ trans('cruds.stocksSummary.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('item_report_by_party_access')
                                        <li class="{{ request()->is("admin/item-report-by-parties") || request()->is("admin/item-report-by-parties/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.item-report-by-parties.index") }}">
                                                <i class="fa-fw fas fa-user-friends">

                                                </i>
                                                <span>{{ trans('cruds.itemReportByParty.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('item_wise_profit_and_loass_access')
                                        <li class="{{ request()->is("admin/item-wise-profit-and-loasses") || request()->is("admin/item-wise-profit-and-loasses/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.item-wise-profit-and-loasses.index") }}">
                                                <i class="fa-fw fas fa-luggage-cart">

                                                </i>
                                                <span>{{ trans('cruds.itemWiseProfitAndLoass.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('low_stock_summary_access')
                                        <li class="{{ request()->is("admin/low-stock-summaries") || request()->is("admin/low-stock-summaries/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.low-stock-summaries.index") }}">
                                                <i class="fa-fw fab fa-studiovinari">

                                                </i>
                                                <span>{{ trans('cruds.lowStockSummary.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('stock_detail_access')
                                        <li class="{{ request()->is("admin/stock-details") || request()->is("admin/stock-details/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.stock-details.index") }}">
                                                <i class="fa-fw fab fa-audible">

                                                </i>
                                                <span>{{ trans('cruds.stockDetail.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan
                        @can('expense_report_access')
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa-fw fab fa-expeditedssl">

                                    </i>
                                    <span>{{ trans('cruds.expenseReport.title') }}</span>
                                    <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('expense_report_list_access')
                                        <li class="{{ request()->is("admin/expense-report-lists") || request()->is("admin/expense-report-lists/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.expense-report-lists.index") }}">
                                                <i class="fa-fw fas fa-hand-holding-usd">

                                                </i>
                                                <span>{{ trans('cruds.expenseReportList.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('expense_category_report_access')
                                        <li class="{{ request()->is("admin/expense-category-reports") || request()->is("admin/expense-category-reports/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.expense-category-reports.index") }}">
                                                <i class="fa-fw fas fa-chalkboard-teacher">

                                                </i>
                                                <span>{{ trans('cruds.expenseCategoryReport.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('expense_item_report_access')
                                        <li class="{{ request()->is("admin/expense-item-reports") || request()->is("admin/expense-item-reports/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.expense-item-reports.index") }}">
                                                <i class="fa-fw fas fa-copy">

                                                </i>
                                                <span>{{ trans('cruds.expenseItemReport.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan
                        @can('sale_purchase_report_access')
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa-fw fab fa-affiliatetheme">

                                    </i>
                                    <span>{{ trans('cruds.salePurchaseReport.title') }}</span>
                                    <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                                </a>
                                <ul class="treeview-menu">
                                    @can('sale_purchase_access')
                                        <li class="{{ request()->is("admin/sale-purchases") || request()->is("admin/sale-purchases/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.sale-purchases.index") }}">
                                                <i class="fa-fw fab fa-first-order">

                                                </i>
                                                <span>{{ trans('cruds.salePurchase.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                    @can('sale_purchase_item_access')
                                        <li class="{{ request()->is("admin/sale-purchase-items") || request()->is("admin/sale-purchase-items/*") ? "active" : "" }}">
                                            <a href="{{ route("admin.sale-purchase-items.index") }}">
                                                <i class="fa-fw fas fa-cogs">

                                                </i>
                                                <span>{{ trans('cruds.salePurchaseItem.title') }}</span>

                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @php($unread = \App\Models\QaTopic::unreadCount())
                <li class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }}">
                    <a href="{{ route("admin.messenger.index") }}">
                        <i class="fa-fw fa fa-envelope">

                        </i>
                        <span>{{ trans('global.messages') }}</span>
                        @if($unread > 0)
                            <strong>( {{ $unread }} )</strong>
                        @endif

                    </a>
                </li>
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="{{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}">
                            <a href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key">
                                </i>
                                {{ trans('global.change_password') }}
                            </a>
                        </li>
                    @endcan
                @endif
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <i class="fas fa-fw fa-sign-out-alt">

                        </i>
                        {{ trans('global.logout') }}
                    </a>
                </li>
        </ul>
    </section>
</aside> -->


        <!-- User Management -->
@can('user_management_access')
<div class="space-y-1 mt-4">
    <div class="px-3 py-2 text-xs font-semibold text-primary-500 uppercase tracking-wider">Management</div>
    
    <div 
        x-data="{ userManagementOpen: {{ request()->is('admin/permissions*') || request()->is('admin/roles*') || request()->is('admin/add-businesses*') || request()->is('admin/users*') || request()->is('admin/audit-logs*') ? 'true' : 'false' }} }" 
        class="rounded-xl overflow-hidden">

        <!-- Parent Button -->
        <button @click="userManagementOpen = !userManagementOpen" 
            class="flex items-center justify-between w-full px-4 py-3 rounded-xl transition-all duration-200 hover:bg-primary-100 hover:shadow-sm hover:pl-5"
            :class="userManagementOpen ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-700 font-medium'">
            
            <span class="flex items-center">
                <div class="p-2 rounded-lg transition-colors"
                     :class="userManagementOpen ? 'bg-primary-600 text-white' : 'bg-primary-100 text-primary-600'">
                    <i class="fas fa-users w-5"></i>
                </div>
                <span class="ml-3">{{ trans('cruds.userManagement.title') }}</span>
            </span>
            
            <i class="fas transform transition-transform duration-300 text-xs"
                :class="userManagementOpen ? 'fa-chevron-up text-primary-600' : 'fa-chevron-down text-primary-400'"></i>
        </button>

        <!-- Dropdown Items -->
        <div x-show="userManagementOpen" x-collapse.duration.300ms class="ml-9 space-y-2 mt-2">

            @can('permission_access')
            <a href="{{ route('admin.permissions.index') }}"
               class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200
               hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
               {{ request()->is('admin/permissions*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
               <i class="fas fa-unlock-alt w-4 mr-3 {{ request()->is('admin/permissions*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
               <span>{{ trans('cruds.permission.title') }}</span>
            </a>
            @endcan

            @can('role_access')
            <a href="{{ route('admin.roles.index') }}"
               class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200
               hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
               {{ request()->is('admin/roles*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
               <i class="fas fa-briefcase w-4 mr-3 {{ request()->is('admin/roles*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
               <span>{{ trans('cruds.role.title') }}</span>
            </a>
            @endcan

            @can('add_business_access')
            <a href="{{ route('admin.add-businesses.index') }}"
               class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200
               hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
               {{ request()->is('admin/add-businesses*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
               <i class="fas fa-building w-4 mr-3 {{ request()->is('admin/add-businesses*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
               <span>{{ trans('cruds.addBusiness.title') }}</span>
            </a>
            @endcan

            @can('user_access')
            <a href="{{ route('admin.users.index') }}"
               class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200
               hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
               {{ request()->is('admin/users*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
               <i class="fas fa-user w-4 mr-3 {{ request()->is('admin/users*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
               <span>{{ trans('cruds.user.title') }}</span>
            </a>
            @endcan

            @can('audit_log_access')
            <a href="{{ route('admin.audit-logs.index') }}"
               class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200
               hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
               {{ request()->is('admin/audit-logs*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
               <i class="fas fa-file-alt w-4 mr-3 {{ request()->is('admin/audit-logs*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
               <span>{{ trans('cruds.auditLog.title') }}</span>
            </a>
            @endcan

        </div>
    </div>
</div>
@endcan

@can('party_access')
<div class="space-y-1 mt-4">
    <div class="px-3 py-2 text-xs font-semibold text-primary-500 uppercase tracking-wider">Party</div>
    
    <div 
        x-data="{ partyOpen: {{ request()->is('admin/party-details*') || request()->is('admin/loyalty-points*') || request()->is('admin/whatsapp-connects*') ? 'true' : 'false' }} }" 
        class="rounded-xl overflow-hidden">

        <!-- Parent Button -->
        <button @click="partyOpen = !partyOpen" 
            class="flex items-center justify-between w-full px-4 py-3 rounded-xl transition-all duration-200 hover:bg-primary-100 hover:shadow-sm hover:pl-5"
            :class="partyOpen ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-700 font-medium'">
            
            <span class="flex items-center">
                <div class="p-2 rounded-lg transition-colors"
                     :class="partyOpen ? 'bg-primary-600 text-white' : 'bg-primary-100 text-primary-600'">
                    <i class="fas fa-user-plus w-5"></i>
                </div>
                <span class="ml-3">{{ trans('cruds.party.title') }}</span>
            </span>
            
            <i class="fas transform transition-transform duration-300 text-xs"
                :class="partyOpen ? 'fa-chevron-up text-primary-600' : 'fa-chevron-down text-primary-400'"></i>
        </button>

        <!-- Dropdown Items -->
        <div x-show="partyOpen" x-collapse.duration.300ms class="ml-9 space-y-2 mt-2">
            @can('party_detail_access')
            <a href="{{ route('admin.party-details.index') }}"
               class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200
               hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
               {{ request()->is('admin/party-details*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
               <i class="far fa-address-card w-4 mr-3 {{ request()->is('admin/party-details*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
               <span>{{ trans('cruds.partyDetail.title') }}</span>
            </a>
            @endcan

            @can('loyalty_point_access')
            <a href="{{ route('admin.loyalty-points.index') }}"
               class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200
               hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
               {{ request()->is('admin/loyalty-points*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
               <i class="fas fa-eye w-4 mr-3 {{ request()->is('admin/loyalty-points*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
               <span>{{ trans('cruds.loyaltyPoint.title') }}</span>
            </a>
            @endcan

            @can('whatsapp_connect_access')
            <a href="{{ route('admin.whatsapp-connects.index') }}"
               class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200
               hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
               {{ request()->is('admin/whatsapp-connects*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
               <i class="fab fa-whatsapp w-4 mr-3 {{ request()->is('admin/whatsapp-connects*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
               <span>{{ trans('cruds.whatsappConnect.title') }}</span>
            </a>
            @endcan
        </div>
    </div>
</div>
@endcan

@can('item_access')
<div class="space-y-1 mt-4">
    <div class="px-3 py-2 text-xs font-semibold text-primary-500 uppercase tracking-wider">Inventory</div>
    
    <div 
        x-data="{ itemOpen: {{ request()->is('admin/add-items*') ? 'true' : 'false' }} }" 
        class="rounded-xl overflow-hidden">

        <!-- Parent Button -->
        <button @click="itemOpen = !itemOpen" 
            class="flex items-center justify-between w-full px-4 py-3 rounded-xl transition-all duration-200 hover:bg-primary-100 hover:shadow-sm hover:pl-5"
            :class="itemOpen ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-700 font-medium'">
            
            <span class="flex items-center">
                <div class="p-2 rounded-lg transition-colors"
                     :class="itemOpen ? 'bg-primary-600 text-white' : 'bg-primary-100 text-primary-600'">
                    <i class="fas fa-luggage-cart w-5"></i>
                </div>
                <span class="ml-3">{{ trans('cruds.item.title') }}</span>
            </span>
            
            <i class="fas transform transition-transform duration-300 text-xs"
                :class="itemOpen ? 'fa-chevron-up text-primary-600' : 'fa-chevron-down text-primary-400'"></i>
        </button>

        <!-- Dropdown Items -->
        <div x-show="itemOpen" x-collapse.duration.300ms class="ml-9 space-y-2 mt-2">

            @can('add_item_access')
            <a href="{{ route('admin.add-items.index') }}"
               class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200
               hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
               {{ request()->is('admin/add-items*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
               <i class="fas fa-shopping-cart w-4 mr-3 {{ request()->is('admin/add-items*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
               <span>{{ trans('cruds.addItem.title') }}</span>
            </a>
            @endcan

        </div>
    </div>
</div>
@endcan

@can('sale_access')
<div class="space-y-1 mt-4">
    <div class="px-3 py-2 text-xs font-semibold text-primary-500 uppercase tracking-wider">Sales</div>
    
    <div 
        x-data="{ saleOpen: {{ request()->is('admin/sale-invoices*') || request()->is('admin/estimate-quotations*') || request()->is('admin/proforma-invoices*') ? 'true' : 'false' }} }" 
        class="rounded-xl overflow-hidden">

        <!-- Parent Button -->
        <button @click="saleOpen = !saleOpen" 
            class="flex items-center justify-between w-full px-4 py-3 rounded-xl transition-all duration-200 hover:bg-primary-100 hover:shadow-sm hover:pl-5"
            :class="saleOpen ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-700 font-medium'">
            
            <span class="flex items-center">
                <div class="p-2 rounded-lg transition-colors"
                     :class="saleOpen ? 'bg-primary-600 text-white' : 'bg-primary-100 text-primary-600'">
                    <i class="fas fa-bezier-curve w-5"></i>
                </div>
                <span class="ml-3">{{ trans('cruds.sale.title') }}</span>
            </span>
            
            <i class="fas transform transition-transform duration-300 text-xs"
                :class="saleOpen ? 'fa-chevron-up text-primary-600' : 'fa-chevron-down text-primary-400'"></i>
        </button>

        <!-- Dropdown Items -->
        <div x-show="saleOpen" x-collapse.duration.300ms class="ml-9 space-y-2 mt-2">

            @can('sale_invoice_access')
            <a href="{{ route('admin.sale-invoices.index') }}"
               class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200
               hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
               {{ request()->is('admin/sale-invoices*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
               <i class="fas fa-file-invoice w-4 mr-3 {{ request()->is('admin/sale-invoices*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
               <span>{{ trans('cruds.saleInvoice.title') }}</span>
            </a>
            @endcan

            @can('estimate_quotation_access')
            <a href="{{ route('admin.estimate-quotations.index') }}"
               class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200
               hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
               {{ request()->is('admin/estimate-quotations*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
               <i class="fas fa-file-signature w-4 mr-3 {{ request()->is('admin/estimate-quotations*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
               <span>{{ trans('cruds.estimateQuotation.title') }}</span>
            </a>
            @endcan

            @can('proforma_invoice_access')
            <a href="{{ route('admin.proforma-invoices.index') }}"
               class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200
               hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
               {{ request()->is('admin/proforma-invoices*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
               <i class="fas fa-file-contract w-4 mr-3 {{ request()->is('admin/proforma-invoices*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
               <span>{{ trans('cruds.proformaInvoice.title') }}</span>
            </a>
            @endcan

        </div>
    </div>
</div>
@endcan

{{-- Purchase Section --}}
@can('purchase_access')
<div class="space-y-1 mt-4">
    <div class="px-3 py-2 text-xs font-semibold text-primary-500 uppercase tracking-wider">Purchase</div>

    <div x-data="{ purchaseOpen: {{ request()->is('admin/purchase-bills*') || request()->is('admin/payment-outs*') || request()->is('admin/purchase-orders*') || request()->is('admin/expense-categories*') || request()->is('admin/expense-lists*') ? 'true' : 'false' }} }" class="rounded-xl overflow-hidden">

        <!-- Parent Button -->
        <button @click="purchaseOpen = !purchaseOpen"
            class="flex items-center justify-between w-full px-4 py-3 rounded-xl transition-all duration-200 hover:bg-primary-100 hover:shadow-sm hover:pl-5"
            :class="purchaseOpen ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-700 font-medium'">
            
            <span class="flex items-center">
                <div class="p-2 rounded-lg transition-colors"
                     :class="purchaseOpen ? 'bg-primary-600 text-white' : 'bg-primary-100 text-primary-600'">
                    <i class="fas fa-file-export w-5"></i>
                </div>
                <span class="ml-3">{{ trans('cruds.purchase.title') }}</span>
            </span>

            <i class="fas transform transition-transform duration-300 text-xs"
               :class="purchaseOpen ? 'fa-chevron-up text-primary-600' : 'fa-chevron-down text-primary-400'"></i>
        </button>

        <!-- Dropdown Items -->
        <div x-show="purchaseOpen" x-collapse.duration.300ms class="ml-9 space-y-2 mt-2">

            @can('purchase_bill_access')
            <a href="{{ route('admin.purchase-bills.index') }}"
               class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200
               hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
               {{ request()->is('admin/purchase-bills*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
               <i class="fas fa-file-alt w-4 mr-3 {{ request()->is('admin/purchase-bills*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
               <span>{{ trans('cruds.purchaseBill.title') }}</span>
            </a>
            @endcan

            @can('payment_out_access')
            <a href="{{ route('admin.payment-outs.index') }}"
               class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200
               hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
               {{ request()->is('admin/payment-outs*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
               <i class="fab fa-amazon-pay w-4 mr-3 {{ request()->is('admin/payment-outs*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
               <span>{{ trans('cruds.paymentOut.title') }}</span>
            </a>
            @endcan

            @can('purchase_order_access')
            <a href="{{ route('admin.purchase-orders.index') }}"
               class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200
               hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
               {{ request()->is('admin/purchase-orders*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
               <i class="fas fa-file-alt w-4 mr-3 {{ request()->is('admin/purchase-orders*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
               <span>{{ trans('cruds.purchaseOrder.title') }}</span>
            </a>
            @endcan

            {{-- Expense Sub-section --}}
            @can('expense_access')
            <div x-data="{ expenseOpen: {{ request()->is('admin/expense-categories*') || request()->is('admin/expense-lists*') ? 'true' : 'false' }} }" class="ml-3">
                <button @click="expenseOpen = !expenseOpen"
                    class="flex items-center justify-between w-full px-3 py-2 text-sm rounded-lg transition-all duration-200
                           hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                           {{ request()->is('admin/expense-categories*') || request()->is('admin/expense-lists*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                    <span class="flex items-center">
                        <i class="fab fa-accusoft w-4 mr-3"></i>
                        <span>{{ trans('cruds.expense.title') }}</span>
                    </span>
                    <i class="fas transform transition-transform duration-300 text-xs"
                       :class="expenseOpen ? 'fa-chevron-up text-primary-600' : 'fa-chevron-down text-primary-400'"></i>
                </button>

                <div x-show="expenseOpen" x-collapse.duration.300ms class="ml-5 mt-2 space-y-2">
                    @can('expense_category_access')
                    <a href="{{ route('admin.expense-categories.index') }}"
                       class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200
                       hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                       {{ request()->is('admin/expense-categories*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                       <i class="fas fa-hand-holding-usd w-4 mr-3 {{ request()->is('admin/expense-categories*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                       <span>{{ trans('cruds.expenseCategory.title') }}</span>
                    </a>
                    @endcan

                    @can('expense_list_access')
                    <a href="{{ route('admin.expense-lists.index') }}"
                       class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200
                       hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                       {{ request()->is('admin/expense-lists*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                       <i class="fas fa-arrow-circle-right w-4 mr-3 {{ request()->is('admin/expense-lists*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                       <span>{{ trans('cruds.expenseList.title') }}</span>
                    </a>
                    @endcan
                </div>
            </div>
            @endcan

        </div>
    </div>
</div>
@endcan



@can('stock_access')
<div class="space-y-1 mt-4">
    <!-- Section Heading -->
    <div class="px-3 py-2 text-xs font-semibold text-primary-500 uppercase tracking-wider">
        {{ trans('cruds.stock.title') }}
    </div>

    <!-- Dropdown -->
    <div x-data="{ stockOpen: {{ request()->is('admin/current-stocks*') || request()->is('admin/stocks-reports*') || request()->is('admin/stock-histories*') ? 'true' : 'false' }} }" 
         class="rounded-xl overflow-hidden">

        <!-- Parent Button -->
        <button @click="stockOpen = !stockOpen" 
            class="flex items-center justify-between w-full px-4 py-3 rounded-xl transition-all duration-200 
                   hover:bg-primary-100 hover:shadow-sm hover:pl-5"
            :class="stockOpen ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-700 font-medium'">
            
            <span class="flex items-center">
                <div class="p-2 rounded-lg transition-colors"
                    :class="stockOpen ? 'bg-primary-600 text-white' : 'bg-primary-100 text-primary-600'">
                    <i class="fas fa-warehouse w-5"></i>
                </div>
                <span class="ml-3">{{ trans('cruds.stock.title') }}</span>
            </span>

            <i class="fas transform transition-transform duration-300 text-xs"
                :class="stockOpen ? 'fa-chevron-up text-primary-600' : 'fa-chevron-down text-primary-400'"></i>
        </button>

        <!-- Dropdown Items -->
        <div x-show="stockOpen" x-collapse.duration.300ms class="ml-9 space-y-2 mt-2">

            @can('current_stock_access')
                <a href="{{ route('admin.current-stocks.index') }}"
                   class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200 
                          hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                          {{ request()->is('admin/current-stocks*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                    <i class="fas fa-cubes w-4 mr-3 {{ request()->is('admin/current-stocks*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                    <span>{{ trans('cruds.currentStock.title') }}</span>
                </a>
            @endcan

            @can('stocks_report_access')
                <a href="{{ route('admin.stocks-reports.index') }}"
                   class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200 
                          hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                          {{ request()->is('admin/stocks-reports*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                    <i class="fab fa-accusoft w-4 mr-3 {{ request()->is('admin/stocks-reports*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                    <span>{{ trans('cruds.stocksReport.title') }}</span>
                </a>
            @endcan

            @can('stock_history_access')
                <a href="{{ route('admin.stock-histories.index') }}"
                   class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200 
                          hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                          {{ request()->is('admin/stock-histories*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                    <i class="fas fa-history w-4 mr-3 {{ request()->is('admin/stock-histories*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                    <span>{{ trans('cruds.stockHistory.title') }}</span>
                </a>
            @endcan

        </div>
    </div>
</div>
@endcan


@can('bank_access')
<div class="space-y-1 mt-4">
    <div class="px-3 py-2 text-xs font-semibold text-primary-500 uppercase tracking-wider">
        {{ trans('cruds.bank.title') }}
    </div>

    <div x-data="{ bankOpen: {{ request()->is('admin/bank-accounts*') || request()->is('admin/cash-in-hands*') || request()->is('admin/bank-to-cashes*') || request()->is('admin/cash-to-banks*') || request()->is('admin/bank-to-banks*') || request()->is('admin/adjust-bank-balances*') ? 'true' : 'false' }} }" 
         class="rounded-xl overflow-hidden">

        <!-- Parent Button -->
        <button @click="bankOpen = !bankOpen" 
            class="flex items-center justify-between w-full px-4 py-3 rounded-xl transition-all duration-200 
                   hover:bg-primary-100 hover:shadow-sm hover:pl-5" 
            :class="bankOpen ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-700 font-medium'">
            
            <span class="flex items-center">
                <div class="p-2 rounded-lg transition-colors" 
                     :class="bankOpen ? 'bg-primary-600 text-white' : 'bg-primary-100 text-primary-600'">
                    <i class="fas fa-university w-5"></i>
                </div>
                <span class="ml-3">{{ trans('cruds.bank.title') }}</span>
            </span>

            <i class="fas transform transition-transform duration-300 text-xs" 
               :class="bankOpen ? 'fa-chevron-up text-primary-600' : 'fa-chevron-down text-primary-400'"></i>
        </button>

        <!-- Dropdown Items -->
        <div x-show="bankOpen" x-collapse.duration.300ms class="ml-9 space-y-2 mt-2">

            @can('bank_account_access')
            <a href="{{ route('admin.bank-accounts.index') }}" 
               class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200 
                      hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium 
                      {{ request()->is('admin/bank-accounts*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                <i class="fas fa-university w-4 mr-3 {{ request()->is('admin/bank-accounts*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                <span>{{ trans('cruds.bankAccount.title') }}</span>
            </a>
            @endcan

            @can('cash_in_hand_access')
            <a href="{{ route('admin.cash-in-hands.index') }}" 
               class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200 
                      hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium 
                      {{ request()->is('admin/cash-in-hands*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                <i class="fas fa-handshake w-4 mr-3 {{ request()->is('admin/cash-in-hands*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                <span>{{ trans('cruds.cashInHand.title') }}</span>
            </a>
            @endcan

            @can('deposit_withdraw_access')
            <div x-data="{ dwOpen: {{ request()->is('admin/bank-to-cashes*') || request()->is('admin/cash-to-banks*') || request()->is('admin/bank-to-banks*') || request()->is('admin/adjust-bank-balances*') ? 'true' : 'false' }} }">

                <!-- Sub Parent -->
                <button @click="dwOpen = !dwOpen" 
                        class="flex items-center justify-between w-full px-3 py-2.5 rounded-lg transition-all duration-200 
                               hover:bg-primary-50 hover:pl-4 font-medium 
                               {{ request()->is('admin/bank-to-cashes*') || request()->is('admin/cash-to-banks*') || request()->is('admin/bank-to-banks*') || request()->is('admin/adjust-bank-balances*') ? 'bg-primary-50 text-primary-700' : 'text-gray-600' }}">
                    <span class="flex items-center">
                        <i class="fas fa-cogs w-4 mr-3 {{ request()->is('admin/bank-to-cashes*') || request()->is('admin/cash-to-banks*') || request()->is('admin/bank-to-banks*') || request()->is('admin/adjust-bank-balances*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                        <span>{{ trans('cruds.depositWithdraw.title') }}</span>
                    </span>
                    <i class="fas transform transition-transform duration-300 text-xs" 
                       :class="dwOpen ? 'fa-chevron-up text-primary-600' : 'fa-chevron-down text-primary-400'"></i>
                </button>

                <!-- Nested Items -->
                <div x-show="dwOpen" x-collapse.duration.300ms class="ml-8 space-y-2 mt-2">

                    @can('bank_to_cash_access')
                    <a href="{{ route('admin.bank-to-cashes.index') }}" 
                       class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                              hover:bg-primary-50 hover:pl-4 font-medium 
                              {{ request()->is('admin/bank-to-cashes*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                        <i class="fas fa-money-check-alt w-4 mr-3 {{ request()->is('admin/bank-to-cashes*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                        <span>{{ trans('cruds.bankToCash.title') }}</span>
                    </a>
                    @endcan

                    @can('cash_to_bank_access')
                    <a href="{{ route('admin.cash-to-banks.index') }}" 
                       class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                              hover:bg-primary-50 hover:pl-4 font-medium 
                              {{ request()->is('admin/cash-to-banks*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                        <i class="fas fa-money-check-alt w-4 mr-3 {{ request()->is('admin/cash-to-banks*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                        <span>{{ trans('cruds.cashToBank.title') }}</span>
                    </a>
                    @endcan

                    @can('bank_to_bank_access')
                    <a href="{{ route('admin.bank-to-banks.index') }}" 
                       class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                              hover:bg-primary-50 hover:pl-4 font-medium 
                              {{ request()->is('admin/bank-to-banks*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                        <i class="fas fa-money-check-alt w-4 mr-3 {{ request()->is('admin/bank-to-banks*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                        <span>{{ trans('cruds.bankToBank.title') }}</span>
                    </a>
                    @endcan

                    @can('adjust_bank_balance_access')
                    <a href="{{ route('admin.adjust-bank-balances.index') }}" 
                       class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                              hover:bg-primary-50 hover:pl-4 font-medium 
                              {{ request()->is('admin/adjust-bank-balances*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                        <i class="fas fa-money-check-alt w-4 mr-3 {{ request()->is('admin/adjust-bank-balances*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                        <span>{{ trans('cruds.adjustBankBalance.title') }}</span>
                    </a>
                    @endcan

                </div>
            </div>
            @endcan

        </div>
    </div>
</div>
@endcan


@can('master_data_access')
<div class="space-y-1 mt-4">
    <!-- Section Heading -->
    <div class="px-3 py-2 text-xs font-semibold text-primary-500 uppercase tracking-wider">
        {{ trans('cruds.masterData.title') }}
    </div>

    <!-- Dropdown -->
    <div x-data="{ masterOpen: {{ request()->is('admin/user-alerts*') || request()->is('admin/units*') || request()->is('admin/categories*') || request()->is('admin/tax-rates*') ? 'true' : 'false' }} }" 
         class="rounded-xl overflow-hidden">

        <!-- Parent Button -->
        <button @click="masterOpen = !masterOpen" 
            class="flex items-center justify-between w-full px-4 py-3 rounded-xl transition-all duration-200 
                   hover:bg-primary-100 hover:shadow-sm hover:pl-5"
            :class="masterOpen ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-700 font-medium'">
            
            <span class="flex items-center">
                <div class="p-2 rounded-lg transition-colors"
                    :class="masterOpen ? 'bg-primary-600 text-white' : 'bg-primary-100 text-primary-600'">
                    <i class="fas fa-cogs w-5"></i>
                </div>
                <span class="ml-3">{{ trans('cruds.masterData.title') }}</span>
            </span>

            <i class="fas transform transition-transform duration-300 text-xs"
                :class="masterOpen ? 'fa-chevron-up text-primary-600' : 'fa-chevron-down text-primary-400'"></i>
        </button>

        <!-- Dropdown Items -->
        <div x-show="masterOpen" x-collapse.duration.300ms class="ml-9 space-y-2 mt-2">

            @can('user_alert_access')
                <a href="{{ route('admin.user-alerts.index') }}"
                   class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200 
                          hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                          {{ request()->is('admin/user-alerts*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                    <i class="fas fa-bell w-4 mr-3 {{ request()->is('admin/user-alerts*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                    <span>{{ trans('cruds.userAlert.title') }}</span>
                </a>
            @endcan

            @can('unit_access')
                <a href="{{ route('admin.units.index') }}"
                   class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200 
                          hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                          {{ request()->is('admin/units*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                    <i class="fas fa-universal-access w-4 mr-3 {{ request()->is('admin/units*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                    <span>{{ trans('cruds.unit.title') }}</span>
                </a>
            @endcan

            @can('category_access')
                <a href="{{ route('admin.categories.index') }}"
                   class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200 
                          hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                          {{ request()->is('admin/categories*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                    <i class="fas fa-cart-arrow-down w-4 mr-3 {{ request()->is('admin/categories*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                    <span>{{ trans('cruds.category.title') }}</span>
                </a>
            @endcan

            @can('tax_rate_access')
                <a href="{{ route('admin.tax-rates.index') }}"
                   class="flex items-center px-3 py-2.5 text-sm rounded-lg transition-all duration-200 
                          hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                          {{ request()->is('admin/tax-rates*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                    <i class="fas fa-cogs w-4 mr-3 {{ request()->is('admin/tax-rates*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                    <span>{{ trans('cruds.taxRate.title') }}</span>
                </a>
            @endcan

        </div>
    </div>
</div>
@endcan


@can('report_access')
<div class="space-y-1 mt-4">
    <!-- Section Heading -->
    <div class="px-3 py-2 text-xs font-semibold text-primary-500 uppercase tracking-wider">
        {{ trans('cruds.report.title') }}
    </div>

    <!-- Main Dropdown -->
    <div x-data="{ reportOpen: {{ request()->is('admin/sale-reports*') || request()->is('admin/purchase-reports*') || request()->is('admin/day-books*') || request()->is('admin/all-transactions*') || request()->is('admin/profit-losses*') || request()->is('admin/bill-wise-profits*') || request()->is('admin/balance-sheets*') ? 'true' : 'false' }} }" 
         class="rounded-xl overflow-hidden">

        <!-- Parent Button -->
        <button @click="reportOpen = !reportOpen" 
            class="flex items-center justify-between w-full px-4 py-3 rounded-xl transition-all duration-200 
                   hover:bg-primary-100 hover:shadow-sm hover:pl-5"
            :class="reportOpen ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-700 font-medium'">

            <span class="flex items-center">
                <div class="p-2 rounded-lg transition-colors"
                    :class="reportOpen ? 'bg-primary-600 text-white' : 'bg-primary-100 text-primary-600'">
                    <i class="far fa-address-card w-5"></i>
                </div>
                <span class="ml-3">{{ trans('cruds.report.title') }}</span>
            </span>

            <i class="fas transform transition-transform duration-300 text-xs"
                :class="reportOpen ? 'fa-chevron-up text-primary-600' : 'fa-chevron-down text-primary-400'"></i>
        </button>

        <!-- Dropdown Items -->
        <div x-show="reportOpen" x-collapse.duration.300ms class="ml-9 space-y-2 mt-2">

            @can('transaction_report_access')
            <div x-data="{ transactionOpen: {{ request()->is('admin/sale-reports*') || request()->is('admin/purchase-reports*') || request()->is('admin/day-books*') || request()->is('admin/all-transactions*') || request()->is('admin/profit-losses*') || request()->is('admin/bill-wise-profits*') || request()->is('admin/balance-sheets*') ? 'true' : 'false' }} }">
                
                <!-- Sub Dropdown Button -->
                <button @click="transactionOpen = !transactionOpen"
                    class="flex items-center justify-between w-full px-3 py-2.5 rounded-lg transition-all duration-200 
                           hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                           {{ request()->is('admin/sale-reports*') || request()->is('admin/purchase-reports*') || request()->is('admin/day-books*') || request()->is('admin/all-transactions*') || request()->is('admin/profit-losses*') || request()->is('admin/bill-wise-profits*') || request()->is('admin/balance-sheets*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                    
                    <span class="flex items-center">
                        <i class="fas fa-exchange-alt w-4 mr-3"></i>
                        <span>{{ trans('cruds.transactionReport.title') }}</span>
                    </span>

                    <i class="fas transform transition-transform duration-300 text-xs"
                        :class="transactionOpen ? 'fa-chevron-up text-primary-600' : 'fa-chevron-down text-primary-400'"></i>
                </button>

                <!-- Nested Items -->
                <div x-show="transactionOpen" x-collapse.duration.300ms class="ml-7 mt-2 space-y-2">
                    @can('sale_report_access')
                        <a href="{{ route('admin.sale-reports.index') }}"
                           class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                                  hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                                  {{ request()->is('admin/sale-reports*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                            <i class="fas fa-bookmark w-4 mr-3 {{ request()->is('admin/sale-reports*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                            <span>{{ trans('cruds.saleReport.title') }}</span>
                        </a>
                    @endcan

                    @can('purchase_report_access')
                        <a href="{{ route('admin.purchase-reports.index') }}"
                           class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                                  hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                                  {{ request()->is('admin/purchase-reports*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                            <i class="fas fa-shopping-cart w-4 mr-3 {{ request()->is('admin/purchase-reports*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                            <span>{{ trans('cruds.purchaseReport.title') }}</span>
                        </a>
                    @endcan

                    @can('day_book_access')
                        <a href="{{ route('admin.day-books.index') }}"
                           class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                                  hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                                  {{ request()->is('admin/day-books*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                            <i class="fas fa-book w-4 mr-3 {{ request()->is('admin/day-books*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                            <span>{{ trans('cruds.dayBook.title') }}</span>
                        </a>
                    @endcan

                    @can('all_transaction_access')
                        <a href="{{ route('admin.all-transactions.index') }}"
                           class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                                  hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                                  {{ request()->is('admin/all-transactions*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                            <i class="fas fa-exchange-alt w-4 mr-3 {{ request()->is('admin/all-transactions*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                            <span>{{ trans('cruds.allTransaction.title') }}</span>
                        </a>
                    @endcan

                    @can('profit_loss_access')
                        <a href="{{ route('admin.profit-losses.index') }}"
                           class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                                  hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                                  {{ request()->is('admin/profit-losses*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                            <i class="fab fa-gratipay w-4 mr-3 {{ request()->is('admin/profit-losses*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                            <span>{{ trans('cruds.profitLoss.title') }}</span>
                        </a>
                    @endcan

                    @can('bill_wise_profit_access')
                        <a href="{{ route('admin.bill-wise-profits.index') }}"
                           class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                                  hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                                  {{ request()->is('admin/bill-wise-profits*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                            <i class="fas fa-file-invoice w-4 mr-3 {{ request()->is('admin/bill-wise-profits*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                            <span>{{ trans('cruds.billWiseProfit.title') }}</span>
                        </a>
                    @endcan

                    @can('balance_sheet_access')
                        <a href="{{ route('admin.balance-sheets.index') }}"
                           class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                                  hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                                  {{ request()->is('admin/balance-sheets*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                            <i class="fas fa-balance-scale w-4 mr-3 {{ request()->is('admin/balance-sheets*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                            <span>{{ trans('cruds.balanceSheet.title') }}</span>
                        </a>
                    @endcan
                </div>
            </div>
            @endcan

          {{-- Party Reports --}}
@can('party_report_access')
<div x-data="{ partyOpen: {{ request()->is('admin/party-statements*') || request()->is('admin/party-wise-profit-losses*') || request()->is('admin/all-parties*') || request()->is('admin/party-report-by-items*') || request()->is('admin/sale-purchase-by-parties*') ? 'true' : 'false' }} }" class="rounded-xl overflow-hidden">
    
    <!-- Dropdown Button -->
    <button @click="partyOpen = !partyOpen"
        class="flex items-center justify-between w-full px-4 py-2.5 rounded-lg hover:bg-primary-50 transition-all duration-200 font-medium
               {{ request()->is('admin/party-statements*') || request()->is('admin/party-wise-profit-losses*') || request()->is('admin/all-parties*') || request()->is('admin/party-report-by-items*') || request()->is('admin/sale-purchase-by-parties*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-700' }}">
        <div class="flex items-center">
            <i class="fas fa-user-friends w-5 mr-2"></i>
            <span>{{ trans('cruds.partyReport.title') }}</span>
        </div>
        <i :class="partyOpen ? 'fas fa-chevron-up text-primary-600' : 'fas fa-chevron-down text-gray-400'" class="text-sm"></i>
    </button>

    <!-- Nested Items -->
    <div x-show="partyOpen" x-collapse.duration.300ms class="mt-1 ml-6 space-y-1">
        @can('party_statement_access')
            <a href="{{ route('admin.party-statements.index') }}"
               class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-150 hover:bg-primary-50
                      {{ request()->is('admin/party-statements*') ? 'bg-primary-100 text-primary-700 font-semibold' : 'text-gray-600' }}">
                <i class="fas fa-file-alt w-4 mr-2 {{ request()->is('admin/party-statements*') ? 'text-primary-600' : 'text-gray-400' }}"></i>
                <span>{{ trans('cruds.partyStatement.title') }}</span>
            </a>
        @endcan

        @can('party_wise_profit_loss_access')
            <a href="{{ route('admin.party-wise-profit-losses.index') }}"
               class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-150 hover:bg-primary-50
                      {{ request()->is('admin/party-wise-profit-losses*') ? 'bg-primary-100 text-primary-700 font-semibold' : 'text-gray-600' }}">
                <i class="fas fa-chart-line w-4 mr-2 {{ request()->is('admin/party-wise-profit-losses*') ? 'text-primary-600' : 'text-gray-400' }}"></i>
                <span>{{ trans('cruds.partyWiseProfitLoss.title') }}</span>
            </a>
        @endcan

        @can('all_party_access')
            <a href="{{ route('admin.all-parties.index') }}"
               class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-150 hover:bg-primary-50
                      {{ request()->is('admin/all-parties*') ? 'bg-primary-100 text-primary-700 font-semibold' : 'text-gray-600' }}">
                <i class="fas fa-users w-4 mr-2 {{ request()->is('admin/all-parties*') ? 'text-primary-600' : 'text-gray-400' }}"></i>
                <span>{{ trans('cruds.allParty.title') }}</span>
            </a>
        @endcan

        @can('party_report_by_item_access')
            <a href="{{ route('admin.party-report-by-items.index') }}"
               class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-150 hover:bg-primary-50
                      {{ request()->is('admin/party-report-by-items*') ? 'bg-primary-100 text-primary-700 font-semibold' : 'text-gray-600' }}">
                <i class="fas fa-boxes w-4 mr-2 {{ request()->is('admin/party-report-by-items*') ? 'text-primary-600' : 'text-gray-400' }}"></i>
                <span>{{ trans('cruds.partyReportByItem.title') }}</span>
            </a>
        @endcan

        @can('sale_purchase_by_party_access')
            <a href="{{ route('admin.sale-purchase-by-parties.index') }}"
               class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-150 hover:bg-primary-50
                      {{ request()->is('admin/sale-purchase-by-parties*') ? 'bg-primary-100 text-primary-700 font-semibold' : 'text-gray-600' }}">
                <i class="fas fa-random w-4 mr-2 {{ request()->is('admin/sale-purchase-by-parties*') ? 'text-primary-600' : 'text-gray-400' }}"></i>
                <span>{{ trans('cruds.salePurchaseByParty.title') }}</span>
            </a>
        @endcan
    </div>
</div>
@endcan

{{-- Party Reports --}}
@can('party_report_access')
<div x-data="{ partyOpen: {{ request()->is('admin/party-statements*') || request()->is('admin/party-wise-profit-losses*') || request()->is('admin/all-parties*') || request()->is('admin/party-report-by-items*') || request()->is('admin/sale-purchase-by-parties*') ? 'true' : 'false' }} }" class="rounded-xl overflow-hidden">

    <!-- Dropdown Button -->
    <button @click="partyOpen = !partyOpen"
        class="flex items-center justify-between w-full px-3 py-2.5 rounded-lg transition-all duration-200
               hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
               {{ request()->is('admin/party-statements*') || request()->is('admin/party-wise-profit-losses*') || request()->is('admin/all-parties*') || request()->is('admin/party-report-by-items*') || request()->is('admin/sale-purchase-by-parties*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">

        <span class="flex items-center">
            <i class="fas fa-user-friends w-4 mr-3"></i>
            <span>{{ trans('cruds.partyReport.title') }}</span>
        </span>

        <i class="fas transform transition-transform duration-300 text-xs"
           :class="partyOpen ? 'fa-chevron-up text-primary-600' : 'fa-chevron-down text-primary-400'"></i>
    </button>

    <!-- Nested Items -->
    <div x-show="partyOpen" x-collapse.duration.300ms class="ml-7 mt-2 space-y-2">
        @can('party_statement_access')
            <a href="{{ route('admin.party-statements.index') }}"
               class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                      hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                      {{ request()->is('admin/party-statements*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                <i class="fas fa-file-alt w-4 mr-3 {{ request()->is('admin/party-statements*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                <span>{{ trans('cruds.partyStatement.title') }}</span>
            </a>
        @endcan

        @can('party_wise_profit_loss_access')
            <a href="{{ route('admin.party-wise-profit-losses.index') }}"
               class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                      hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                      {{ request()->is('admin/party-wise-profit-losses*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                <i class="fas fa-chart-line w-4 mr-3 {{ request()->is('admin/party-wise-profit-losses*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                <span>{{ trans('cruds.partyWiseProfitLoss.title') }}</span>
            </a>
        @endcan

        @can('all_party_access')
            <a href="{{ route('admin.all-parties.index') }}"
               class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                      hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                      {{ request()->is('admin/all-parties*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                <i class="fas fa-users w-4 mr-3 {{ request()->is('admin/all-parties*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                <span>{{ trans('cruds.allParty.title') }}</span>
            </a>
        @endcan

        @can('party_report_by_item_access')
            <a href="{{ route('admin.party-report-by-items.index') }}"
               class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                      hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                      {{ request()->is('admin/party-report-by-items*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                <i class="fas fa-boxes w-4 mr-3 {{ request()->is('admin/party-report-by-items*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                <span>{{ trans('cruds.partyReportByItem.title') }}</span>
            </a>
        @endcan

        @can('sale_purchase_by_party_access')
            <a href="{{ route('admin.sale-purchase-by-parties.index') }}"
               class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                      hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                      {{ request()->is('admin/sale-purchase-by-parties*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                <i class="fas fa-random w-4 mr-3 {{ request()->is('admin/sale-purchase-by-parties*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                <span>{{ trans('cruds.salePurchaseByParty.title') }}</span>
            </a>
        @endcan
    </div>
</div>
@endcan


{{-- Stock Reports --}}
@can('stock_report_access')
<div x-data="{ stockOpen: {{ request()->is('admin/stocks-summaries*') || request()->is('admin/item-report-by-parties*') || request()->is('admin/item-wise-profit-and-loasses*') || request()->is('admin/low-stock-summaries*') || request()->is('admin/stock-details*') ? 'true' : 'false' }} }">

    <!-- Dropdown Button -->
    <button @click="stockOpen = !stockOpen"
        class="flex items-center justify-between w-full px-3 py-2.5 rounded-lg transition-all duration-200
               hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
               {{ request()->is('admin/stocks-summaries*') || request()->is('admin/item-report-by-parties*') || request()->is('admin/item-wise-profit-and-loasses*') || request()->is('admin/low-stock-summaries*') || request()->is('admin/stock-details*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
        
        <span class="flex items-center">
            <i class="fas fa-box w-4 mr-3"></i>
            <span>{{ trans('cruds.stockReport.title') }}</span>
        </span>

        <i class="fas transform transition-transform duration-300 text-xs"
           :class="stockOpen ? 'fa-chevron-up text-primary-600' : 'fa-chevron-down text-primary-400'"></i>
    </button>

    <!-- Nested Items -->
    <div x-show="stockOpen" x-collapse.duration.300ms class="ml-7 mt-2 space-y-2">
        @can('stocks_summary_access')
            <a href="{{ route('admin.stocks-summaries.index') }}"
               class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                      hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                      {{ request()->is('admin/stocks-summaries*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                <i class="fas fa-chart-pie w-4 mr-3 {{ request()->is('admin/stocks-summaries*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                <span>{{ trans('cruds.stocksSummary.title') }}</span>
            </a>
        @endcan

        @can('item_report_by_party_access')
            <a href="{{ route('admin.item-report-by-parties.index') }}"
               class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                      hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                      {{ request()->is('admin/item-report-by-parties*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                <i class="fas fa-users w-4 mr-3 {{ request()->is('admin/item-report-by-parties*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                <span>{{ trans('cruds.itemReportByParty.title') }}</span>
            </a>
        @endcan

        @can('item_wise_profit_and_loass_access')
            <a href="{{ route('admin.item-wise-profit-and-loasses.index') }}"
               class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                      hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                      {{ request()->is('admin/item-wise-profit-and-loasses*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                <i class="fas fa-dollar-sign w-4 mr-3 {{ request()->is('admin/item-wise-profit-and-loasses*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                <span>{{ trans('cruds.itemWiseProfitAndLoass.title') }}</span>
            </a>
        @endcan

        @can('low_stock_summary_access')
            <a href="{{ route('admin.low-stock-summaries.index') }}"
               class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                      hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                      {{ request()->is('admin/low-stock-summaries*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                <i class="fas fa-exclamation-triangle w-4 mr-3 {{ request()->is('admin/low-stock-summaries*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                <span>{{ trans('cruds.lowStockSummary.title') }}</span>
            </a>
        @endcan

        @can('stock_detail_access')
            <a href="{{ route('admin.stock-details.index') }}"
               class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200 
                      hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                      {{ request()->is('admin/stock-details*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                <i class="fas fa-clipboard-list w-4 mr-3 {{ request()->is('admin/stock-details*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                <span>{{ trans('cruds.stockDetail.title') }}</span>
            </a>
        @endcan
    </div>
</div>
@endcan

{{-- Expense Reports --}}
@can('expense_report_access')
<div x-data="{ expenseOpen: {{ request()->is('admin/expense-report-lists*') || request()->is('admin/expense-category-reports*') || request()->is('admin/expense-item-reports*') ? 'true' : 'false' }} }" class="rounded-xl overflow-hidden">

    <!-- Dropdown Button -->
    <button @click="expenseOpen = !expenseOpen"
        class="flex items-center justify-between w-full px-3 py-2.5 rounded-lg transition-all duration-200
               hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
               {{ request()->is('admin/expense-report-lists*') || request()->is('admin/expense-category-reports*') || request()->is('admin/expense-item-reports*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
        
        <span class="flex items-center">
            <i class="fas fa-wallet w-4 mr-3"></i>
            <span>{{ trans('cruds.expenseReport.title') }}</span>
        </span>

        <i class="fas transform transition-transform duration-300 text-xs"
           :class="expenseOpen ? 'fa-chevron-up text-primary-600' : 'fa-chevron-down text-primary-400'"></i>
    </button>

    <!-- Nested Items -->
    <div x-show="expenseOpen" x-collapse.duration.300ms class="ml-7 mt-2 space-y-2">
        @can('expense_report_list_access')
            <a href="{{ route('admin.expense-report-lists.index') }}"
               class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200
                      hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                      {{ request()->is('admin/expense-report-lists*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                <i class="fas fa-list w-4 mr-3 {{ request()->is('admin/expense-report-lists*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                <span>{{ trans('cruds.expenseReportList.title') }}</span>
            </a>
        @endcan

        @can('expense_category_report_access')
            <a href="{{ route('admin.expense-category-reports.index') }}"
               class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200
                      hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                      {{ request()->is('admin/expense-category-reports*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                <i class="fas fa-tags w-4 mr-3 {{ request()->is('admin/expense-category-reports*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                <span>{{ trans('cruds.expenseCategoryReport.title') }}</span>
            </a>
        @endcan

        @can('expense_item_report_access')
            <a href="{{ route('admin.expense-item-reports.index') }}"
               class="flex items-center px-3 py-2 text-sm rounded-lg transition-all duration-200
                      hover:bg-primary-50 hover:shadow-xs hover:pl-4 font-medium
                      {{ request()->is('admin/expense-item-reports*') ? 'bg-primary-100 text-primary-700 shadow-sm' : 'text-gray-600' }}">
                <i class="fas fa-box w-4 mr-3 {{ request()->is('admin/expense-item-reports*') ? 'text-primary-600' : 'text-primary-500' }}"></i>
                <span>{{ trans('cruds.expenseItemReport.title') }}</span>
            </a>
        @endcan
    </div>
</div>
@endcan



        </div>
    </div>
</div>
@endcan





          
    </aside>

<!-- Alpine.js for toggle -->
<script src="//unpkg.com/alpinejs" defer></script>
