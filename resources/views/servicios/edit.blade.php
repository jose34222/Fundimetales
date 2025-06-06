@extends('layouts.app', ['title' => 'Editar Servicio'])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Editar Servicio</h4>
                        <p class="card-category">Modifique los datos necesarios</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('servicios.update', $servicio->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Código*</label>
                                        <input type="text" name="codigo" class="form-control" 
                                               value="{{ $servicio->codigo }}" required>
                                        <small class="text-muted">Código único identificador del servicio</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Nombre*</label>
                                        <input type="text" name="nombre" class="form-control" 
                                               value="{{ $servicio->nombre }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Precio*</label>
                                        <input type="number" step="0.01" name="precio" class="form-control" 
                                               value="{{ $servicio->precio }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Descripción</label>
                                        <textarea name="descripcion" class="form-control" rows="3">{{ $servicio->descripcion }}</textarea>
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