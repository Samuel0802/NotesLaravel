@extends('layouts.main_layout')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col">


      @include('top_bar')



            <!-- label and cancel -->
            <div class="row">
                <div class="col">
                    <p class="display-6 mb-0">NOVA NOTA</p>
                </div>
                <div class="col text-end">
                    <a href="{{ route('home') }}" class="btn btn-outline-danger">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </div>
            </div>



            <!-- form -->
            <form action="{{ route('newSubmit') }}" method="post">
                @csrf
                <div class="row mt-3">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Titulo</label>
                            <input type="text" class="form-control bg-primary text-white" name="title" value="{{ old('title') }}">

                            @error('title')
                                <div class="text-danger">
                                      {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nota</label>
                            <textarea class="form-control bg-primary text-white" name="text" rows="5" >{{ old('text') }}</textarea>

                            @error('text')
                            <div class="text-danger">
                                {{ $message }}
                            </div>

                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="col text-end">
                        <a href="{{ route('home') }}" class="btn btn-primary px-5"><i class="fa-solid fa-ban me-2"></i>Cancelar</a>
                        <button type="submit" class="btn btn-secondary px-5"><i class="fa-regular fa-circle-check me-2"></i>Salvar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>



@endsection
