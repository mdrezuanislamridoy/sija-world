<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public const PERMISSIONS = [
        'manage_products' => 'Manage Products (/admin/products)',
        'manage_orders' => 'Manage Orders (/admin/orders)',
        'manage_categories' => 'Manage Categories (/admin/categories)',
        'manage_sliders' => 'Manage Sliders & Banners (/admin/sliders)',
        'manage_settings' => 'Manage Site Settings (/admin/settings)',
        'manage_admins' => 'Manage Admin Staff & Roles (/admin/users)',
    ];

    public function index()
    {
        $admins = Admin::orderBy('id', 'desc')->get();
        $allPermissions = self::PERMISSIONS;

        return view('admin.users.index', compact('admins', 'allPermissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:admins,email',
            'phone' => 'nullable|string|max:50',
            'password' => 'required|string|min:6',
            'role' => 'required|string|in:super_admin,sub_admin',
            'permissions' => 'nullable|array',
        ]);

        Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'permissions' => $validated['role'] === 'super_admin' ? array_keys(self::PERMISSIONS) : ($validated['permissions'] ?? []),
            'status' => 1,
        ]);

        return back()->with('success', 'New Admin user created successfully with assigned permissions!');
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:admins,email,' . $id,
            'phone' => 'nullable|string|max:50',
            'password' => 'nullable|string|min:6',
            'role' => 'required|string|in:super_admin,sub_admin',
            'permissions' => 'nullable|array',
            'status' => 'required|boolean',
        ]);

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => $validated['role'],
            'permissions' => $validated['role'] === 'super_admin' ? array_keys(self::PERMISSIONS) : ($validated['permissions'] ?? []),
            'status' => $validated['status'],
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        $admin->update($updateData);

        return back()->with('success', 'Admin user and permissions updated successfully!');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);

        // Prevent self deletion
        if (Auth::guard('admin')->id() == $admin->id) {
            return back()->with('error', 'Action prohibited: You cannot delete your own admin account while logged in.');
        }

        // Prevent deleting the last super_admin
        if ($admin->isSuperAdmin() && Admin::where('role', 'super_admin')->count() <= 1) {
            return back()->with('error', 'Action prohibited: At least one Superadmin must remain in the system.');
        }

        $admin->delete();

        return back()->with('success', 'Admin user deleted successfully.');
    }
}
