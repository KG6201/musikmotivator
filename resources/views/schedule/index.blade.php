<!-- resources/views/tweet/index.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Schedule Index') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <table class="text-center w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">Schedule</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($schedules as $schedule)
              <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">
                            <h3 class="text-left font-bold text-lg text-grey-dark p-0.5">{{$schedule->schedule_title}}</h3>
                  <div class="flex">
                    <form action="{{ route('schedule.edit',$schedule->id) }}" method="GET" class="text-left">
                      @csrf
                      <button type= "submit" class="bg-gray-400 hover:bg-gray-500 text-white rounded-full px-4 py-2 mx-1" >編集・更新</button>
                    </form>

                    <form action="{{ route('schedule.destroy',$schedule->id) }}" method="POST" class="text-left">
                      @method('delete')
                      @csrf
                      <button type= "submit" class="bg-gray-400 hover:bg-gray-500 text-white rounded-full px-4 py-2" >削除</button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

