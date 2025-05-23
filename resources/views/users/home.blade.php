@extends('layouts.app')

@section('title', 'Home')
    
@section('content')
        <div class="row gx-5"> <!--g is gutter. space given on both right and left end-->
            {{-- POST --}}
            <div class="col-8">
                @forelse ($home_posts as $post)
                    <div class="card mb-4">
                        {{-- title --}}
                        @include('users.posts.contents.title')

                        {{-- body --}}
                        @include('users.posts.contents.body')
                    </div>
                @empty
                   <div class="text-center">
                        <h2>Share Photos</h2>
                        <p class="text-muted">When you share photos, they'll appear on your profile</p>
                        <a href="{{ route('post.create') }}" class="text-decoration-none">
                            Share your first photo
                        </a>
                    </div> 
                @endforelse
            </div>

            {{-- PROFILE OVERVIEW + SUGGESTIONS --}}
            <div class="col-4">
                {{-- PROFILE OVERVIEW --}}
                <div class="row align-items-center mb-5 shadow-sm rounded-3 py-3">
                    {{-- avatar --}}
                    <div class="col-auto">
                        <a href="{{ route('profile.show', Auth::user()->id) }}">
                            @if (Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"
                                class="rounded-circle avatar-sm">                                
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-md"></i>                                
                            @endif
                        </a>

                    </div>
                    {{-- name + email --}}
                    <div class="col ps-0">
                        <a href="{{ route('profile.show', Auth::user()->id) }}" class="text-decoration-none text-dark fw-bold">
                            {{ Auth::user()->name }}
                        </a>
                        <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                {{-- SUGGESTIONS --}}
                @if ($suggested_users)
                    <div class="row">
                        <div class="col-auto">
                            <p class="fw-bold text-secondary">Suggestions For You</p>
                        </div>

                        <div class="col text-end">
                            <a href="{{ route('users.suggestions')}}" class="fw-bold text-dark text-decoration"> See All </a>
                        </div>

                    </div>

                    @foreach ($suggested_users as $user)
                        <div class="row align-items-center mb-3">
                            {{-- avatar --}}
                            <div class="col-auto">
                                <a href="{{ route('profile.show', $user->id) }}">
                                    @if ($user->avatar)
                                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="rounded-circle avatar-sm">                                        
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>  
                                    @endif
                                </a>
                            </div>

                            {{-- name --}}
                            <div class="col ps-0 text-truncate">
                                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-non-text-dark fw-bold"> {{ $user->name}}
                                </a>
                            </div>

                            {{-- follow button --}}
                            <div class="col-auto">
                                <form action="{{ route('follow.store', $user->id) }}" method="post">
                                    @csrf

                                    <button type="submit" class="border-0 bg-transparent p-0 text-primary btn-sm">
                                        Follow
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                    @endforeach
                    
                @endif
            </div>

        </div>
@endsection
