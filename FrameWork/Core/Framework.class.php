<?php
/**
 * Created by PhpStorm.
 * User: jieai
 * 核心启动类
 * Date: 2016-12-29
 * Time: 9:24
 */
class Framework{

	/**
	 *
	 */
	public static function Run()
	{
		//echo "Hello World";
		self::init();
		self::autoload();
		self::dispatch();
	}

	/**
	 *初始化方法
	 */
	protected static function init()
	{
		define("DS", DIRECTORY_SEPARATOR);
		define("ROOT", getcwd() . DS); //根路径
		define("APP_PATH", ROOT . "application" . DS);
		define("FRAMEWORK_PATH",ROOT . "framework" .DS);
		define("PUBLIC_PATH", ROOT . "public" .DS);
		define("CONFIG_PATH", APP_PATH . "config" .DS);
		define("CONTROLLER_PATH", APP_PATH . "controllers" .DS);
		define("MODEL_PATH", APP_PATH . "models" .DS);
		define("VIEW_PATH", APP_PATH . "views" .DS);
		define("CORE_PATH", FRAMEWORK_PATH . "core" .DS);
		define("DB_PATH", FRAMEWORK_PATH . "databases" .DS);
		define("LIB_PATH", FRAMEWORK_PATH . "libraries" .DS);
		define("HELPER_PATH", FRAMEWORK_PATH . "helpers" .DS);
		define("UPLOAD_PATH", PUBLIC_PATH . "uploads" .DS);

		//index.php?p=admin&c=goods&a=add--后台的GoodsController中的addAction

		//define("PLATFORM", isset($_GET['p']) ? $_GET['p'] : "admin" );
		define("PLATFORM",isset($_GET['p'])?$_GET['p']:"Admin");
        //设置默认的控制器为INDEX
		define("CONTROLLER", isset($_GET['c']) ? ucfirst($_GET['c']) : "Index" );
        //设置默认动作为INDEX..呵呵.很牛逼啊
		define("ACTION", isset($_GET['a']) ? $_GET['a'] : "Index" );
		define("CUR_CONTROLLER_PATH", CONTROLLER_PATH . PLATFORM . DS );
		define("CUR_VIEW_PATH", VIEW_PATH . PLATFORM . DS);


	}

	/**路由分发
	 *
	 */
	protected static function dispatch()
	{
		$controllername=CONTROLLER."Controller";
		$actionname=ACTION.'Action';
		$controll=new $controllername;
		$controll->$actionname();


	}

	/**
	 *自动载入
	 */
	protected static function autoload()
	{
spl_autoload_register(array(__CLASS__,'load'));
	}

    private static function load($classname)
    {
        if(substr($classname,-10)=='Controller'){
            include CUR_CONTROLLER_PATH."{$classname}.class.php";

        }elseif(substr($classname,-5)=='Model')
        {
            include MODEL_PATH."{$classname}.class.php";
        }else{

        }
	}
}