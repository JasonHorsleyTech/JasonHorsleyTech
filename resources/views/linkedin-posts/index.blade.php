<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Linked-In Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
            </div>

            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($posts as $post)
                    <div class="p-6 bg-white dark:bg-gray-700 text-black dark:text-white border-b border-gray-200 dark:border-blue-700 last:border-0">
                        <p class="text-lg">{{ $post->content }}</p>

                        <div class="flex flex-col items-end">
                            <p class="text-sm">Generated: {{ $post->generated_at }}</p>

                            @if ($post->posted_at)
                                <p class="text-sm">Posted: {{ $post->posted_at }}</p>
                            @else
                                <form
                                    action="{{ route('linkedin-posts.destroy', ['linkedin_post' => $post->id]) }}"
                                    method="POST"
                                    class="text-blue-500 border-b border-blue-500 hover:text-blue-800 hover:border-blue-800 dark:hover:text-blue-300 dark:hover:border-blue-300"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
