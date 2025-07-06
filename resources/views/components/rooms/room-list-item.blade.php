<div {{ $attributes->merge(['class' => 'flex flex-col md:flex-row shadow-md']) }}>
    <div class="h-full w-full md:w-2/5">
        <?php
            $image = asset('storage/' . $room->poster_url);
        ?>
        <div class="h-64 w-full bg-cover bg-center bg-no-repeat" style="background-image: url(<?php echo $image ?>)">
        </div>
    </div>
    <div class="p-4 w-full md:w-3/5 flex flex-col justify-between">
        <div class="pb-2">
            <div class="text-xl font-bold">
                {{ $room->name }}
            </div>
            <div>
                <span>•</span> {{ $room->floor_area }} м
            </div>
            <div>
                @foreach($room->facilities as $facility)
                <span>• {{ $facility->name }} </span>
                @endforeach
            </div>
        </div>
        <hr>
        <div class="flex justify-end pt-2">
            <div class="flex flex-col">
                <span class="text-lg font-bold">{{ $room->total_price }} руб.</span>
                <span>за {{ $room->total_days }} ночей</span>
            </div>
            <form class="ml-4" method="POST" action="{{ route('b.store') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                <input type="hidden" name="started_at" value="{{ $room->startDate }}">
                <input type="hidden" name="finished_at" value="{{ $room->endDate }}">
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input type="hidden" name="price" value="{{ $room->total_price }}">
                <input type="hidden" name="days" value="{{ $room->total_days }}">
                <x-the-button class=" h-full w-full">{{ __('Забронировать') }}</x-the-button>
            </form>
        </div>
    </div>
</div>