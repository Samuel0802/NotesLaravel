@extends('layouts.main_layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col">

      @include('top_bar')

                <!-- no notes available -->
                {{-- Se notas for 0 carregar essa div --}}
                @if(count($notes) == 0)
                <div class="row mt-5">
                    <div class="col text-center">
                        <p class="display-6 mb-5 text-secondary opacity-50">You have no notes available!</p>
                        <a href="{{ route('new') }}" class="btn btn-secondary btn-lg p-3 px-5">
                            <i class="fa-regular fa-pen-to-square me-3"></i>Create Your First Note
                        </a>
                    </div>
                </div>

                @else
                {{-- Se notas for maior que 0 carregar essa view  --}}

                <!-- notes are available -->
                <div class="d-flex justify-content-end mb-3">
                    <a href="{{ route('new') }}" class="btn btn-secondary px-3">
                        <i class="fa-regular fa-pen-to-square me-2"></i>New Note
                    </a>
                </div>

                 @foreach($notes as $item )

                 @include('note')
                @endforeach

                @endif

                  {{-- Paginação das notas --}}
                <nav aria-label="Page navigation example ">
                    <ul class="pagination justify-content-center">
                      <li class="page-item ">
                        <a class="page-link" href="{{ $notes->previousPageUrl() }}">Voltar</a>
                      </li>
                      {{-- lastPage(): Retorna a ultima pagina entre relação de pagina com quantidade de registro exibido --}}
                      @for($i = 1; $i <= $notes->lastPage(); $i++)
                      {{-- currentePage(): indica qual apgina que está sendo exibida no momento --}}
                      <li class="page-item {{ $notes->currentPage() == $i ? 'active' : '' }}">
                        {{-- url: vai montar cada uma das paginas que forem construida --}}
                        <a class="page-link" href="{{ $notes->url($i) }}">{{ $i }}</a>
                    </li>

                       @endfor
                      <li class="page-item">
                        <a class="page-link" href="{{ $notes->nextPageUrl() }}">Avançar</a>
                      </li>
                    </ul>
                  </nav>

            </div>
        </div>
    </div>
@endsection
