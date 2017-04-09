<?php

namespace buddysoft\modules;

use buddysoft\modules\setting\models\Setting;

class SettingHelper{

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

	public static function objectWithKey($key){
		return static::findOne(['key' => $key]);
	}
	
	public static function value($key){
	    $model = static::objectWithKey($key);
	    return empty($model) ? null : $model->value;
	}	

	public static function intValue($key){
	    $model = static::objectWithKey($key);
	    return empty($model) ? -1 : intval($model->value);
	}

	public static function booleanValue($key){
		$model = static::objectWithKey($key);
		if (empty($model)) {
			return false;
		}else{
			if (is_bool($model->value)) {
				return $model->value;
			}else{
				return false;
			}
		}
	}

	// 快捷修改某个属性接口
	public static function updateValue($key, $value){
	    $model = static::objectWithKey($key);
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