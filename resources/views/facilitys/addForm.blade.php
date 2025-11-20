<x-layouts.app>
    <div class="main p-6 mx-auto">
        <form action="{{ route('f.store') }}" method="POST"
            class="space-y-6 bg-white p-6 rounded-2xl shadow-[0px_0px_40px_10px_rgba(0,0,0,0.5)] w-[22rem] h-128 mx-auto">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    Название нового удобства <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" required autofocus
                    class="w-full h-[30px] px-[5px] py-[5px] border rounded-[5px] shadow-sm focus:ring-indigo-500 focus:border-indigo-500 leading-[18px] @error('name') border-red-500 @enderror"
                    value="{{ old('name') }}">
            </div>

            <div class="flex justify-between pt-4">
                <a href="{{ url()->previous() ?? route('home') }}"
                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-black rounded-lg">Назад</a>
                <input type="submit" value="Отправить"
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg cursor-pointer">
            </div>
        </form>
    </div>
</x-layouts.app>
