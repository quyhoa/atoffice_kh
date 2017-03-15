<?php
function trmessage($corp,$nickname){
$body = "$corp\n";
$body.= "$nickname 様\n\n";

$body.= "予約システムをご利用いただきありがとうございます。\n";
$body.= "システムは以下の内容の仮予約を受け付けました。\n\n";

$body.= "仮予約が承認されましたら、2営業日以内に予約確定のメールが届きます。\n";$body.= "大変恐れ入りますが本メール到着後3営業日を過ぎてもご連絡がいかない場合は、下記連絡先までお問い合わせください。\n\n";

return $body;
}
?>