$(document).ready(function(){
    $('#latest-works').bxSlider({
        hideControlOnEnd: true,
        minSlides: 2,
        maxSlides: 4,
        slideWidth: 275,
        slideMargin: 10,
        pager: false,
        nextSelector: '#bx-next4',
        prevSelector: '#bx-prev4',
        nextText: '>',
        prevText: '<',
    });

    $('#home-block').bxSlider({
        hideControlOnEnd: true,
        minSlides: 1,
        maxSlides: 1,

        pager: false,
        nextSelector: '#bx-next5',
        prevSelector: '#bx-prev5',
        nextText: '>',
        prevText: '<',
    });
});

//$('#carousel-example-generic').on('slid.bs.carousel', function () {
//  var c = $('.carousel-indicators li.active').data('slide-to')+1;
//  console.log(c);
//  if(c == 8){      
//      $('#carousel-example-generic').carousel(0);
//  }
//});

var noticias = {};

/*
 * link
 * date
 * extract
 * img
 * title
 */
noticias.tpl = '<article class="post animated fadeInDown animation-delay-6"><div class="panel panel-default"><div class="panel-body"><h3 class="post-title"><a href=":link:" class="transicion">:title:</a></h3><div class="row"><div class="col-md-6"><img src=":img:" class="img-responsive imageborder" alt="Image"></div><div class="col-md-6"><p style="text-align: justify">:extract:</p></div></div></div><div class="panel-footer"><div class="row"><div class="col-lg-10 col-md-9 col-sm-4"><i class="fa fa-clock-o"></i> :date: </div><div class="col-lg-2 col-md-3 col-sm-4"><a href=":link:" class="pull-right" target="_blank"></a></div></div></div></div></article> <!-- post -->';
noticias.news = [];

noticias.list = function(el){
    console.log(el);
    console.log(noticias.news);
    var list = '';
    $.each(noticias.news, function(index,val){
        console.log(val);
        list += noticias.renderHtml(val);        
    });
    $(el).replaceWith(list);
    console.log(list);    
}

noticias.renderHtml = function(news_obj){
    console.log(news_obj);
    var html = noticias.tpl;
    html = html.replace(':link:', news_obj.link);
    html = html.replace(':date:', news_obj.date);
    html = html.replace(':extract:', news_obj.extract);
    html = html.replace(':img:', news_obj.img);
    html = html.replace(':title:', news_obj.title);
    return html;
    
}

noticias.add = function(link, date, extract, img, title){
    noticias.news.push({
        link : link,
        date : date,
        extract : extract,
        img : img,
        title : title
    });
}
