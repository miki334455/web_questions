$(function(){
	$('header').append('<h1>ゆうなぁもぎおん応援サイト</h1>');

	var name = ["ゆう","なぁ","もぎ","おん"];
	$('h1').contents().filter(function(){								//filter関数のおかげでh1タグのnodeTypeを抽出できる。
		if(this.nodeType == 3) {
			$.each(name, function(index, val) {
				// console.log($('h1').text().indexOf(val));			// test(問題なし：4人分の名前の開始位置が出た。)
				var nameStartPosi = $('h1').text().indexOf(val);
				if (nameStartPosi == 0) {
					$('h1').replaceWith($(this).text().replace(val,"<span class='yu_color'>ゆう</span>"));	/*ここで無限ループしてる*/
				}
				else if (nameStartPosi == 2) {
					$('h1').replaceWith($(this).text().replace(val,"<span class='na_color'>なぁ</span>"));
				}
				else if (nameStartPosi == 4) {
					$('h1').replaceWith($(this).text().replace(val,"<span class='mogi_color'>もぎ</span>"));
				}
				else if (nameStartPosi == 6) {
					$('h1').replaceWith($(this).text().replace(val,"<span class='onn_color'>おん</span>"));
				}
				else {
					return false;
				}

			})
		}
	})

	/*以下は正しい動作になる。*/
	// $(function(){
	// $('header').append('<h1>ゆうなぁもぎおん応援サイト</h1>');

	// $('h1').contents().filter(function(){								//filter関数のおかげでh1タグのnodeTypeを抽出できる。
	// 	if(this.nodeType == 3) {
	// 		if ($('h1').text().indexOf("ゆう") != -1) {
	// 				$('h1').replaceWith($(this).text().replace("ゆう",
	// 				"<span class='yu_color'>ゆう</span>"));
	// 		}
	// 	}
	// })	
});
