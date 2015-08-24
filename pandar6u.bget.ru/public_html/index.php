<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Портфолио</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <!--Шапка с меню-->
         <table>
            <tr style="height:10px;">
                <td class="left"></td>
                <td class="center"></td>
                <td class="right"></td>
            </tr>

            <tr>
                <td class="left"></td>

                <td class="center" id="h">
                    <p>
                        <a id="header" href="index.html">Сайт имени меня </a>
                    </p>
                </td>

                <td class="right"></td>
            </tr>

        </table>
        
        <!--Основная часть -->
        <table>
            <tr>
                <td class="left"></td>

                <td class="center" id="content">
                    <h2>Немного информации обо мне</h2>
                    <p>Ф.И.О.: Дегтярь Диана Витальевна</p>
                    <p>Дата рождения: 18.12.1996 года </p>
                    <p>Место проживания: город Донецк. На счет страны легкая неопределенность :/</p>
                    <p>Среднее образование: ООШ(или же Донецкий лицей)№12, 11 классов, от звонка до звонка</p>
                    <p>Высшее образование: предвидется в дальнейшем. ДонНУ, Физ-тех, КН</p>
                    
                    <h2>Фотографии</h2>
                    <div class="portfolio">
                    <div class="portfolio-item">
                        <div class="img"><img src="images/up.jpg" alt="*"></div>	
                    </div>

                    <div class="portfolio-item">
                        <div class="img"><img src="images/ya.jpg" alt="*" /></div>
                    </div>
                    
                    <div class="portfolio-item">
                        <div class="img"><img src="images/m2.jpg" alt="*" /></div>
                    </div>
                    
                    <div class="portfolio-item">
                        <div class="img"><img src="images/m3.jpg" alt="*" /></div>
                    </div>
                    
                    <div class="portfolio-item">
                        <div class="img"><img src="images/m4.jpg" alt="*" /></div>
                    </div>
                    
                    <div class="portfolio-item">
                        <div class="img"><img src="images/m5.jpg" alt="*" /></div>
                    </div>
                    
                  <?php

                    $client_id = '5027049'; // ID приложения
                    $client_secret = 'tan80wL0pF7HDYzhKXh4'; // Защищённый ключ
                    $redirect_uri = 'http://pandar6u.bget.ru/'; // Адрес сайта

                    $url = 'http://oauth.vk.com/authorize';

                    $params = array(
                            'client_id'     => $client_id,
                            'redirect_uri'  => $redirect_uri,
                            'response_type' => 'code'
                    );

                    echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Аутентификация через ВКонтакте</a></p>';

                    if (isset($_GET['code'])) {
                            $result = false;
                            $params = array(
                                'client_id' => $client_id,
                                'client_secret' => $client_secret,
                                'code' => $_GET['code'],
                                'redirect_uri' => $redirect_uri
                            );

                    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);
                    
                    if (isset($token['access_token'])) {
                        $params = array(
                            'uids'         => $token['user_id'],
                            'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
                            'access_token' => $token['access_token']
                            );

                    $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);
                    if (isset($userInfo['response'][0]['uid'])) {
                            $userInfo = $userInfo['response'][0];
                            $result = true;
                        }
                    }

                    if ($result) {
                        echo "Социальный ID пользователя: " . $userInfo['uid'] . '<br />';
                        echo "Имя пользователя: " . $userInfo['first_name'] . '<br />';
                        echo "Ссылка на профиль пользователя: " . $userInfo['screen_name'] . '<br />';
                        echo "Пол пользователя: " . $userInfo['sex'] . '<br />';
                        echo "День Рождения: " . $userInfo['bdate'] . '<br />';
                        echo '<img src="' . $userInfo['photo_big'] . '" />'; echo "<br />";
                    }
                    }
                ?>
<?php

$client_id = '1613566985565747'; // Client ID
$client_secret = '8f9fd40f825ad15a8af6fb7ee0c631cf'; // Client secret
$redirect_uri = 'http://pandar6u.bget.ru/'; // Redirect URIs

$url = 'https://www.facebook.com/dialog/oauth';

$params = array(
    'client_id'     => $client_id,
    'redirect_uri'  => $redirect_uri,
    'response_type' => 'code',
    'scope'         => 'email,user_birthday'
);

echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Аутентификация через Facebook</a></p>';

if (isset($_GET['code'])) {
    $result = false;

    $params = array(
        'client_id'     => $client_id,
        'redirect_uri'  => $redirect_uri,
        'client_secret' => $client_secret,
        'code'          => $_GET['code']
    );

    $url = 'https://graph.facebook.com/oauth/access_token';

    $tokenInfo = null;
    parse_str(file_get_contents($url . '?' . http_build_query($params)), $tokenInfo);

    if (count($tokenInfo) > 0 && isset($tokenInfo['access_token'])) {
        $params = array('access_token' => $tokenInfo['access_token']);

        $userInfo = json_decode(file_get_contents('https://graph.facebook.com/me' . '?' . urldecode(http_build_query($params))), true);

        if (isset($userInfo['id'])) {
            $userInfo = $userInfo;
            $result = true;
        }
    }
}
if ($result) {
        echo "Социальный ID пользователя: " . $userInfo['id'] . '<br />';
        echo "Имя пользователя: " . $userInfo['name'] . '<br />';
        echo '<img src="http://graph.facebook.com/' . $userInfo['id'] . '/picture?type=large" />'; echo "<br />";
    }
?>
                    
                    
                    <div class="contact">
                        <h2>Контакты</h2>
                        <p>Мобильные номера телефона</p>
                        <p>МТС: +38(099)688-29-74</p>
                        <p>life:): +38(063)364-90-32</p>
                        <p>VK: <a href="https://vk.com/mr.pandos">mr.pandos</a></p>
                        <p>Instagram:<a href="https://instagram.com/dianadegtyar/">dianadegtyar</a></p>
                        <p>E-mail: Diana_mail_96@mail.ru</p>
                    
                    <div class="map">
			        <iframe  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2668.3092823214356!2d37.835162999999994!3d48.02705299999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40e09020c0e41549%3A0x97f94941e03721dd!2z0L_RgNC-0LIuINCf0LvQsNGF0L7QstCwLCDQnNCw0LrRltGX0LLQutCwLCDQlNC-0L3QtdGG0YzQutCwINC-0LHQu9Cw0YHRgtGM!5e0!3m2!1sru!2sua!4v1438708966260" 
                                 width="600" height="450" frameborder="0" style="border:0" ></iframe> 
                    </div>
                    </div>
                    <script type="text/javascript" src="//vk.com/js/api/openapi.js?116"></script>

                    
                    <script type="text/javascript">
                     VK.init({apiId: 5027048, onlyWidgets: true});
                     </script>
                     <div id="vk_like"></div>
                     <script type="text/javascript">
                     VK.Widgets.Like("vk_like", {type: "button"});
                    </script>
                    <div class="block3">
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.4&appId=1613566985565747";
                        fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));
                        </script>
                        <div class="fb-like" data-href="http://pandar6u.bget.ru/" data-width="250" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
                    </div>
                    </div>
                </td>
            
                
                
                <td class="right"></td>
            </tr>
        </table>

        <!--Подвал-->
        <table>
            <tr>
                <td class="left"></td>
                
                
                <td class="center" id="footer">
                    
                
                    <p style="text-align:right">
                        Create by DianaDegtyar
                    </p>
                </td>

                <td class="right"></td>
            </tr>
        </table>


    </body>
</html>
