<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalSales = DB::table('orders')->sum('final_amount');
        $ordersCount = DB::table('orders')->count();
        $customersCount = User::where('role', 'customer')->orWhere('role_type', 'Customer')->count();
        $productsCount = DB::table('products')->count();
        $activeCoupons = Coupon::where('status', 'Active')->count();
        $latestOrders = DB::table('orders')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalSales',
            'ordersCount',
            'customersCount',
            'productsCount',
            'activeCoupons',
            'latestOrders'
        ));
    }

    public function users()
    {
        $users = User::latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:30'],
            'role' => ['required', 'in:admin,customer,Admin,Customer,Support_Agent'],
        ]);

        $role = strtolower($request->role);
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'phone_number' => $request->phone,
            'role' => $role,
            'role_type' => ucfirst($role),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function deleteUser(User $user)
    {
        $user->delete();

        return back()->with('success', 'User deleted successfully');
    }

    public function coupons()
    {
        $coupons = Coupon::latest()->paginate(10);

        return view('admin.coupons.index', compact('coupons'));
    }

    public function createCoupon()
    {
        return view('admin.coupons.create');
    }

    public function storeCoupon(Request $request)
    {
        $data = $this->couponValidation($request);

        Coupon::create($data);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully');
    }

    public function editCoupon(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function updateCoupon(Request $request, Coupon $coupon)
    {
        $data = $this->couponValidation($request, $coupon->id);

        $coupon->update($data);

        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully');
    }

    public function deleteCoupon(Coupon $coupon)
    {
        $coupon->delete();

        return back()->with('success', 'Coupon deleted successfully');
    }

    private function couponValidation(Request $request, $couponId = null)
    {
        return $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:coupons,code,' . $couponId],
            'type' => ['required', 'in:Percentage,Fixed_Amount'],
            'value' => ['required', 'numeric', 'min:1'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'status' => ['required', 'in:Active,Expired,Disabled,Scheduled'],
        ]);
    }
}
