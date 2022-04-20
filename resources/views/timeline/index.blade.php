<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('timeline') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    timeline
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
                            <th class="text-center">ユーザー</th>
                            <th class="text-center">メッセージ内容</th>
                            <th class="text-center">いいね数</th>
                            <th class="text-center">いいねボタン</th>
                        </tr>
                        @foreach($messages as $message)
                        <tr>
                            <td>{{ $message->name }}さん</td>
                            <td>{{ $message->message }}</td>
                            <td>{{ $message->favorite }}</td>
                            <form action="/favorite" method="post">
                                @csrf
                                <td>
                                    <input type="hidden" name="message_id" value="{{ $message->id }}">
                                    <button type="submit" class="btn btn-default">いいね！</button>
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