var options = {
    valueNames: ['name'],
    page: 10,
    pagination: {
        innerWindow: 1,
        left: 0,
        right: 0,
        paginationClass: "pagination",
    }
};

var hackerList = new List('search-zone', options);

$('.jPaginateNext').on('click', function () {
    var list = $('.pagination').find('li');
    $.each(list, function (position, element) {
        if ($(element).is('.active')) {
            $(list[position + 1]).trigger('click');
        }
    })
});


$('.jPaginateBack').on('click', function () {
    var list = $('.pagination').find('li');
    $.each(list, function (position, element) {
        if ($(element).is('.active')) {
            $(list[position - 1]).trigger('click');
        }
    })
});