<template>
    <div class="">
        <div class="card me-3 ms-3 me-3 p-3" style="width: 100%;">
            <div id="chartdiv3"></div>
        </div>
    </div>
</template>

<script>

import am5themes_Animated from "@amcharts/amcharts5/themes/Animated";
import * as am5 from "@amcharts/amcharts5";
import * as am5xy from "@amcharts/amcharts5/xy";

export default {
    props: {
        users: {
            type: Array,
            required: true,
        }
    },
    methods: {
        generateChart() {
            let root = am5.Root.new("chartdiv3");

            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            let chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: true,
                panY: true,
                wheelX: "panX",
                wheelY: "zoomX",
                pinchZoomX: true,
                paddingLeft:0,
                paddingRight:1,
                paddingTop: 50,
            }));

            let title = am5.Label.new(root, {
                        text: "Graphique des Équipes",
                        fontSize: 25,
                        fontWeight: "700",
                        textAlign: "center",
                        x: am5.percent(1),
                        y: am5.percent(-15),
                        centerX: am5.percent(0),
                        paddingTop: 0,
                        paddingBottom: 0,
                        marginBottom: 0,
                    });

            chart.children.unshift(title);

            let cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineY.set("visible", false);
            let xRenderer = am5xy.AxisRendererX.new(root, { 
                minGridDistance: 30, 
                minorGridEnabled: true
            });

            xRenderer.labels.template.setAll({
            rotation: -90,
            centerY: am5.p50,
            centerX: am5.p100,
            paddingRight: 15
            });

            xRenderer.grid.template.setAll({
            location: 1
            })

            let xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
            maxDeviation: 0.3,
            categoryField: "country",
            renderer: xRenderer,
            tooltip: am5.Tooltip.new(root, {})
            }));

            xAxis.onPrivate("cellWidth", function(cellWidth) {
                let rotated = false;
                xRenderer.labels.each(function(label) {
                    if (label.width() > cellWidth) {
                        rotated = true;
                    }
                });
                if (rotated) {
                    xRenderer.labels.template.setAll({
                        rotation: -45,
                        centerX: am5.p100
                    });
                } else {
                    xRenderer.labels.template.setAll({
                        rotation: 0,
                        centerX: am5.p50
                    });
                }
            });

            let yRenderer = am5xy.AxisRendererY.new(root, {
                strokeOpacity: 0.1
            })

            let yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0.3,
                renderer: yRenderer
            }));
            let series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Series 1",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                sequencedInterpolation: true,
                categoryXField: "country",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}"
                })
            }));

            series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });
            series.columns.template.adapters.add("fill", function (fill, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            series.columns.template.adapters.add("stroke", function (stroke, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            const data = this.equipes.map(equipe => ({
                country: equipe.equipe,
                value: equipe.count
            }));
            xAxis.data.setAll(data);
            series.data.setAll(data);
            series.appear(1000);
            chart.appear(1000, 100);
        },
        equipesP() {
            const equipesCount = {};
            this.users.forEach(user => {
                const equipe = user.team;
                if (!equipesCount[equipe]) {
                    equipesCount[equipe] = { count: 1 };
                } else {
                    equipesCount[equipe].count++;
                }
            });
            console.log(equipesCount);
            this.equipes = Object.entries(equipesCount).map(([equipe, data]) => ({ equipe, ...data }));
            console.log(this.equipes)
        },
    },
    mounted() {
        this.equipesP();
        this.generateChart();
    }
}

</script>

<style scoped>
#chartdiv3 {
    width: 100%;
    height: 400px;
  }
</style>