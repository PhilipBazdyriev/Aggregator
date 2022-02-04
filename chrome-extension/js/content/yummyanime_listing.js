
function yummyanime_listing() {
    let pageCount = $(".pagination li[data-pos]").last().text();
    let urls = []
    $(".image-block").each(function() {
        urls.push($(this).attr('href'))
    })
    let currentPage = 0
    let urlParts = document.location.href.split("page=")
    if (urlParts.length == 2) {
        currentPage = urlParts[1]
    }
    messaging.send('spyYummyAnimeListing', {
        pageCount: pageCount,
        currentPage: currentPage,
        urls: urls
    })
}
