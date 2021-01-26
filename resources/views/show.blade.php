@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        {{-- game details --}}
        <div class="game-details border-b border-gray-800 pb-12 flex flex-col lg:flex-row">
            @isset($game['cover'])
                <div class="flex-none">
                    <img
                    src="{{ $game['coverImageUrl'] }}"
                        alt="cover"
                    >
                </div>
            @else
                <x-game-no-cover-skeleton />
            @endisset
            <div class="lg:ml-12 lg:mr-64">
                <h2 class="font-semibold text-4xl leading-tight mt-1">
                    {{ $game['name'] }}
                </h2>
                <div class="text-gray-400">
                    @isset($game['genres'])
                        <span>
                            {{ $game['genres'] }}
                        </span>
                        &middot;
                    @endisset
                    @isset($game['companies'])
                        <span>
                            {{ $game['companies'] }}
                        </span>
                        &middot;
                    @endisset
                    @isset($game['platforms'])
                        <span>
                            {{ $game['platforms'] }}
                        </span>
                    @endisset
                </div>

                <div class="flex flex-wrap items-center mt-8">
                    @isset($game['memberRating'])
                        <div class="flex items-center">
                            <div id="memberRating" class="w-16 h-16 bg-gray-800 rounded-full relative text-sm">
                                @push('scripts')
                                    @include('_rating', [
                                        'slug'      =>  'memberRating',
                                        'rating'    =>  $game['memberRating'],
                                        'event'     => null
                                    ])
                                @endpush
                            </div>
                            <div class="ml-4 text-xs">Member <br> Score</div>
                        </div>
                    @endisset
                    @isset($game['criticRating'])
                        <div class="flex items-center ml-12">
                            <div id="criticRating" class="w-16 h-16 bg-gray-800 rounded-full relative text-sm">
                                @push('scripts')
                                    @include('_rating', [
                                        'slug'      =>  'criticRating',
                                        'rating'    =>  $game['criticRating'],
                                        'event'     => null
                                    ])
                                @endpush
                            </div>
                            <div class="ml-4 text-xs">Critic <br> Score</div>
                        </div>
                    @endisset
                    {{-- social media icons --}}
                    <div class="flex items-center space-x-4 mt-4 sm:mt-0 sm:ml-12">
                        @isset($game['social']['website'])
                            <div class="bg-gray-800 p-2 rounded-full flex justify-center items-center">
                                <a href="{{ $game['social']['website']['url'] }}" class="text-white hover:text-gray-400">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 496 512">
                                        <path d="M248 8C111.03 8 0 119.03 0 256s111.03 248 248 248 248-111.03 248-248S384.97 8 248 8zm82.29 357.6c-3.9 3.88-7.99 7.95-11.31 11.28-2.99 3-5.1 6.7-6.17 10.71-1.51 5.66-2.73 11.38-4.77 16.87l-17.39 46.85c-13.76 3-28 4.69-42.65 4.69v-27.38c1.69-12.62-7.64-36.26-22.63-51.25-6-6-9.37-14.14-9.37-22.63v-32.01c0-11.64-6.27-22.34-16.46-27.97-14.37-7.95-34.81-19.06-48.81-26.11-11.48-5.78-22.1-13.14-31.65-21.75l-.8-.72a114.792 114.792 0 0 1-18.06-20.74c-9.38-13.77-24.66-36.42-34.59-51.14 20.47-45.5 57.36-82.04 103.2-101.89l24.01 12.01C203.48 89.74 216 82.01 216 70.11v-11.3c7.99-1.29 16.12-2.11 24.39-2.42l28.3 28.3c6.25 6.25 6.25 16.38 0 22.63L264 112l-10.34 10.34c-3.12 3.12-3.12 8.19 0 11.31l4.69 4.69c3.12 3.12 3.12 8.19 0 11.31l-8 8a8.008 8.008 0 0 1-5.66 2.34h-8.99c-2.08 0-4.08.81-5.58 2.27l-9.92 9.65a8.008 8.008 0 0 0-1.58 9.31l15.59 31.19c2.66 5.32-1.21 11.58-7.15 11.58h-5.64c-1.93 0-3.79-.7-5.24-1.96l-9.28-8.06a16.017 16.017 0 0 0-15.55-3.1l-31.17 10.39a11.95 11.95 0 0 0-8.17 11.34c0 4.53 2.56 8.66 6.61 10.69l11.08 5.54c9.41 4.71 19.79 7.16 30.31 7.16s22.59 27.29 32 32h66.75c8.49 0 16.62 3.37 22.63 9.37l13.69 13.69a30.503 30.503 0 0 1 8.93 21.57 46.536 46.536 0 0 1-13.72 32.98zM417 274.25c-5.79-1.45-10.84-5-14.15-9.97l-17.98-26.97a23.97 23.97 0 0 1 0-26.62l19.59-29.38c2.32-3.47 5.5-6.29 9.24-8.15l12.98-6.49C440.2 193.59 448 223.87 448 256c0 8.67-.74 17.16-1.82 25.54L417 274.25z"/>
                                    </svg>

                                </a>
                            </div>
                        @endisset
                        @isset($game['social']['instagram'])
                            <div class="bg-gray-800 p-2 rounded-full flex justify-center items-center">
                                <a href="{{ $game['social']['instagram']['url'] }}" class="text-white hover:text-gray-400">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 448 512">
                                        <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                                    </svg>

                                </a>
                            </div>

                        @endisset
                        @isset($game['social']['twitter'])
                            <div class="bg-gray-800 p-2 rounded-full flex justify-center items-center">
                                <a href="{{ $game['social']['twitter']['url'] }}" class="text-white hover:text-gray-400">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 512 512">
                                        <path d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"/>
                                    </svg>

                                </a>
                            </div>
                        @endisset
                        @isset($game['social']['facebook'])
                            <div class="bg-gray-800 p-2 rounded-full flex justify-center items-center">
                                <a href="{{ $game['social']['facebook']['url'] }}" class="text-white hover:text-gray-400">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 448 512">
                                        <path d="M400 32H48A48 48 0 0 0 0 80v352a48 48 0 0 0 48 48h137.25V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.27c-30.81 0-40.42 19.12-40.42 38.73V256h68.78l-11 71.69h-57.78V480H400a48 48 0 0 0 48-48V80a48 48 0 0 0-48-48z"/>
                                    </svg>

                                </a>
                            </div>
                        @endisset

                    </div>
                    {{-- end social media icons --}}

                </div>

                @isset($game['summary'])
                    <p class="mt-12">{{ $game['summary'] }}</p>
                @endisset

                <div class="mt-12" x-data="{ isTrailerModalVisible: false }">

                    <button
                        @click="isTrailerModalVisible = true"
                        class="flex bg-blue-500 text-white font-semibold px-4 py-4 hover:bg-blue-600 rounded transition ease-in-out duration-150"
                    >
                        <svg class="w-6 fill-current" viewBox="0 0 512 512">
                            <path d="M371.7 238l-176-107c-15.8-8.8-35.7 2.5-35.7 21v208c0 18.4 19.8 29.8 35.7 21l176-101c16.4-9.1 16.4-32.8 0-42zM504 256C504 119 393 8 256 8S8 119 8 256s111 248 248 248 248-111 248-248zm-448 0c0-110.5 89.5-200 200-200s200 89.5 200 200-89.5 200-200 200S56 366.5 56 256z"/>
                        </svg>
                        <span class="ml-2">Play Trailer</span>
                    </button>

                    {{-- <a

                        href="{{ $game['trailerUrl'] }}"
                        class="inline-flex bg-blue-500 text-white font-semibold p-4 hover:bg-blue-600 rounded transition ease-in-out duration-150"
                    >
                        <span class="mx-2">
                            <svg class="w-6 fill-current" viewBox="0 0 512 512">
                                <path d="M371.7 238l-176-107c-15.8-8.8-35.7 2.5-35.7 21v208c0 18.4 19.8 29.8 35.7 21l176-101c16.4-9.1 16.4-32.8 0-42zM504 256C504 119 393 8 256 8S8 119 8 256s111 248 248 248 248-111 248-248zm-448 0c0-110.5 89.5-200 200-200s200 89.5 200 200-89.5 200-200 200S56 366.5 56 256z"/>
                              </svg>
                        </span>
                        Play Trailer
                    </a> --}}

                    {{-- modal --}}
                    <template x-if="isTrailerModalVisible">
                        <div
                            x-show = "isTrailerModalVisible"
                            style="background-color: rgba(0, 0, 0, .5);"
                            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto z-20"
                        >
                            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                <div class="bg-gray-900 rounded">
                                    <div class="flex justify-end pr-4 pt-2">
                                        <button
                                            @click="isTrailerModalVisible = false"
                                            @keydown.escape.window="isTrailerModalVisible = false"
                                            class="text-3xl leading-none hover:text-gray-300"
                                        >
                                            &times;
                                        </button>
                                    </div>
                                    <div
                                        @click.away = "isTrailerModalVisible = false"
                                        class="modal-body p-8"
                                    >
                                        <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                            <iframe
                                                width="560"
                                                height="315"
                                                class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                src="{{ $game['trailerUrl'] }}"
                                                style="border: 0;"
                                                allow="autoplay; encrypted-media"
                                                allowfullscreen
                                            >

                                            </iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                    {{-- end modal --}}

                </div>
            </div>
        </div>
        {{-- end game details --}}
        {{-- game screenshots --}}
        @if (count($game['screenshots']) > 0)
            <div
                class="images-container border-b border-gray-800 pb-12 mt-8"
                x-data="{ isImageModalVisible: false, image: '' }"
            >
                <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Images</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-12 mt-8">
                    @foreach ($game['screenshots'] as $screenshot)
                        <a
                            href="#"
                            @click.prevent="
                                image = '{{ $screenshot['huge'] }}';
                                isImageModalVisible = true;
                            "
                        >
                            <img
                                src="{{ $screenshot['big'] }}"
                                alt="screenshot"
                                class="hover:opacity-75 transition ease-in-out duration-150"
                            >
                        </a>
                    @endforeach

                </div>

                <template x-if="isImageModalVisible">
                    <div
                        x-show = "isImageModalVisible"
                        class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto z-20 bg-black bg-opacity-50"
                    >
                        <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                            <div class="bg-gray-900 rounded">
                                <div class="flex justify-end pr-4 pt-2">
                                    <button
                                        @click="isImageModalVisible = false"
                                        @keydown.escape.window="isImageModalVisible = false"
                                        class="text-3xl leading-none hover:text-gray-300"
                                    >
                                        &times;
                                    </button>
                                </div>
                                <div
                                    @click.away = "isImageModalVisible = false"
                                    class="modal-body p-8"
                                >
                                    <img :src="image" alt="screenshot">
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

            </div>
        @endif
        {{-- end game screenshots --}}
        {{-- similar games  --}}
        <div class="similar-games-container mt-8">
            <h2 class="text-blue-500 uppercase tracking-wide font-semibold">Similar Games</h2>
            <div class="similar-games text-sm grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 xl:grid-cols-6 gap-12">
                @foreach ($game['similarGames'] as $similar_game)
                    <x-game-card :game="$similar_game" />
                @endforeach

            </div>
        </div>
        {{-- end similar games  --}}
    </div>

@endsection
