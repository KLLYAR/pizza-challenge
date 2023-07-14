@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-4">
            <div class="row justify-content-end">
                <div class="col-12">
                    <a 
                        class="btn btn-primary"
                        href="/create">
                        
                        Cadastrar Tela Desbloqueada
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pizzas Pendentes</div>

                <div class="card-body">
                    @if($audits)
                    <table id="pendent_pizzas">
                        <thead>
                            <th>Nome</th>
                            <th>Screenshot</th>
                        </thead>
                        <tbody>
                            @foreach($audits ?? [] as $audit) 
                            <div>
                                <td>{{ $audit->deptor->name ?? 'John Doe' }}</td>
                                <td><img src={{ $audit->screenshot_path }} alt=""></td>
                                <td>{{ $audit->hasRefri ? 'Deve um Refrigerante' : '' }}</td>
                                <td>
                                    <form action="/confirm-payment/{{$audit->id}}" method="POST">
                                        @csrf
                                        <button class="btn btn-success" type="submit">
                                            Confirmar Pagamento
                                        </button>
                                    </form>
                                </td>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    let dad = new Datatable('pendent_pizzas');
</script>