<?php

namespace App\Http\Controllers;

use App\Package;
use App\User;
use App\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::with(['user:id,name', 'customer:id,name', 'package', 'menus'])->latest()->get();
        if ($request->ajax()) {
          return Datatables::of($orders)
              ->addIndexColumn()
              ->make(true);
        }

        return view('pages.order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = User::where('role', 'user')->get();
        $packages = Package::all();
        return view('pages.order.create', [
            'customers' => $customers,
            'packages' => $packages,
            'error' => false
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = auth()->user();
        $customer = User::find($request->customer);
        $orderCount = Order::whereDate('created_at', '=', date('Y-m-d'))->count();
        $code = "PKG".sprintf('%02d', $request->package).date("dmy").sprintf('%04d', $orderCount + 1);
        $clock = date("H.i", time());
        if ($clock <= 19.30) {
            try {
                $order = Order::create([
                    'code' => $code,
                    'payment_method' => $request->payment_method,
                    'kecamatan' => $request->kecamatan,
                    'kelurahan' => $request->kelurahan,
                    'jalan' => $request->jalan,
                    'address_notes' => $request->address_notes,
                    'package_id' => $request->package,
                    'user_id' => $admin->id,
                    'customer_id' => $customer->id,
                ]);
                return redirect(route('order.index'));
            } catch (\Throwable $th) {
                return abort(400, $th);
            }
        } else {
          return redirect('order')->with('status', "Sorry we're out today...");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with(['menus', 'package:id,name', 'customer:id,name'])->find($id);
        return view('pages.order.show', [
            'order' => $order,
            'items' => $order->menus,
            'customer' => $order->customer,
            'package' => $order->package
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $customers = User::where('role', 'user')->get();
        $packages = Package::all();

        return view('pages.order.edit', [
            'order' => $order,
            'customers' => $customers,
            'packages' => $packages,
            'staus' => $order->daftarStatus,
            'error' => false
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = auth()->user();
        $order = Order::find($id);

        try {
          $result = $order->update([
              'payment_method' => $request->payment_method,
              'kecamatan' => $request->kecamatan,
              'kelurahan' => $request->kelurahan,
              'status' => $request->status,
              'jalan' => $request->jalan,
              'address_notes' => $request->address_notes,
              'package_id' => $request->package,
              'user_id' => $admin->id,
          ]);
          if ($result) {
            return redirect(route('order.index'));
          }
        } catch (\Throwable $th) {
          return abort(400, $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
