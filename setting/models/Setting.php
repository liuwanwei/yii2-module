<?php

namespace buddysoft\modules\setting\models;

use Yii;

use yii\validators\Validator;

/**
 * This is the model class for table "setting".
 *
 * @property integer $id
 * @property string $name
 * @property string $key
 * @property string $value
 * @property string $description
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'key'], 'required'],
            [['weight'], 'integer'],
            [['name', 'value', 'description'], 'string'],
            [['name'], 'string', 'max' => 32],
            [['key'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '配置项',
            'keyֵ' => 'key',
            'value' => '值',
            'description' => '描述',
            'weight' => '排序',
        ];
    }

    public function beforeValidate(){
        $module = \buddysoft\modules\setting\Module::getInstance();
        $defaultSettings = $module->defaultSettings;

        foreach ($defaultSettings as $setting) {
            if ($setting['key'] == $this->key  && isset($setting['options'])) {

                $options = $setting['options'];

                if (isset($options['validator'])) {

                    $validator = $options['validator'];
                    if (isset($options['params'])) {
                        $params = $options['params'];
                    }else{
                        $params = [];
                    }

                    $validator = Validator::createValidator($validator, $this, 'value', $params);
                    $ret = $validator->validate($this->value);
                    if (false === $ret) {
                        $this->addError('value', $validator->message);
                        return false;
                    }
                }
            }
        }

        return parent::beforeValidate();
    }

    /**
     *
     * 快捷访问某个属性入口
     */
    
    public static function value($key){
        $model = static::findOne(['key' => $key]);
        return empty($model) ? null : $model->value;
    }

    public static function intValue($key){
        $model = static::findOne(['key' => $key]);
        return empty($model) ? -1 : intval($model->value);
    }
}
