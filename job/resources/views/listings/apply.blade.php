<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Apply for {{ $listing->title }}
            </h2>
            <p class="mb-4">Submit your application</p>
        </header>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @auth
            <form action="{{ route('applications.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="listing_id" value="{{ $listing->id }}">

                <div class="mb-6">
                    <label for="name" class="inline-block text-lg mb-2">Name:</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name"
                        value="{{ old('name') }}" />

                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="inline-block text-lg mb-2">Contact Email:</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="email"
                        value="{{ old('email') }}" />

                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="location" class="inline-block text-lg mb-2">Location:</label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location"
                        value="{{ old('location') }}" />

                    @error('location')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="projects" class="inline-block text-lg mb-2">
                        Project's/Github URL:
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="projects"
                        value="{{ old('projects') }}" />

                    @error('projects')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="cv_path" class="inline-block text-lg mb-2">
                        Upload CV:
                    </label>
                    <input type="file" class="border border-gray-200 rounded p-2 w-full" name="cv_path" />

                    @error('cv_path')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="cover_letter" class="inline-block text-lg mb-2">
                        Cover Letter:
                    </label>
                    <textarea class="border border-gray-200 rounded p-2 w-full" name="cover_letter" id="cover_letter" rows="4"
                        class="mt-1 block w-full"></textarea>

                    @error('cover_letter')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 text-center">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Submit Application
                    </button>
                </div>
            </form>
        @else
            <p><a href="{{ route('login') }}">Log in</a> to apply for this job.</p>
        @endauth
    </x-card>
</x-layout>
