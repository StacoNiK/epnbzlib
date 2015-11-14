# EpnBzLib
PHP библиотека для работы с сайтом партнёрском программы epn.bz

#Установка#

Через Composer:

`composer require staconik/epnbzlib`

#Пример использования#

`$epn = new \EpnBzLib\EpnBz($epn_username, $epn_password); //создание объекта и авторизация на сайте `

`$promo_url = $epn->getUrl($url); //получени промо url`

`$short_url = $epn->short($promo_url); //сокращение промо урла к виду ali.pub/ABCDE`
`
