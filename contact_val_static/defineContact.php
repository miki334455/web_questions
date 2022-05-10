<?php
	class ContactContent
	{
		private static $sendStr;

		public function constructer()
		{
			self::$sendStr = "";
		}

		public function setSendStr($str)
		{
			self::$sendStr = $str;
		}

		public function getSendStr()
		{
			return self::$sendStr;
		}
	}
