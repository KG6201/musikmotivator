<!-- resources/views/tweet/create.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Create New Schedules') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          @include('common.errors')
          <form class="mb-6" action="{{ route('category.store') }}" method="POST">
            @csrf
            <!--<div class="flex flex-col mb-4">
                 <div class="mb-2 uppercase font-bold text-lg text-grey-darkest"><label for="category">category</label></div>
                    <div class="mb-2 uppercase font-bold text-lg text-grey-darkest ">
                      <select name="task">
                      <option value="study">study</option>
                      <option value="work" selected>work</option>
                      <option value="go home">go home</option>
                      </select>
                    </div>
                  </div>-->

                <div class="form-group">
                    <label for="category_id">{{ __('カテゴリー') }}</label>
                    <select class="form-control" id="category-id" name="category_id">
                        @foreach ($categories as $category)
                        <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
           </form>   
          <form class="mb-6" action="{{ route('schedule.store') }}" method="POST">
            @csrf                 
                <div class="flex flex-col mb-4">    
                  <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="schedule_title">description or title</label>
                  <input class="border py-2 px-3 text-grey-darkest" type="text" name="schedule_title" id="schedule_title">
                </div>
            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="start">start</label>
              <input class="border py-2 px-3 text-grey-darkest" type="datetime-local" name="start" id="start">
            </div>
            <div class="flex flex-col mb-4">
              <label class="mb-2 uppercase font-bold text-lg text-grey-darkest" for="finish">finish</label>
              <input class="border py-2 px-3 text-grey-darkest" type="datetime-local" name="finish" id="finish">
            </div>
            <button type="submit" class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
              Create
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

