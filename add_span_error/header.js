$(function(){
	// $('header').append('<h1>ゆうなぁもぎおん応援サイト</h1>');

	// var name = ["ゆう","なぁ","もぎ","おん"];
	// $('h1').contents().filter(function(){								//filter関数のおかげでh1タグのnodeTypeを抽出できる。
	// 	if(this.nodeType == 3) {
	// 		$.each(name, function(index, val) {
	// 			// console.log($('h1').text().indexOf(val));			// test(問題なし：4人分の名前の開始位置が出た。)
	// 			var nameStartPosi = $('h1').text().indexOf(val);
	// 			if (nameStartPosi == 0) {
	// 				console.log($this);		/*$thisはh1タグを指していない*/
	// 				//$('h1').replaceWith($(this).text().replace(val,"<span class='yu_color'>ゆう</span>"));	/*ここで無限ループしてる→$thisが原因*/
	// 				// var result = $('h1').text().replace(val,"<span class='yu_color'>ゆう</span>");
	// 				// $('h1').text(result);		/*spanタグが入る事により、なぁ、もぎ、おんの開始位置が変わる。*/
	// 			}
	// 			else if (nameStartPosi == 2) {
	// 				$('h1').replaceWith($(this).text().replace(val,"<span class='na_color'>なぁ</span>"));
	// 			}
	// 			else if (nameStartPosi == 4) {
	// 				$('h1').replaceWith($(this).text().replace(val,"<span class='mogi_color'>もぎ</span>"));
	// 			}
	// 			else if (nameStartPosi == 6) {
	// 				$('h1').replaceWith($(this).text().replace(val,"<span class='onn_color'>おん</span>"));
	// 			}
	// 			else {
	// 				return false;
	// 			}

	// 		})
	// 	}
	// })

	var menbers = [
		{ name:'ゆう', class: 'yu_color' },
		{ name:'なぁ', class: 'na_color' },
		{ name:'もぎ', class: 'mogi_color' },
		{ name:'おん', class: 'onn_color' }
	];

	$('header').append('<h1>');
	$.each(menbers,function(index,val){
		$('h1').append('<span>');
		$('span').eq(index).text(val.name).addClass(val.class);
	})
	$('h1').append('応援サイト');

});
