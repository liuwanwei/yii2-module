<?php

namespace buddysoft\modules\setting\models;

use Yii;

use yii\validators\Validator;
use buddysoft\modules\setting\Module;
use buddysoft\modules\setting\SettingHelper;

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
        return 'bs_setting';
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
            'value' => '内容',
            'keyֵ' => '内部变量',
            'description' => '功能简介',
            'weight' => '排序',
            'updatedAt' => '更新时间',
        ];
    }

    public function beforeValidate(){
        $module = Module::getInstance();

        /**
         *
         * 应用层直接使用 Setting.php 类时，由于不是通过 module/action-id
         * 方式访问，所以无法获取到模块对象。
         *
         * 所以必须尝试通过模块名字获取模块对象。
         * 比如：应用层直接修改 setting 记录中配置的 accessToken 更新时间
         *
         * 如果应用层 modules 中配置的模块名字不是 'setting'，就会访问失败。
         *
         */
        if (empty($module)) {            
            // $module = \Yii::$app->getModule('setting');
            // if (empty($module)) {
            //     Yii::error('模块参数获取失败，将不会对参数进行验证：' . $this->value);
            //     return;
            // }

            /**
             *
             * v2.0 开始支持自定义表名字，并允许多个配置模块并存，所以调用者自己保证数据正确性
             *
             */
            return parent::beforeValidate();
        }        

        $defaultSetting = $module->defaultSetting;

        foreach ($defaultSetting as $setting) {
            if (! isset($setting['key'])) {
                continue;
            }

            if ($setting['key'] != $this->key || !isset($setting['options'])) {
                continue;
            }

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

        return parent::beforeValidate();
    }



    /**
     *
     * 快捷访问某个属性入口
     * Deprecated: 请访问 buddysoft\modules\SettingHelper 获取以下接口
     */
    
    public static function value($key){
        $model = static::findOne(['key' => $key]);
        return empty($model) ? null : $model->value;
    }

    public static function intValue($key){
        $model = static::findOne(['key' => $key]);
        return empty($model) ? -1 : intval($model->value);
    }

    // 快捷修改某个属性接口
    public static function updateValue($key, $value){
        $model = static::findOne(['key' => $key]);
        if (empty($model)) {
            $model = new Setting();
            $model->key = $key;
        }

        // 所有属性的最终存储方式都必须是字符串
        $model->value = strval($value);
        $ret = $model->save();
        return $ret;
    }
}
