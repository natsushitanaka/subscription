$(function(){
    $('#alert').click(function() {
        if (!confirm('本当に削除してもよろしいですか？')) {
            return false;
        } 
      });
});