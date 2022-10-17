<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Show Action Detail') }}
    </h2>
  </x-slot>

   <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="mb-6">
            <div class="flex flex-col mb-4">
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">Schedule</p>
              <p class="py-2 px-3 text-grey-darkest" id="schedule_title">
                {{$schedule->schedule_title}}
              </p>
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">Schedule Start</p>
              <p class="py-2 px-3 text-grey-darkest" id="schedule_start">
                {{$schedule->start}}
              </p>
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">Schedule Finish</p>
              <p class="py-2 px-3 text-grey-darkest" id="schedule_finish">
                {{$schedule->finish}}
              </p>
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">Action Start</p>
              <p class="py-2 px-3 text-grey-darkest" id="action_start">
                {{$action->start}}
              </p>
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">Action Finish</p>
              <p class="py-2 px-3 text-grey-darkest" id="action_finish">
                {{$action->finish}}
              </p>
            </div>
            <a href="{{ url()->previous() }}" class="block text-center w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
              Back
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>