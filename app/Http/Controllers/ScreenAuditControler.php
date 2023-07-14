<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ScreenAudit as ControllersScreenAudit;
use App\Models\ScreenAudit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class ScreenAuditControler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {

        $audits = ScreenAudit::where('payed_at', null)
            ->with('deptor')
            ->with('admin')
            ->get();
        
        $audits->map(function ($audit) {
            $audit->screenshot_path = URL::asset(Storage::url($audit->screenshot_path));
        });

        return view('audits', compact('audits'));
    }

    public function create() {
        
        $users = User::get();
        return view('register-audit', compact('users'));
    }

    public function store() {

        ScreenAudit::create([
            'screenshot_path' => Request::hasFile('screenshot') ? Request::file('screenshot')->store('public/screenAudit') : '',
            'deptor_id' => Request::post('deptor_id'),
            'admin_id' => Auth::user()->id
        ]);

        return redirect()->back()->with('success', 'O cadastro foi um sucesso.');
    }

    public function confirmPayment(ScreenAudit $screenAudit) {

        if(!Auth::user()->isAdmin) {
            return redirect()->back()->with('error', 'Você não é administrador para confirmar pagamentos.');
        }

        $screenAudit->payed_at = Carbon::now();
        $screenAudit->save();
        
        return redirect()->back()->with('success', 'Pagamento da Pizza Confirmado.');
    }

    public function show(ScreenAudit $screenAudit) {
        $screenAudit = ScreenAudit::find($screenAudit->id)->where('payed_at', null)
            ->with('deptor')
            ->with('admin')
            ->first();

        $screenAudit->screenshot_path = URL::asset(Storage::url($screenAudit->screenshot_path));
        return view('audit-detail', compact('screenAudit'));
    }
}   
