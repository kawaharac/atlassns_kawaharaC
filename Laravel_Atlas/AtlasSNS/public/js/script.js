$(function () {
  $('.js-modal-open').on('click', function () {
    $('.js-modal').fadeIn();
    var post = $(this).attr('post');
    var post_id = $(this).attr('post_id');
    //attrメソッド=HTML要素の様々な属性の値を取得や変更ができる。
    //id class 属性を取得・変更・設定。
    // = class名”js-modal-open”が入ったbuttonタグ内の要素、 "post"($list->post)　の値を変数名postに格納する。（同様に変数名post_idに　buttonタグ内要素　"post_id"($list->id)を入れる）
    $('.halt').val(post_id);
    $('.test').text(post);
    //class "halt" （inputタグ）の値はpost_idの値とする。
    //同様に　class "test" （textareaタグ）のテキストはpostの値とする。
    return false;
  });
  $('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut();
    return false;
  });
  //accordionメニュー
  $(function () {
    //クリックで動く
    $('.accordion').click(function () {
      $(this).toggleClass('active');
      $('.accordion-menu').toggleClass('active');
      // $(this).find('ul').slideToggle();
      // $('.sub_menu').slideToggle();<=閉じる動作になる
    });
  });
  $(function () {
    //searchしたら検索ワードが出る
    $('')
  })
});
