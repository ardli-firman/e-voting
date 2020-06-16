$(function () {
    $.ajax({
        url: 'konten/modul/chart_hasil.php',
        method: 'GET',
        success: function (params) {
            let data = JSON.parse(params);
            let no = []
            let jumlah = []
            for (const key in data) {
                no.push("No " + data[key].no);
                jumlah.push(data[key].jumlah);
            }

            var chardata = {
                labels: no,
                datasets: [{
                    backgroundColor: [
                        '#63ed7a',
                        '#6777ef',
                        '#191d21',
                        '#ffa426',
                        '#fc544b',
                    ],
                    data: jumlah
                }]
            };
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: chardata
            });
        }

    });
});