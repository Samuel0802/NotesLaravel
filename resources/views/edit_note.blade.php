@extends('layouts.main_layout')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col">


      @include('top_bar')



            <!-- label and cancel -->
            <div class="row">
                <div class="col">
                    <p class="display-6 mb-0">EDITAR NOTA</p>
                </div>
                <div class="col text-end">
                    <a href="{{ route('home') }}" class="btn btn-outline-danger">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                </div>
            </div>

            <!-- form -->
            <form action="{{ route('editSubmit') }}" method="post">
                @csrf
                <input type="hidden" name="note_id" value="{{ Crypt::encrypt($note->id) }}">
                <div class="row mt-3">
                    <div class="col">
                        <div class="mb-3">
                            <label class="form-label">Titulo</label>
                            <input type="text" class="form-control bg-primary text-white" name="title" value="{{ old('title', $note->title) }}">

                            @error('title')
                                <div class="text-danger">
                                      {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notação</label>
                            <textarea class="form-control bg-primary text-white" name="text" rows="5" >{{ old('text', $note->text) }}</textarea>

                            @error('text')
                            <div class="text-danger">
                                {{ $message }}
                            </div>

                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col text-end">
                        <a href="{{ route('home') }}" class="btn btn-primary px-5"><i class="fa-solid fa-ban me-2"></i>Cancel</a>
                        <button type="submit" class="btn btn-secondary px-5"><i class="fa-regular fa-circle-check me-2"></i>Editar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>



@endsection
