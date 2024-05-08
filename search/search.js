$(document).ready(function(){
    var initialContent = $('.container').html();
    $('#searchBox').on('keydown', function(){
        var searchText = $(this).val();
        if (searchText !== '') {
            $.ajax({
                url:'http://localhost/4thsemProj/search/search.php',
                type:'POST',
                data: {
                    query: searchText
                },
                success: function(data){
                    $('.container').html(data);
                }
            });
        }else {
            // If search box is empty, restore the initial content
            $('.container').html(initialContent);
        }
    });
});
