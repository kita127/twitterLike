<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('userlist') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    userlist
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="row">
                <div class="col-md-11 col-md-offset-1">
                    <table class="table text-center">
                        <tr>
                            <th class="text-center">ユーザー一覧</th>
                        </tr>
                        @foreach($users as $user)
                        <tr>
                            <form action="/userlist" method="post">
                                @csrf

                                <td>{{ $user->name }}</td>
                                <input type="hidden" name="following_id" value="{{ $user->id }}">
                                <td>
                                    <button type="submit">フォローする</button>
                                </td>
                            </form>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>