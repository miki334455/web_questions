$(function(){
	//h1タグの追加
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
	$('h1').wrap('<a href="#"></a>');

	//メニューアイコンの追加
	$('header').append('<a href="#"><img src="../images/menuIcon.png" alt="メニューアイコン"></a>');
});
