<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\AddBusiness;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $loggedRole = auth()->user()->roles->pluck('title')->first();

        if ($loggedRole === 'Super Admin') {
            $users = User::with(['select_companies', 'roles', 'created_by'])->get();
        } else {
            $users = User::with(['select_companies', 'roles', 'created_by'])
                ->where('created_by_id', auth()->id())
                ->get();
        }

        return view('admin.users.index', compact('users'));
    }


    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $loggedUser = auth()->user();
        $loggedRole = $loggedUser->roles->pluck('title')->first();

        // ----- ROLE BASED CREATION -----
        if ($loggedRole === 'Super Admin') {
            $roles = Role::whereIn('title', ['Admin', 'Branch', 'User', 'Company'])->pluck('title', 'id');
        } elseif ($loggedRole === 'Admin') {
            $roles = Role::whereIn('title', ['Branch', 'User'])->pluck('title', 'id');
        } elseif ($loggedRole === 'Company') {
            $roles = Role::whereIn('title', ['User'])->pluck('title', 'id');
        } else {
            abort(Response::HTTP_FORBIDDEN, 'You do not have permission to create users.');
        }

        // ----- COMPANY DROPDOWN LOGIC -----
        if ($loggedRole === 'Super Admin') {
            // Super Admin → can see all companies
            $select_companies = AddBusiness::pluck('company_name', 'id');
            $selected_company = null; // No preselection
            $readonly_company = false;
        } else {
            // Admin or Company → only their assigned company
            $company = $loggedUser->select_companies->first(); // relationship ke through company le rahe hain
            $select_companies = $company ? [$company->id => $company->company_name] : [];
            $selected_company = $company ? $company->id : null;
            $readonly_company = true;
        }

        return view('admin.users.create', compact('roles', 'select_companies', 'selected_company', 'readonly_company'));
    }



    public function store(StoreUserRequest $request)
    {
        $loggedRole = auth()->user()->roles->pluck('title')->first();
        $selectedRoles = Role::whereIn('id', $request->input('roles', []))->pluck('title')->toArray();

        // Allowed roles
        if ($loggedRole === 'Super Admin') {
            $allowedRoles = ['Admin', 'Branch', 'User'];
        } elseif ($loggedRole === 'Admin') {
            $allowedRoles = ['Branch', 'User'];
        } else {
            abort(Response::HTTP_FORBIDDEN, 'You do not have permission to create users.');
        }

        foreach ($selectedRoles as $role) {
            if (!in_array($role, $allowedRoles)) {
                abort(Response::HTTP_FORBIDDEN, 'You cannot assign this role.');
            }
        }

        // Add created_by_id before saving
        $data = $request->all();
        $data['created_by_id'] = auth()->id();

        $user = User::create($data);
        $user->select_companies()->sync($request->input('select_companies', []));
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }


    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $select_companies = AddBusiness::pluck('company_name', 'id');

        $roles = Role::pluck('title', 'id');

        $user->load('select_companies', 'roles');

        return view('admin.users.edit', compact('roles', 'select_companies', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $loggedRole = auth()->user()->roles->pluck('title')->first();
        $selectedRoles = Role::whereIn('id', $request->input('roles', []))->pluck('title')->toArray();

        if ($loggedRole === 'Super Admin') {
            $allowedRoles = ['Admin', 'Branch', 'User'];
        } elseif ($loggedRole === 'Admin') {
            $allowedRoles = ['Branch', 'User'];
        } else {
            abort(Response::HTTP_FORBIDDEN, 'You do not have permission to update users.');
        }

        foreach ($selectedRoles as $role) {
            if (!in_array($role, $allowedRoles)) {
                abort(Response::HTTP_FORBIDDEN, 'You cannot assign this role.');
            }
        }

        $user->update($request->except('created_by_id')); // Prevent tampering
        $user->select_companies()->sync($request->input('select_companies', []));
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }


    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('select_companies', 'roles', 'userUserAlerts');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        $users = User::find(request('ids'));

        foreach ($users as $user) {
            $user->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
