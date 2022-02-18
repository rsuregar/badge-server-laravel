<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($title) }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($issuers as $item)

                    <a href="#" class="mb-8 flex flex-col items-center bg-white rounded-lg border shadow-md md:flex-row  hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <img class="object-cover w-full h-full rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg" src="{{ $item->image }}" alt="">
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $item->name }}</h5>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $item->description }}</p>
                            <hr class="border-b-2 my-4 border-gray-100 dark:border-gray-700">
                            {{ $item->badges->count() }} Badges &bull; {{ $item->badges->sum('awarded_count') }} Awarded
                        </div>
                        <x-jet-button class="mr-10">View_Issuer</x-jet-button>
                    </a>

            @endforeach
        </div>
    </div>
</div>
