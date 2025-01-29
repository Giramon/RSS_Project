<?php

$error = 0;

$MODE = isset($_REQUEST['MODE']) ? $_REQUEST['MODE'] : $error = -101;

$available_endpoints_array = ['create_post_vk','create_post_tg'];

if (in_array($MODE, $available_endpoints_array)) {
    switch ($MODE) {
        case 'create_post_vk':
            require_once ('modules/post_vk.php');
            echo "сюда положить VK";
            break;
        case 'create_post_tg':
            require_once ('modules/post_tg.php');
            // $output=sendChatMessage($web_hook_server_url,'im.message.add',$message_params); добавить метод на ТГ
            echo "сюда положить TG";
            break;
        case 'create_post_vk_tg':
            echo "добавить сюда все соц сети";
            
            break;
        default:
            echo "Unsupported mode: $MODE";
            break;
    }
} else {
    echo "Invalid mode: $MODE";
}

?>