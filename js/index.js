pagination = () => {
    let numItems = $('.product').length;
    
    const PAGE_LIMIT = 6;

    $('.product:gt(' + (PAGE_LIMIT - 1) + ')').hide();

    let totalPages = Math.ceil(numItems / PAGE_LIMIT);
    $('.pagination').append('<li id="prev-page" class="page-item"><a class="page-link" href="javascript:void(0)">Previous</a></li>');
    $('.pagination').append('<li class="current-page page-item active"><a class="page-link" href="javascript:void(0)">' + 1 + '</a></li>');
    for(let i=2; i <= totalPages; i++){
        $('.pagination').append('<li class="current-page page-item"><a class="page-link" href="javascript:void(0)">' + i + '</a></li>');
    }

    $('.pagination').append('<li id="next-page" class="page-item"><a class="page-link" href="javascript:void(0)">Next</a></li>');

    $('.pagination li.current-page').on('click', function(){
        if($(this).hasClass('active')){
            return;
        }
        else{
            let currentPage = $(this).index();

            $('.pagination li').removeClass('active'); 
            $(this).addClass('active');
            $('.product').hide();

            let grandTotal = PAGE_LIMIT * currentPage;

            for(let i=grandTotal-PAGE_LIMIT; i < grandTotal; i++){
                $('.product:eq(' + i + ')').show();
            }
        } 
    });

    $('#next-page').on('click', function(){
        var currentPage = $('.pagination li.active').index();
        if(currentPage === totalPages){
            return;
        }
        else{
            currentPage++;
            $('.pagination li').removeClass('active');
            $('.product').hide();

            let grandTotal = PAGE_LIMIT * currentPage;

            for(let i=grandTotal-PAGE_LIMIT; i < grandTotal; i++){
                $('.product:eq(' + i + ')').show();
            }

            $('.pagination li.current-page:eq(' + (currentPage - 1) + ')').addClass('active');
        }
    });

    $('#prev-page').on('click', function(){
        var currentPage = $('.pagination li.active').index();
        if(currentPage === 1){
            return;
        }
        else{
            currentPage--;
            $('.pagination li').removeClass('active');
            $('.product').hide();

            let grandTotal = PAGE_LIMIT * currentPage;

            for(let i=grandTotal-PAGE_LIMIT; i < grandTotal; i++){
                $('.product:eq(' + i + ')').show();
            }

            $('.pagination li.current-page:eq(' + (currentPage - 1) + ')').addClass('active');
        }
    })
}


if($('.product').length > 0){
    pagination();
}