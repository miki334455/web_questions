<?php 
	
	#----------------------------------------------------------------------------------------------
	#	表示するページを変更するための処理
	#----------------------------------------------------------------------------------------------
	
	//PHPMailerクラスをネーム空間にインポート
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	enum PageFlag {
		case Form;		/*入力ページ*/
		case Confirm;	/*確認ページ*/
		case Comp;		/*完了ページ*/
	}

	$pageFlag = PageFlag::Form;

	if (!empty($_POST['btn_confirm']))
	{
		$pageFlag = PageFlag::Confirm;
	}
	else if (!empty($_POST['btn_submit']))
	{
		$pageFlag = PageFlag::Comp;
		
		/*自動返信メールの処理*/
		//変数とタイムゾーンを初期化
		$auto_reply_subject = null;					//件名
		$auto_reply_text_text = null;				//本文
		$admin_reply_subject = null;				//管理者側の件名
		$admin_reply_text = null;					//管理者側の本文
		date_default_timezone_set('Asia/Tokyo');

		//メール日本語対応
		mb_language("japanese");
		mb_internal_encoding("UTF-8");

		require_once('./vendor/autoload.php');		//Composer の autoloader をロード

		//インスタンス生成
		$mail = new PHPMailer();

		//デバッグ機能の設定
		$mail->SMTPDebug = 2;
		$mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str<br>";};

		//SMTPの設定
		$mail->isSMTP();									//SMTP利用
		$mail->Host = 'smtp.gmail.com';						//SMTPサーバーを設定
		$mail->SMTPAuth = true;								//SMTP認証を有効にする
		$mail->Username = 'xxxxx@gmail.com';			//ユーザ名
		$mail->Password = 'xxxxx';				//パスワード
		$mail->SMTPSecure = 'tls';							//暗号化通信
		$mail->Port = 587;									//TCPポート

		//文字セットとエンコーディングの設定
		$mail->CharSet = 'UTF-8';
		$mail->Encoding = 'base64';
		
		// ヘッダーを設定
		$mail->setFrom('xxxxx@gmail.com','temp');
		$mail->addAddress($_POST['to'], $_POST['name']);		//送信先メールアドレスと名前
		
		//件名を設定
		$auto_reply_subject = 'お問い合わせありがとうございます。';
		$mail->Subject = $auto_reply_subject;

		//本文を設定
		$auto_reply_text = "この度はお問い合わせいただき、ありがとうございます。\n下記の内容でお問い合わせを受け付けました。\n\n";
		$auto_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
		$auto_reply_text .= "お名前：" . $_POST['name'] . "\n";
		$auto_reply_text .= "メールアドレス：" . $_POST['to'] . "\n";
		$auto_reply_text .= "お問い合わせ内容：" . "\n";
		$auto_reply_text .= $_POST['message'];
		$mail->Body = $auto_reply_subject;

		//メール送信
		$mail->send();

		/*管理者側にメールを送信する*/
		//管理者のメールアドレス
		$adminEmail = 'xxxxx@gmail.com';

		//管理者側の件名
		$admin_reply_subject = "お問い合わせを受け付けました";
		$mail->Subject =$admin_reply_subject;

		//管理者側の本文を設定
		$admin_reply_text = "下記の内容でお問い合わせがありました。\n\n";
		$admin_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n";
		$admin_reply_text .= "お名前：" . $_POST['name'] . "\n";
		$admin_reply_text .= "メールアドレス：" . $_POST['to'] . "\n";
		$admin_reply_text .= "お問い合わせ内容：" . "\n";
		$admin_reply_text .= $_POST['message'];
		$mail->Body = $admin_reply_text;

		//管理者側へメール送信
		$mail->clearAllRecipients();		/*送信先情報を削除*/
		$mail->addAddress($adminEmail, 'xxxxx');		/*管理者のアドレスを設定*/
		$mail->send();
	}
?>