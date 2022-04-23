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


            @foreach($message_and_retweet as $message)
            <div class="border">
                <ul class="col2">
                    <li>
                        <div>
                            {{ $message->name }}さん
                        </div>
                        <div>
                            {{ $message->message }}
                        </div>
                        <div>
                            <form action="/favorite" method="post">
                                @csrf
                                <input type="hidden" name="message_id" value="{{ $message->id }}">
                                <button type="submit" class="btn btn--orange">★</button>
                                <inline>{{ $message->favorite }}</inline>
                            </form>
                        </div>
                        <!-- リツイートしたツイートはリツイート不可 -->
                        @if($message->can_retweet)
                        <div>
                            <form action="/retweet" method="post">
                                @csrf
                                <input type="hidden" name="message_id" value="{{ $message->id }}">
                                <div class="bg-white">
                                    <button type="submit" class="btn btn--orange">リツイート</button>
                                </div>
                            </form>
                        </div>
                        @endif
                        <!-- リツイートしたツイートはリツイート不可 -->
                        @if($message->can_retweet)
                        <div>
                            <form action="/refretweet" method="post">
                                @csrf
                                <input type="hidden" name="message_id" value="{{ $message->id }}">
                                <div class="bs-white">
                                    <button type="submit" class="btn btn--orange">引用リツイート</button>
                                </div>
                                <input type="text" name="message" value="引用メッセージ">
                            </form>
                        </div>
                        @endif
                        @if($message->msg_type == 'retweet' || $message->msg_type == 'refretweet')
                        <div class="retweet-text">
                            {{ $message->retweeter }} さんがリツイート
                        </div>
                        @endif
                    </li>
                    <li>
                        <div class="block-left">
                            <div>
                                @if($message->image != '')
                                <img src="{{ asset('storage/' . $message->image ) }}" class="w-48 ">
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>