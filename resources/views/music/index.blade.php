<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Music Index') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
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
                      <img class="object-fit"
                        src="{{$music->image_url}}"
                        alt="album cover">
                    </a>
                    <div class="px-4">
                      <a href="{{$music->url}}">
                          <h3 class="text-left font-bold text-lg text-grey-dark">{{$music->name}}</h3>
                      </a>
                      <a href="{{$music->artist_url}}">
                          <h3 class="pt-0.5 text-left text-grey-dark">- {{$music->artist_name}} -</h3>
                      </a>
                    </div>
                  </div>
                  <div class="flex">
                    <!-- 更新ボタン -->
                    <!-- 削除ボタン -->
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