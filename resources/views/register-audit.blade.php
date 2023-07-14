@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Cadastrar Auditoria</div>
                <div class="card-body">
                    <form class="d-flex" action="/store" method="POST" enctype="multipart/form-data">
                        
                        @csrf
                        
                        <div class="row justify-content-center">
                            <div class="form-group mb-4 col-12 col-lg-4">
                                <label for="users">Escolha um devedor:</label>
                                <select name="deptor_id" id="user">
                                    @foreach($users ?? [] as $user)
                                        <option value={{ $user->id }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-4 col-12 col-lg-4">
                                <input name="screenshot" type="file" accept="image/*">
                            </div>

                            <div class="form-group mb-4 col-12 col-lg-4">
                                <button class="btn btn-success" type="submit">Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection