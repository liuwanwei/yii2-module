<?php

namespace buddysoft\modules\setting;

use buddysoft\modules\setting\models\Setting;

class Module extends \yii\base\Module{

	public $defaultSettings;

	public function init(){
		parent::init();

		// 加载配置文件中定义的配置项信息
		foreach ($this->defaultSettings as $setting) {
			$model = new Setting();
			$model->load($setting, '');

			// 如果配置项不存在，向数据库中添加
			$existed = Setting::findOne(['key' => $model->key]);
			if (empty($existed)) {
				$model->save();
			}
		}		
	}
}