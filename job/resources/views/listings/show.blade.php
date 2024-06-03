<x-layout>

    <a href="/" class="inline-block text-black ml-4 mb-4"><i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
        <x-card class="p-10">
            <div class="flex flex-col items-center justify-center text-center">
                <img class="w-48 mr-6 mb-6"
                    src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png') }}"
                    alt="" />

                <h3 class="text-2xl mb-2">{{ $listing->title }}</h3>
                <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>

                <x-listing-tags :tagsCsv="$listing->tags" />

                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i>{{ $listing->location }}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Job Description
                    </h3>
                    <div class="text-lg space-y-6">
                        {{ $listing->description }}
                        <br><br>

                        <!-- Apply to Job form -->
                        <header class="text-center">
                            <h6 class="text-2xl font-bold mb-1">
                                Apply for {{ $listing->title }}
                            </h6>
                            <p class="mb-4">Submit your application</p>
                        </header>
                        @auth
                        <form action="{{ route('applications.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label for="cv" class="block text-sm font-medium text-gray-700">Upload CV</label>
                                <input type="file" name="cv" id="cv" class="mt-1 block w-full">
                            </div>

                            <div class="mb-4">
                                <label for="cover_letter" class="block text-sm font-medium text-gray-700">Cover Letter</label>
                                <textarea name="cover_letter" id="cover_letter" rows="4" class="mt-1 block w-full"></textarea>
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                    Submit Application
                                </button>
                            </div>
                        </form>
                        @else
                            <p><a href="{{ route('login') }}">Log in</a> to apply for this job.</p>
                        @endauth

                        <a href="mailto:{{ $listing->email }}"
                            class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-envelope"></i>
                            Contact Employer</a>

                        <a href="{{ $listing->website }}" target="_blank"
                            class="block bg-black text-white py-2 rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-globe"></i> Visit
                            Website</a>
                    </div>
                </div>
            </div>
        </x-card>

        {{-- <x-card class="mt-4 p-2 flex space-x-6">
            <a href="/listings/{{ $listing->id }}/edit">
                <i class="fa-solid fa-pencil"></i>Edit
            </a>

            <form method="POST" action="/listings/{{$listing->id}}">
            @csrf
            @method('DELETE')
            <button class="text-red-500">
                <i class="fa-solid fa-trash"></i>
                Delete
            </button>
            </form>

        </x-card> --}}
    </div>
</x-layout>
