<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\DB;

trait CompanyScopeTrait
{
    /**
     * Get allowed created_by_ids for current company
     * (Company Admin + Logged-in User)
     */
    protected function getCompanyAllowedUserIds(): array
    {
        $user = auth()->user();

        // Selected company
        $company = $user->select_companies()->first();

        if (! $company) {
            return [$user->id];
        }

        // All users of company
        $companyUserIds = DB::table('add_business_user')
            ->where('add_business_id', $company->id)
            ->pluck('user_id')
            ->toArray();

        // Company Admin
        $companyAdminId = User::whereIn('id', $companyUserIds)
            ->whereHas('roles', fn ($q) => $q->where('title', 'Admin'))
            ->value('id');

        // Allowed IDs = Admin + Login user
        return collect([$companyAdminId, $user->id])
            ->filter()
            ->unique()
            ->values()
            ->toArray();
    }
}
