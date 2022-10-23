<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Show Schedule Detail') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="mb-6">
            <div class="flex flex-col mb-4">

              <div class="form-group">
                      <label for="category_id">{{ __('カテゴリー') }}</label>
                      <select class="form-control" id="category-id" name="category_id">
                          @foreach ($categories as $category)
                          <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                          @endforeach
                      </select>
              </div>
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
            <form class="mb-6" action="{{ route('action.act', $schedule->id) }}" method="GET">
              @csrf
              <div class="flex justify-evenly">
                <a href="{{ url()->previous() }}" class="block text-center w-5/12 py-3 mt-6 font-medium tracking-widest text-black uppercase bg-gray-100 shadow-sm focus:outline-none hover:bg-gray-200 hover:shadow-none">
                  Back
                </a>
                <button type="submit" class="w-5/12 py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                  Start Action
                </button>
              </div>
            </form>
          </div>

          <table class="text-center w-full border-collapse">
            <thead>
              <tr>
                <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($actions as $action)
              <tr class="hover:bg-grey-lighter">
                <td class="text-left py-4 px-6 border-b border-grey-light">
                  <div class="flex flex-col mb-4">
                    <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">Started At</p>
                    <p class="py-2 px-3 text-grey-darkest" id="action_start">
                        {{$action->start}}
                    </p>
                  </div>
                  <div class="flex flex-col mb-4">
                    <p class="mb-2 uppercase font-bold text-lg text-grey-darkest">Finished At</p>
                    <p class="py-2 px-3 text-grey-darkest" id="action_finish">
                        {{$action->finish}}
                    </p>
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