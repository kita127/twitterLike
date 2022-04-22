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
                            <th class="text-center">リツイートボタン</th>
                            <th class="text-center">引用リツイート</th>
                            <th class="text-center">画像</th>
                        </tr>
                        @foreach($message_and_retweet as $message)
                        <tr>
                            <td>{{ $message->name }}さん</td>
                            <td>{{ $message->message }}</td>
                            <td>{{ $message->favorite }}</td>
                            <td>
                                <form action="/favorite" method="post">
                                    @csrf
                                    <input type="hidden" name="message_id" value="{{ $message->id }}">
                                    <button type="submit" class="btn btn-default">いいね！</button>
                                </form>
                            </td>
                            <td>
                                <form action="/retweet" method="post">
                                    @csrf
                                    <input type="hidden" name="message_id" value="{{ $message->id }}">
                                    <button type="submit" class="btn btn-default">リツイート</button>
                                </form>
                            </td>
                            <td>
                                <form action="/refretweet" method="post">
                                    @csrf
                                    <input type="hidden" name="message_id" value="{{ $message->id }}">
                                    <input type="text" name="message">
                                    <button type="submit" class="btn btn-default">引用リツイート</button>
                                </form>
                            </td>
                            <td>
                                @if($message->image != '')
                                <img src="{{ asset('storage/' . $message->image ) }}" class="w-48 ">
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>