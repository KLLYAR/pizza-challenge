@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pizzas Pendentes</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            {{ $screenAudit->deptor->name ?? 'Sem devedor' }}
                        </div>
                        <div class="col-12 col-md-6 justify-text-end">
                            {{ $screenAudit->admin->name ?? 'Sem cobrador' }}
                        </div>
                    </div>
                    <div class="" style="max-width: 50em;">
                        <img src={{ $screenAudit->screenshot_path ?? '' }} alt="" style="width: 100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection