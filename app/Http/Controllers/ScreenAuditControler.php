<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ScreenAudit as ControllersScreenAudit;
use App\Models\ScreenAudit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ScreenAuditControler extends Controller
{
    public function index() {
        $audits = ScreenAudit::with('deptor')->with('admin')->get();
        $audits->map(function ($audit) {
            var_dump(URL::route('image', ['path' => $audit->screenshot_path]));
            
            // $audit->screenshot_path = 
        });

        return view('home', compact('audits'));
    }

    public function create() {
        $users = User::get();
        return view('register-audit', compact('users'));
    }

    public function store() {
        ScreenAudit::create([
            'screenshot_path' => Request::hasFile('screenshot') ? Request::file('screenshot')->store('screenAudits') : '',
            'deptor_id' => Request::post('deptor_id'),
            'admin_id' => Auth::user()->id
        ]);

        return redirect()->back()->with('success', 'O cadastro foi um sucesso.');
    }
}   
