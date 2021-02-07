// stockData stores JSON file data from api()
console.log(x);
let stockData;
api().then(res => stockData = res);
// timeSeries gets 'Monthly Time Series' object from stockData
let timeSeries;

let seriesArray;
let timeArray;

let stocks = [];

// api gets the JSON file
async function api() {
    let res = await fetch('https://www.alphavantage.co/query?function=TIME_SERIES_MONTHLY&symbol=IBM&apikey=demo');
    let data = await res.json();
    return data;
}

// gets the data from stockData after 3 secto let api() perform its action
extracter();

function extracter() {
    setTimeout(function() {
        timeSeries = stockData['Monthly Time Series'];

        timeArray = Object.keys(timeSeries);
        seriesArray = Object.keys(timeSeries).map(i => timeSeries[i]);

        try {
            for (let i = 0; i <= seriesArray.length; i++) {
                let plsWork = {
                    time: timeArray[i],
                    open: parseFloat(seriesArray[i]['1. open']),
                    high: parseFloat(seriesArray[i]['2. high']),
                    low: parseFloat(seriesArray[i]['3. low']),
                    close: parseFloat(seriesArray[i]['4. close'])
                };
                stocks.push(plsWork);
            }
        } catch (error) {
            console.log(error);
        }

        stocks.reverse();

        // console.log("pass");
        // console.log(stocks);

        candleStickChart();

        var graph = document.getElementsByClassName("tv-lightweight-charts");
        var container = document.getElementsByClassName("graph");

        $(graph).appendTo(container);

    }, 3000);
}

function candleStickChart() {

    var chart = LightweightCharts.createChart(document.body, {
        width: 730,
        height: 500,
        layout: {
            backgroundColor: '#fff',
            textColor: 'rgba(0, 0, 0, 0.9)',
        },
        grid: {
            vertLines: {
                color: 'rgba(197, 203, 206, 0.5)',
            },
            horzLines: {
                color: 'rgba(197, 203, 206, 0.5)',
            },
        },
        crosshair: {
            mode: LightweightCharts.CrosshairMode.Normal,
        },
        rightPriceScale: {
            borderColor: 'rgba(197, 203, 206, 0.8)',
        },
        timeScale: {
            borderColor: 'rgba(197, 203, 206, 0.8)',
        },
    });

    var candleSeries = chart.addCandlestickSeries({
        upColor: '#25a50a',
        downColor: '#ba182b',
        borderUpColor: '#25a50a',
        borderDownColor: '#ba182b',
        wickDownColor: '#ba182b',
        wickUpColor: '#25a50a',
    });


    candleSeries.setData(
        stocks
    );

}