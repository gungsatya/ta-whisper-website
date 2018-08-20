<script src="<?php echo base_url('assets/panel/js/lib/chart-js/Chart.bundle.js')?>"></script>

<script>
    new Chart(document.getElementById("myChart"), {
        "type": "line",
        "data": {
            "labels": ["January", "February", "March", "April", "May", "June", "July"],
            "datasets": [{
                "label": "Jumlah Pengaduan",
                "data": [65, 59, 80, 81, 56, 55, 40],
                "fill": false,
                "borderColor": "rgb(75, 192, 192)",
                "lineTension": 0
            }]
        },
        "options": {}
    });
</script>