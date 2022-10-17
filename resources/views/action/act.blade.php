<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Act Now!') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="mb-6">
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">Schedule</p>
              <p class="py-2 px-3 text-grey-darkest" id="schedule">
                {{$schedule->schedule_title}}
              </p>
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">start</p>
              <p class="py-2 px-3 text-grey-darkest" id="start">
                {{$schedule->start}}
              </p>
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">finish</p>
              <p class="py-2 px-3 text-grey-darkest" id="finish">
                {{$schedule->finish}}
              </p>
            </div>
            @include('common.errors')
            <form class="mb-6" action="{{ route('action.store') }}" method="POST">
              @csrf
              <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
              <input type="hidden" name="start" value="{{ $request->start }}">
              <div class="flex flex-col mb-4">
                <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="finish">actual finish</label>
                <input class="border py-2 px-3 text-grey-darkest" type="datetime-local" name="finish" id="finish">
              </div>
              <div class="flex justify-evenly">
                <a href="{{ url()->previous() }}" class="block text-center w-5/12 py-3 mt-6 font-medium tracking-widest text-black uppercase bg-gray-100 shadow-sm focus:outline-none hover:bg-gray-200 hover:shadow-none">
                  Back
                </a>
                <button type="submit" class="w-5/12 py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                  Finish Action
                </button>
              </div>
            </form>
          </div>
          <table class="text-center w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">music</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($musics as $music)
              <tr class="hover:bg-grey-lighter">
                <td class="py-4 px-6 border-b border-grey-light">
                  <div class="flex">
                    <a href="{{$music->url}}">
                      <h3 class="text-left font-bold text-lg text-grey-dark">{{$music->name}}</h3>
                    </a>
                    <a href="{{$music->artist_url}}">
                      <h3 class="px-4 pt-0.5 text-left text-grey-dark">- {{$music->artist_name}} -</h3>
                    </a>
                  </div>
                  <div class="flex">
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