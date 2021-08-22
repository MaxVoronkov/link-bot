<?php



include('vendor/autoload.php');
include ('bundle.php');
use Telegram\Bot\Api;

$telegram = new Api('');

$result = $telegram -> getWebhookUpdates();
$text = $result["message"]["text"];
$chat_id = $result["message"]["chat"]["id"];


$bunndle  = array(
	'com.dlcgames.leprechauntreasures',
	'com.dlcgames.piratestreasure'
);
$keyboard = array(
    array(array('text'=>'com.dlcgames.leprechauntreasures')),
    array(array('text'=>'com.dlcgames.piratestreasure')),
);

$reply_markup = $telegram->replyKeyboardMarkup([ 
    'keyboard' => $keyboard, 
    'resize_keyboard' => true, 
    'one_time_keyboard' => false 
]);

if (in_array($text, $bunndle )) {
	$bunndle_link = $text;
	$telegram->sendMessage(array(
  'chat_id' => $chat_id,
    'text' => 'Введите ссылку',
));

$bund['bundlast'] = $bunndle_link;
$out = var_export($bund, true);
file_put_contents("bundle.php","<?php\n\$bund = $out;");
}else{

$ad = trim ($text);
$array_text = str_split($ad);
$bunndlelst = $bund['bundlast'];
foreach ($array_text as $key => $value) {
    $key_code = random_int(1,9);
    $hex_let = dechex(hexdec(bin2hex($value)) ^ $key_code);

    $string_full = $string_full.$key_code.$hex_let.'-';
}



	$telegram->sendMessage(array(
  'chat_id' => $chat_id,
    'text' =>  $string_full.'++'.$bunndlelst,
     'text' =>  'выберите приложение',
    'reply_markup' => $reply_markup,
));
}

