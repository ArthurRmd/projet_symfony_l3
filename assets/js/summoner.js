function delay(callback, ms) {
    let timer = 0;
    return function () {
        let context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}

function ajax() {
    const summonerName = document.querySelector('.search').value
    if (summonerName !== "") {
        document.querySelector('.response').innerHTML = ""
        loaderShow(true)
        fetch(`/summoner-data/${summonerName}`, {
            method: 'GET',
        })
            .then(res => res.json())
            .then(res => {
                loaderShow(false)
                document.querySelector('.response').innerHTML = res.view
            })
    }

}

function loaderShow( boolean) {

    const css = boolean ? "block" : "none"
    document.querySelector('.loader').style.display = css

}

document.querySelector('.search').addEventListener('keyup', delay(() => ajax(), 500))
document.querySelector('.btn-search').addEventListener('click',  () => ajax())

if ( document.querySelector('.search').value !== "") ajax()