<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::orderBy('id', 'asc')->get();

        return view('admin.accounts.index', compact('accounts'));
    }

    public function destroy(string $id)
    {
        //
    }
}
