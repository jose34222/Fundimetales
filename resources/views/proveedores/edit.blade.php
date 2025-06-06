@extends('layouts.app', ['title' => 'Editar Proveedor'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Editar Proveedor</h4>
                        <p class="card-category">Modifique los datos necesarios</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Nombre*</label>
                                        <input type="text" name="nombre" class="form-control" 
                                               value="{{ $proveedor->nombre }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Identificación*</label>
                                        <input type="text" name="identificacion" class="form-control" 
                                               value="{{ $proveedor->identificacion }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Teléfono*</label>
                                        <input type="text" name="telefono" class="form-control" 
                                               value="{{ $proveedor->telefono }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Email</label>
                                        <input type="email" name="email" class="form-control" 
                                               value="{{ $proveedor->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Dirección</label>
                                        <textarea name="direccion" class="form-control" rows="2">{{ $proveedor->direccion }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary pull-right">Actualizar</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection