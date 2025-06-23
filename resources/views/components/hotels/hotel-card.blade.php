<div class="bg-white rounded shadow-md flex card text-grey-darkest">
    <img class="w-1/2 h-full rounded-l-sm" src="{{ asset('storage/' . $hotel->poster_url) }}" alt="Фото отеля '{{ $hotel->name }}'">
    <div class="w-full flex flex-col justify-between p-4">
        <div>
            <a class="block text-grey-darkest mb-2 font-bold"
               href="{{ route('h.show', ['hotel' => $hotel]) }}">{{ $hotel->name }}</a>
            <div class="text-xs">
                {{ $hotel->address }}
            </div>
        </div>
        @if($hotel->rooms()->min('price'))
            <div class="pt-2">
                <span class="text-2xl text-grey-darkest">₽{{ $hotel->rooms()->min('price') }}</span>
                <span class="text-lg"> за ночь</span>
            </div>
        @endif
        @if($hotel->facilities->isNotEmpty())
            <div class="flex items-center py-2">
                @foreach($hotel->facilities->take(2) as $facility)
                    <div class="pr-2 text-xs">
                        <span>•</span> {{ $facility->name }}
                    </div>
                @endforeach
            </div>
        @endif
        <div class="flex justify-end">
            <x-link-button href="{{ route('h.show', ['hotel' => $hotel]) }}">Подробнее</x-link-button>
        </div>
    </div>
</div>
