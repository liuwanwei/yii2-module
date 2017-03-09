<?php

namespace buddysoft\modules\setting\models;

use Yii;

use yii\validators\Validator;
use buddysoft\modules\setting\Module;

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
            'updatedAt' => '更新时间',
        ];
    }

    public function beforeValidate(){
        $module = Module::getInstance();

        /**
         *
         * 应用层直接使用 Setting.php 类时，由于并不是通过 module/action-id
         * 方式访问，所以无法获取到模块对象。所以尝试通过模块名字获取模块对象。
         * 如果应用层 modules 中配置的模块名字不是 setting，就会访问失败。
         *
         */
        if (empty($module)) {            
            $module = \Yii::$app->getModule('setting');
            if (empty($module)) {
                Yii::error('模块参数获取失败，将不会对参数进行验证：' . $this->value);
                return;
            }
        }        

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
     * 加载默认配置项
     *
     * 注意不要放到 Module 的 init 中调用，此时调用时模块初始化未完成，
     * Module::getInstance() 会返回 null
     */
    
    public static function prepareDefaultSettings(){
        $module = Module::getInstance();
        $defaultSettings = $module->defaultSettings;

        // 加载配置文件中定义的配置项信息
        foreach ($defaultSettings as $setting) {
            $model = new Setting();
            $model->load($setting, '');

            // 如果配置项不存在，向数据库中添加
            $existed = Setting::findOne(['key' => $model->key]);
            if (empty($existed)) {
                $model->save();
            }
        }       
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
