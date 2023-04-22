@extends('welcome');

@section('title', 'Recognition All')
@section('mainContent')

<div class="container-fluid">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <a class="breadcrumb-item nav-link" href="{{ route('home') }}">Home</a>
              <li class="breadcrumb-item active" aria-current="page">Recognition All</li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <br>
        <div class="container">
            <div class="row row-cols-2 row-cols-md-4 g-4">
                @forelse($users as $user)
                    <div class="col">
                        <div id="reputationCard" class="card  rounded-0">
                            <a href="#"></a>
                            <img src="{{ asset($user->user_image) }}" class="card-img-top" height="400px auto" alt="...">
                                <div class="card ">
                                    <div id="reputationCardContent">
                                        <span id="reputationTextTitle" class="card-title">{{ $user->title_name }}</span>
                                        <span id="reputationTextName" class="card-title">{{ $user->name }} {{ $user->last_name }}</span>
                                        <p id="reputationTextRepu" class="card-text">{{  $user->work
                                            ? $user->work->pluck('company_name')->first()
                                            : 'N/A'}}</p>
                                    </div>
                                </div>
                                @hasanyrole(['Admin','Staff','Alumni'])
                                <a class="nav-link stretched-link" href="{{ route('recognition.showUser', $user->id) }}">
                                </a>
                                 @endhasanyrole
                        </div>
                    </div>
                    @empty
                        <div class="col-lg-12 col-md-12">
                            <div class="card h-100 shadow">
                                <div class=" p-2 text-center">
                                    <strong>No Alumni </strong>
                                </div>
                            </div>
                        </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
<br>
@endsection
