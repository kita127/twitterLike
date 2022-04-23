# twitterLike

ツイッターのような Web アプリケーション

## 説明

* timeline
    * タイムラインが表示されます
    * タイムラインに表示されるツイートは自分のツイートかフォローしているユーザーのツイートです
    * ★ボタンを押すといいねになります
    * リツイートを押すとリツイートされます
    * 「引用メッセージ」入力の上「引用ツイート」を押下すると引用リツイートができます
* tweet
    * 入力欄にテキストを入力し「ツイートする」を押すとツイートできます
    * 「ファイルを選択」により画像つきツイートができます
    * `@ユーザー名` で対象のユーザーにリプライができます
        * リプライした場合、相手の notify に通知がいきます
* userlist
    * 利用ユーザー一覧です
    * フォローするを押すと対象ユーザーをフォローします
* followinglist
    * 自分がフォローしているユーザー一覧です
* notify
    * 自分宛てのリプライを表示するページです

## 制限事項

* 同名のアカウントは登録できません

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
