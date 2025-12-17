<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait CompanyScopeTrait
{
    /**
     * Get all user IDs of the selected company
     * (Company Admin + All users under that admin)
     */
    protected function getCompanyAllowedUserIds(): array
    {
        $user = auth()->user();

        // Selected company
        $company = $user->select_companies()->first();

        // If no company selected, fallback to own data
        if (! $company) {
            return [$user->id];
        }

        /**
         * Get ALL users linked with this company
         * This includes:
         * - Company Admin
         * - All users created/assigned under admin
         */
        $companyUserIds = DB::table('add_business_user')
            ->where('add_business_id', $company->id)
            ->pluck('user_id')
            ->unique()
            ->toArray();

        return $companyUserIds;
    }
}
