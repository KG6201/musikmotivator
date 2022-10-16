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
              <p class="py-2 px-3 text-grey-darkest" id="schedule">
                {{$schedules->schedule_title}}
              </p>
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">start</p>
              <p class="py-2 px-3 text-grey-darkest" id="start">
                {{$schedules->start}}
              </p>
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">finish</p>
              <p class="py-2 px-3 text-grey-darkest" id="finish">
                {{$schedules->finish}}
              </p>
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">Action</p>
              <p class="py-2 px-3 text-grey-darkest" id="schedule">
                {{$actions->action_title}}
              </p>
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">start</p>
              <p class="py-2 px-3 text-grey-darkest" id="start">
                {{$actions->start}}
              </p>
              <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">finish</p>
              <p class="py-2 px-3 text-grey-darkest" id="finish">
                {{$actions->finish}}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>