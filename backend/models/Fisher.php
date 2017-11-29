<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "fisher".
 *
 * @property integer $id
 * @property string $catalog_no
 * @property string $desc
 * @property string $desc_long Description
 * @property string $Std UOM
 * @property string $ProductClass
 * @property string $CATALOG NUMBER
 * @property string $CDC
 * @property string $PkgChg
 * @property string $SUPkgWgt
 * @property string $Temperature Requirements
 * @property string $StdUnitVol
 * @property string $CatlgPg
 * @property string $BOL
 * @property string $original_price
 (USD)
 * @property string $c
 * @property string $d
 * @property string $local_myr
 * @property string $e
 * @property string $asean_usd
 * @property string $f
 * @property string $asiapac_usd
 */
class Fisher extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fisher';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['catalog_no', 'desc', 'desc_long Description', 'Std UOM', 'ProductClass', 'CATALOG NUMBER', 'CDC', 'PkgChg', 'SUPkgWgt', 'Temperature Requirements', 'StdUnitVol', 'CatlgPg', 'BOL', 'original_price
 (USD)', 'c', 'd', 'local_myr', 'e', 'asean_usd', 'f', 'asiapac_usd'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'catalog_no' => 'Catalog No',
            'desc' => 'Desc',
            'desc_long Description' => 'Desc Long  Description',
            'Std UOM' => 'Std  Uom',
            'ProductClass' => 'Product Class',
            'CATALOG NUMBER' => 'Catalog  Number',
            'CDC' => 'Cdc',
            'PkgChg' => 'Pkg Chg',
            'SUPkgWgt' => 'Supkg Wgt',
            'Temperature Requirements' => 'Temperature  Requirements',
            'StdUnitVol' => 'Std Unit Vol',
            'CatlgPg' => 'Catlg Pg',
            'BOL' => 'Bol',
            'original_price
 (USD)' => 'Original Price
 ( Usd)',
            'c' => 'C',
            'd' => 'D',
            'local_myr' => 'Local Myr',
            'e' => 'E',
            'asean_usd' => 'Asean Usd',
            'f' => 'F',
            'asiapac_usd' => 'Asiapac Usd',
        ];
    }
}
