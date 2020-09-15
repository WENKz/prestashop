<?php
/**
  * 2019 (c) VueFront
 * 2020 (c) Yownes
 *
 * MODULE Yownes
 *
 * @author    VueFront, Yownes
 * @copyright Copyright (c) permanent, VueFront
 * @copyright Copyright (c) permanent, Yownes
 * @license   MIT
 * @version   0.1.0
 */

class ModelCommonAddress extends Model
{
    public function getAddress($address_id)
    {
        $sql = new DbQuery();
        $sql->select('*');
        $sql->from('address', 'a');
        $sql->where('a.`id_address` = '.(int)$address_id);

        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        return !empty($result) ? $result[0] : false;
    }
}
