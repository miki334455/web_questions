<?php 
	#----------------------------------------------------------------------------------------------
	#	表示するページを変更するための処理
	#----------------------------------------------------------------------------------------------
	
	require_once('./defineContact.php');	/*定義ファイル読み込み*/

	enum PageFlag {
		case Form;		/*入力ページ*/
		case Confirm;	/*確認ページ*/
		case Comp;		/*完了ページ*/
	}

	$pageFlag = PageFlag::Form;

	if (!empty($_POST['btn_confirm'])) {
		$pageFlag = PageFlag::Confirm;
	} else if (!empty($_POST['btn_submit'])) {
		$pageFlag = PageFlag::Comp;
		
		/*自動返信メールの処理*/
		// 変数とタイムゾーンを初期化
		$auto_reply_subject = null;					/*件名*/
		$auto_reply_text = null;					/*本文*/
		date_default_timezone_set('Asia/Tokyo');
		
		//件名を設定
		$auto_reply_subject = 'お問い合わせありがとうございます。';

		//本文を設定
		$auto_reply_text = "この度はお問い合わせいただき、ありがとうございます。\n
		下記の内容でお問い合わせを受け付けました。\n\n";		
		$auto_reply_text .= "メールアドレス：" . $_POST['mailAddress'] . "\n";
		$auto_reply_text .= "お問い合わせ内容：";
		
		//問い合わせ内容を表示する
		$strAutoReply = new ContactContent();
		$sendStr = $strAutoReply->getSendStr();
		$auto_reply_text .= "お問い合わせ内容：";
		$auto_reply_text .= $sendStr;


		//メール送信
		mb_send_mail($_POST['mailAddress'],$auto_reply_subject,$auto_reply_text);
	}
?>

<!DOCTYPE html>
<html lang="ja">
<body>
	<?php switch($pageFlag): case PageFlag::Form:?>
		<div id="contact_form">
			<form action="" method="post">
				<dl>
					<dt>
						<label for="mailAddress"class="label_require">メールアドレス</label>
					</dt>
					<dd>
						<input id="mailAddress" type="email" name="mailAddress" placeholder="例）example@temp.com">
					</dd>
					<dt>
						<label for="contents" class="label_require">お問い合わせ内容</label>
					</dt>
					<dd>
						<textarea id="contents" type="text" name="contents" placeholder="お問い合わせ内容をご入力ください。"></textarea>
					</dd>
				</dl>
				<div id="btn_contact_form">
					<input class="btn_submit" type="submit" name ="btn_confirm" value="入力内容を確認する">
				</div>
			</form>
		</div>
		<?php break; ?>
		<?php case PageFlag::Confirm: ?>
			<!-- 表示用 -->
			<div id="contact_confirm">
				<dl>
					<dt>
						<p class="label_require">メールアドレス</p>
					</dt>
					<dd>
						<p><?php echo $_POST['mailAddress']; ?></p>
					</dd>
					<dt>
						<p class="label_require">お問い合わせ内容</p>
					</dt>
					<dd>
						<?php
							$str = $_POST['contents'];
							$sendContent = new ContactContent();
							$sendContent->constructer();
							$sendContent->setSendStr($str);
							$content = $sendContent->getSendStr();
							echo $str;
						?>
					</dd>
				</dl>
				<div id="btn_contact_confirm">
					<form action="" method="post">
						<input id="btn_back" class="btn_submit" type="submit" name="btn_back" value="入力画面に戻る">
						<input class="btn_submit" type="submit" name="btn_submit" value="送信する">
						<!-- サーバーへ受け渡し用 -->
						<input type="hidden" name="mailAddress">
						<input type="hidden" name="contents">
					</form>
				</div>
			</div>
			<?php break; ?>
		<?php case PageFlag::Comp: ?>
			<div id="contact_comp">
				<p>お問い合わせありがとうございます。</p>
				<a href="./contact.php">戻る</a>
			</div>
			<?php break; ?>
		<?php default: ?>
			<?php break; ?>
		<?php endswitch ?>
</body>
</html>