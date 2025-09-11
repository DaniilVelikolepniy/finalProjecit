@php
use Carbon\Carbon;

$startDate = Carbon::parse(request()->get('start_date', Carbon::now()->format('Y-m-d')));
$endDate = Carbon::parse(request()->get('end_date', Carbon::now()->addDay()->format('Y-m-d')));

$count = $startDate->diffInDays($endDate);

$startDateFormatted = $startDate->format('Y-m-d');
$endDateFormatted = $endDate->format('Y-m-d');
@endphp

<x-layouts.app>
    <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
        <div class="flex flex-wrap mb-12">
            <div class="w-full flex justify-start md:w-1/3 mb-8 md:mb-0">
                <img class="h-full rounded-l-sm" src="{{ asset('storage/' . $hotel->poster_url) }}" alt="Фото отеля '{{ $hotel->name }}'">
            </div>
            <div class="w-full md:w-2/3 px-4">
                <div class="text-2xl font-bold">{{ $hotel->name }}</div>
                <hr>

                @if(auth()->check() && (
                auth()->user()->isAdmin() ||
                (auth()->user()->isEditor() && $hotel->editor_id === auth()->id())
                ))
                <div class="flex gap-4 my-4">
                    <a href="{{ route('h.edit', ['hotel' => $hotel->id]) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                        ✏️ Редактировать
                    </a>

                    <form method="POST" action="{{ route('h.destroy', $hotel->id) }}"
                        onsubmit="return confirm('Вы уверены, что хотите удалить этот отель?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition">
                            🗑️ Удалить
                        </button>
                    </form>
                </div>
                @endif


                <hr>
                <div class="flex items-center">
                    <b>Адрес: </b> {{ $hotel->address }}
                </div>
                <hr>
                <div>{{ $hotel->description }}</div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="text-2xl text-center md:text-start font-bold">Забронировать комнату</div>

            <form method="get" action="{{ url()->current() }}">

                <div class="flex my-6">
                    <div class="flex items-center mr-5">
                        <div class="relative">
                            <input name="start_date" min="{{ date('Y-m-d') }}" value="{{ $startDateFormatted }}"
                                placeholder="Дата заезда" type="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        </div>
                        <span class="mx-4 text-gray-500">по</span>
                        <div class="relative">
                            <input name="end_date" type="date" min="{{ date('Y-m-d') }}" value="{{ $endDateFormatted }}"
                                placeholder="Дата выезда"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5">
                        </div>
                    </div>
                    <div>
                        <x-the-button type="submit" class=" h-full w-full">Загрузить номера</x-the-button>
                    </div>
                </div>
            </form>
            @if($startDate && $endDate)
            <div class="flex flex-col w-full lg:w-4/5">
                @foreach($rooms as $room)
                <?php
                $room->total_price = $room->price * $count;
                $room->total_days = $count;
                $room->startDate = $startDateFormatted;
                $room->endDate = $endDateFormatted;
                ?>
                <x-rooms.room-list-item :room="$room" class="mb-4" />
                @endforeach
            </div>
            @else
            <div></div>
            @endif
        </div>
    </div>
</x-layouts.app>