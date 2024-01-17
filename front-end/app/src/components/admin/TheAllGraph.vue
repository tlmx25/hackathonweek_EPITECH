<template>
    <div class="card p-3">
        <div id="chartdiv"></div>
    </div>
</template>

<script>
import am5themes_Animated from "@amcharts/amcharts5/themes/Animated";
import * as am5 from "@amcharts/amcharts5";
import * as am5xy from "@amcharts/amcharts5/xy";

export default {
    mounted() {
        let root = am5.Root.new("chartdiv");

        root.setThemes([
            am5themes_Animated.new(root)
        ]);

        let chart = root.container.children.push(
            am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: "none",
                wheelY: "none",
                paddingLeft: 0,
                paddingTop: 50,
            })
        );
        
        let title = am5.Label.new(root, {
            text: "Graphique des Postes, Agences et Équipes",
            fontSize: 25,
            fontWeight: "700",
            textAlign: "center",
            x: am5.percent(1),
            y: am5.percent(-13),
            centerX: am5.percent(0),
            paddingTop: 0,
            paddingBottom: 0,
            marginBottom: 10,
        });
        
        chart.children.unshift(title);

        let cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
        cursor.lineY.set("visible", false);

        let xRenderer = am5xy.AxisRendererX.new(root, { 
            minGridDistance: 30, 
            minorGridEnabled:true
        });

        xRenderer.labels.template.setAll({ text: "{realName}" });

        let xAxis = chart.xAxes.push(
            am5xy.CategoryAxis.new(root, {
                maxDeviation: 0,
                categoryField: "category",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {
                labelText: "{realName}"
                })
            })
        );

        let yAxis = chart.yAxes.push(
            am5xy.ValueAxis.new(root, {
                maxDeviation: 0.3,
                renderer: am5xy.AxisRendererY.new(root, {})
            })
        );

        let yAxis2 = chart.yAxes.push(
            am5xy.ValueAxis.new(root, {
                maxDeviation: 0.3,
                syncWithAxis: yAxis,
                renderer: am5xy.AxisRendererY.new(root, { opposite: true })
            })
        );
        let series = chart.series.push(
            am5xy.ColumnSeries.new(root, {
                name: "Series 1",
                xAxis: xAxis,
                yAxis: yAxis2,
                valueYField: "value",
                sequencedInterpolation: true,
                categoryXField: "category",
                tooltip: am5.Tooltip.new(root, {
                labelText: "{provider} {realName}: {valueY}"
                })
            })
        );

        series.columns.template.setAll({
            fillOpacity: 0.9,
            strokeOpacity: 0
        });
        series.columns.template.adapters.add("fill", (fill, target) => {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        series.columns.template.adapters.add("stroke", (stroke, target) => {
            return chart.get("colors").getIndex(series.columns.indexOf(target));
        });

        let lineSeries = chart.series.push(
            am5xy.LineSeries.new(root, {
                name: "Series 2",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "quantity",
                sequencedInterpolation: true,
                stroke: chart.get("colors").getIndex(13),
                fill: chart.get("colors").getIndex(13),
                categoryXField: "category",
                tooltip: am5.Tooltip.new(root, {
                labelText: "{valueY}"
                })
            })
        );

        lineSeries.strokes.template.set("strokeWidth", 2);

        lineSeries.bullets.push(function () {
            return am5.Bullet.new(root, {
                locationY: 1,
                locationX: undefined,
                sprite: am5.Circle.new(root, {
                radius: 5,
                fill: lineSeries.get("fill")
                })
            });
        });

        lineSeries.events.on("datavalidated", function () {
            am5.array.each(lineSeries.dataItems, function (dataItem) {
                if (
                dataItem.dataContext.count / 2 ==
                Math.round(dataItem.dataContext.count / 2)
                ) {
                dataItem.set("locationX", 0);
                } else {
                dataItem.set("locationX", 0.5);
                }
            });
        });

        let chartData = [];

        // Set data
        let data = {
        "Provider 1": {
            "item 1": 10,
            "item 2": 35,
            "item 3": 5,
            "item 4": 20,
            quantity: 430
        },
        "Provider 2": {
            "item 1": 15,
            "item 3": 21,
            quantity: 210
        },
        "Provider 3": {
            "item 2": 25,
            "item 3": 11,
            "item 4": 17,
            quantity: 265
        },
        "Provider 4": {
            "item 3": 12,
            "item 4": 15,
            quantity: 98
        }
        };

        for (var providerName in data) {
        let providerData = data[providerName];

        let tempArray = [];
        let count = 0;
        for (var itemName in providerData) {
            if (itemName != "quantity") {
            count++;
            tempArray.push({
                category: providerName + "_" + itemName,
                realName: itemName,
                value: providerData[itemName],
                provider: providerName
            });
            }
        }
        tempArray.sort(function (a, b) {
            if (a.value > b.value) {
            return 1;
            } else if (a.value < b.value) {
            return -1;
            } else {
            return 0;
            }
        });
        let lineSeriesDataIndex = Math.floor(count / 2);
        tempArray[lineSeriesDataIndex].quantity = providerData.quantity;
        tempArray[lineSeriesDataIndex].count = count;
        am5.array.each(tempArray, function (item) {
            chartData.push(item);
        });

        let range = xAxis.makeDataItem({});
        xAxis.createAxisRange(range);

        range.set("category", tempArray[0].category);
        range.set("endCategory", tempArray[tempArray.length - 1].category);

        let label = range.get("label");

        label.setAll({
            text: tempArray[0].provider,
            dy: 30,
            fontWeight: "bold",
            tooltipText: tempArray[0].provider
        });

        let tick = range.get("tick");
        tick.setAll({ visible: true, strokeOpacity: 1, length: 50, location: 0 });

        let grid = range.get("grid");
        grid.setAll({ strokeOpacity: 1 });
        }
        let range = xAxis.makeDataItem({});
        xAxis.createAxisRange(range);
        range.set("category", chartData[chartData.length - 1].category);
        let tick = range.get("tick");
        tick.setAll({ visible: true, strokeOpacity: 1, length: 50, location: 1 });

        let grid = range.get("grid");
        grid.setAll({ strokeOpacity: 1, location: 1 });

        xAxis.data.setAll(chartData);
        series.data.setAll(chartData);
        lineSeries.data.setAll(chartData);
        series.appear(1000);
        chart.appear(1000, 100);
            }
}
</script>

<style scoped lang="scss">
#chartdiv {
  width: 100%;
  height: 450px;
}
</style>