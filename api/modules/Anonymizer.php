<?php
class Anonymizer{
    static function remove_user_id($item){
        if(isset($item['user_id'])) unset($item['user_id']);
        return $item;
    }
    static function remove_user_id_from_list($items){
        $new_item_list = [];
        foreach ($items as $item) $new_item_list[] = self::remove_user_id($item);
        return $new_item_list;
    }
}