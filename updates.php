<?php
$offset=869742167;

function getNewMessages($offset, $timeout = 30) {
    
    $telegram_token_bot = '711172709:AAH0cOJZJT75PqdHvsD1hKY2rqbMUPNWEYw';
    $url  = "https://api.telegram.org/bot".$telegram_token_bot."/getUpdates?offset=$offset&timeout=$timeout";
    $body = `curl --insecure --socks5-hostname localhost:9050 $url 2>/dev/null`;
    return json_decode($body, 1);
}

$latest = 0;
$i = 0;
$l = 0;

do {

    $info = getNewMessages($latest);
    
    foreach ($info['result'] as $item) {

        $latest = $item['update_id'];
        $i = $latest; 
        echo "$latest: ".@ $item['message']['text'] . "\n";

        $text = $item['message']['text'];
        
        
        $word = [
        '@FoxSteller_Bot' => 'Список команд',
        'Федор' => 'Чего тебе кожанный мешок?',
        'Федор, как дела?'=> 'У меня то все нормально',
        'Федор, isset' => 'В круглых скобках конструкции isset () указывается либо одна, либо несколько разделенных запятыми переменных. В отличие от конструкции unset ( ) , здесь воз­вращается значение логического типа. Если все переменные существуют, конст­рукция возвращает true, если хотя бы одна переменная не существует возвраща­ется false.',
        'Федор, unset' => 'После вызова конструкции unset () память, выделенная под 3начение переменной ,возвращается системе,а самойной присваивается значение null',    
        'Федор, empty' => 'Конструкция empty () принимает в качестве параметра лишь одну переменную $var и возвращает true, если переменная равна пустой строке"", нулю О, символу нуля в строке "О", null, false, пустому массиву array (), неинициализированной переменной (случай, впрочем, аналогичный null).Во всех остальных случаях возвращается false',
        'Федор, gettype' => 'Функция, что вовращает тип переменной. Это когда ты не знаешь какой тип данных у переменной, а у знать надо бы. В нагрузку можно использовать is. Например: is_int(). Проверяем является ли переменная типом integer. Если да, то вернет True, если нет, то False',    
        'Федор, статус вк' =>'Вводи свой новый статус',
        'Федор, explode' => 'explode( разделить, строка ). Работает просто. Читаем всю нашу строку, и если встречаем разделитель, то это будет 1 элемент массива. Далее читаем дальше строку, встречаем снова разделить. Это уже второй элемент массива. explode создает с помощью разделителей массив строк из одной строки. Да и вообще на забывай.Массивы начинаются с нуля',
        'Федор, preg_split' => "preg_split( регулярное выражение, строка ). /d+./ это тоже самое что и /0-9+\./, как только будет встречана цифра в строке, данная строка запишется в отдельный элемент массива. И функция дальше продолжит читать строку, пока снова не встретит число. Другие регулярные выражения \s - пробел, тамбы, и иные пробельные символы",    
         'Федор, trim ' => 'trim() Эта функция возвращает строку str с удаленными из начала и конца строки пробелами. Если второй параметр не передан. Если передали второй параметр? echo trim('abca','a'), то вернет нам bc. Как бы можно вообще перечислить все символы для удаления из строки'
  ];    
    }
        
    //if ( preg_match('~Федор~', $text) ) { }
        if (!isset($word[ $text ]) && preg_match('~Федор~', $text) ) {
        $chatid = $item['message']['chat']['id'];
        If ($i != $l) {
        $feed = `curl --insecure --socks5-hostname  localhost:9050 'https://api.telegram.org/bot711172709:AAH0cOJZJT75PqdHvsD1hKY2rqbMUPNWEYw/sendMessage?chat_id=$chatid&text=Я не понимаю тебя, человек.'`;  
        $l = $latest; 
        }
        
    }
       
        if (isset($word[ $text ])) { 
        
        $chatid = $item['message']['chat']['id'];
        $answer = $word[ $text ];
        
        If ($i != $l) {
        $feed = `curl --insecure --socks5-hostname  localhost:9050 'https://api.telegram.org/bot711172709:AAH0cOJZJT75PqdHvsD1hKY2rqbMUPNWEYw/sendMessage?chat_id=$chatid&text=$answer'`;
        $l = $latest; 
        }
    }

    $latest++;
}

while ($info);